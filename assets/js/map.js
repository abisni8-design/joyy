document.addEventListener("DOMContentLoaded", function () {
    const mapElement = document.getElementById("map");
    if (!mapElement || typeof L === "undefined") return;

    const map = L.map("map", { zoomControl: false, minZoom: 5, maxZoom: 20 });
    L.control.zoom({ position: "topright" }).addTo(map);

    const baseMaps = {
        "OpenStreetMap": L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", { attribution: "&copy; OpenStreetMap contributors", maxZoom: 20 }),
        "Satelit": L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}", { attribution: "Tiles &copy; Esri", maxZoom: 20 }),
        "Topografi": L.tileLayer("https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png", { attribution: "&copy; OpenTopoMap contributors", maxZoom: 17 })
    };
    baseMaps["OpenStreetMap"].addTo(map);
    map.setView([-2.65, 120.15], 11);

    const sawahLayer = L.geoJSON(null, { style: { weight: 1.5, fillOpacity: .45 }, onEachFeature: (f,l)=>popup(l, f, 'sawah') });
    const irigasiLayer = L.geoJSON(null, { style: { weight: 4 }, onEachFeature: (f,l)=>popup(l, f, 'irigasi') });
    const tanahLayer = L.geoJSON(null, { style: { weight: 1, fillOpacity: .28 }, onEachFeature: (f,l)=>popup(l, f, 'tanah') });
    const layerGroups = { sawah: sawahLayer, irigasi: irigasiLayer, tanah: tanahLayer };
    const allData = { sawah: null, irigasi: null, tanah: null };
    let activeFilter = 'all';

    function popup(layer, feature, type) {
        const p = feature.properties || {};
        let html = '<div class="map-popup"><strong>' + escapeHtml(type === 'sawah' ? (p.nama_lahan || 'Lahan Sawah') : type === 'irigasi' ? (p.nama_irigasi || 'Jaringan Irigasi') : (p.jenis_tanah || 'Jenis Tanah')) + '</strong><hr>';
        const fields = type === 'sawah' ? [['Luas (ha)',p.luas],['Varietas',p.varietas],['Produksi (ton)',p.produksi],['Kelompok Tani',p.kelompok_tani],['Kondisi Irigasi',p.kondisi_irigasi],['Jenis Tanah',p.jenis_tanah]] : type === 'irigasi' ? [['Panjang',p.panjang],['Kondisi',p.kondisi],['Sumber Air',p.sumber_air]] : [['Luas',p.luas],['Karakteristik',p.karakteristik]];
        fields.forEach(([k,v])=>{ if(v!==undefined && v!==null && v!=='') html += '<div><b>'+escapeHtml(k)+':</b> '+escapeHtml(v)+'</div>'; });
        if(p.keterangan) html += '<div><b>Keterangan:</b> '+escapeHtml(p.keterangan)+'</div>';
        layer.bindPopup(html + '</div>');
    }
    function escapeHtml(v){ return String(v ?? '').replace(/[&<>'"]/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[c])); }

    function colorize(layer, type) {
        const colors = { sawah: '#4f9b47', irigasi: '#2c77c7', tanah: '#9b7b4a' };
        layer.setStyle({ color: colors[type], fillColor: colors[type] });
    }
    colorize(sawahLayer,'sawah'); colorize(irigasiLayer,'irigasi'); colorize(tanahLayer,'tanah');

    async function loadLayer(type, url) {
        try {
            const res = await fetch(url);
            const data = await res.json();
            allData[type] = data;
            layerGroups[type].clearLayers();
            layerGroups[type].addData(data);
            colorize(layerGroups[type], type);
        } catch(e) { console.error('Gagal memuat '+type,e); }
    }
    loadLayer('sawah','../api/sawah.php');
    loadLayer('irigasi','../api/irigasi.php');
    loadLayer('tanah','../api/tanah.php');

    function showLayers() {
        Object.values(layerGroups).forEach(l=>map.removeLayer(l));
        if(activeFilter==='all') Object.values(layerGroups).forEach(l=>map.addLayer(l));
        else if(layerGroups[activeFilter]) map.addLayer(layerGroups[activeFilter]);
    }
    document.querySelectorAll('.layer-btn').forEach(btn=>{
        btn.addEventListener('click',()=>{
            document.querySelectorAll('.layer-btn').forEach(b=>b.classList.remove('active'));
            btn.classList.add('active');
            activeFilter = btn.dataset.layer || 'all';
            showLayers();
        });
    });
    showLayers();

    const searchInput = document.getElementById('mapSearch');
    const searchType = document.getElementById('mapFilter');
    const searchInfo = document.getElementById('searchInfo');
    function doSearch(){
        const q=(searchInput?.value||'').trim().toLowerCase();
        const type=searchType?.value||'all';
        if(!q){ if(searchInfo) searchInfo.textContent=''; return; }
        const types=type==='all'?Object.keys(allData):[type]; let matches=[];
        types.forEach(t=>{ const fc=allData[t]; if(!fc) return; (fc.features||[]).forEach(f=>{ const p=f.properties||{}; const text=Object.values(p).join(' ').toLowerCase(); if(text.includes(q)) matches.push({f,t}); }); });
        if(searchInfo) searchInfo.textContent=matches.length+' data ditemukan';
        if(matches.length){
            const target = L.geoJSON({type:'FeatureCollection',features:matches.map(x=>x.f)});
            const b=target.getBounds(); if(b.isValid()) map.fitBounds(b.pad(.15));
            matches.slice(0,10).forEach(x=>{ const layer=L.geoJSON(x.f,{style:{weight:5}}); layer.bindPopup('Hasil pencarian').addTo(map); setTimeout(()=>map.removeLayer(layer),4500); });
        }
    }
    searchInput?.addEventListener('input', doSearch);
    searchType?.addEventListener('change', doSearch);
    document.getElementById('clearSearch')?.addEventListener('click',()=>{ if(searchInput) searchInput.value=''; if(searchInfo) searchInfo.textContent=''; });

    // Basemap panel
    const basemapControl=L.control({position:'topright'});
    basemapControl.onAdd=function(){
        const div=L.DomUtil.create('div','map-panel basemap-panel');
        div.innerHTML='<div class="map-panel-title"><i class="fa-solid fa-layer-group"></i> Basemap</div>'+Object.keys(baseMaps).map((n,i)=>'<button type="button" data-base="'+i+'" class="base-choice '+(i===0?'active':'')+'">'+n+'</button>').join('');
        L.DomEvent.disableClickPropagation(div);
        div.querySelectorAll('.base-choice').forEach((b,i)=>b.addEventListener('click',()=>{ Object.values(baseMaps).forEach(x=>map.removeLayer(x)); Object.values(baseMaps)[i].addTo(map); div.querySelectorAll('.base-choice').forEach(x=>x.classList.remove('active')); b.classList.add('active'); }));
        return div;
    }; basemapControl.addTo(map);

    // MiniMap
    const mini=L.control({position:'bottomright'});
    mini.onAdd=function(){ const div=L.DomUtil.create('div','mini-map'); div.innerHTML='<div id="miniMap"></div>'; setTimeout(()=>{ const mm=L.map('miniMap',{zoomControl:false,attributionControl:false,dragging:false,scrollWheelZoom:false,doubleClickZoom:false,boxZoom:false,touchZoom:false}); L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mm); const marker=L.marker(map.getCenter()).addTo(mm); function sync(){mm.setView(map.getCenter(),Math.max(5,map.getZoom()-5));marker.setLatLng(map.getCenter());} map.on('move zoom',sync); sync(); },0); return div; }; mini.addTo(map);

    const legend=L.control({position:'bottomleft'});
    legend.onAdd=function(){ const div=L.DomUtil.create('div','map-legend'); div.innerHTML='<div class="legend-title">Legenda</div><div><span class="legend-box sawah"></span>Lahan Sawah</div><div><span class="legend-line irigasi"></span>Jaringan Irigasi</div><div><span class="legend-box tanah"></span>Jenis Tanah</div>'; return div; }; legend.addTo(map);

    // Default zoom to data after loading
    setTimeout(()=>{ const g=L.featureGroup(Object.values(layerGroups)); if(g.getBounds().isValid()) map.fitBounds(g.getBounds().pad(.08)); },1200);
});
