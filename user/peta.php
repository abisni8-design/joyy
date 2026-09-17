<?php
require_once "../config/database.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>
Peta | Padi Seriti - WebGIS Pertanian Presisi
</title>


<!-- BOOTSTRAP -->
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>


<!-- FONT AWESOME -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>


<!-- LEAFLET -->
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
>


<!-- MINIMAP -->
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet-minimap@3.6.1/dist/Control.MiniMap.min.css"
>


<!-- GOOGLE FONT -->
<link
    rel="preconnect"
    href="https://fonts.googleapis.com"
>

<link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin
>

<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap"
    rel="stylesheet"
>


<!-- STYLE UTAMA -->
<link
    rel="stylesheet"
    href="../assets/css/style.css"
>


<style>

/* =========================================================
   DASAR
========================================================= */

html{
    scroll-behavior:smooth;
}

body{
    margin:0;
    padding:0;
    background:#f5f7f5;
    font-family:"Inter",sans-serif;
}


/* =========================================================
   HALAMAN PETA
========================================================= */

.map-page{

    width:100%;

    padding-top:76px;

    min-height:0;

}


/* =========================================================
   LAYOUT PETA
========================================================= */

.map-layout{

    display:flex;

    width:100%;

    height:calc(100vh - 76px);

    min-height:650px;

}


/* =========================================================
   SIDEBAR
========================================================= */

.map-sidebar{

    width:320px;

    min-width:320px;

    height:100%;

    background:#ffffff;

    border-right:1px solid #e2e8e4;

    overflow-y:auto;

    padding:30px 27px;

    position:relative;

    z-index:1000;

    box-shadow:3px 0 15px rgba(0,0,0,.04);

}


/* scrollbar sidebar */

.map-sidebar::-webkit-scrollbar{

    width:6px;

}

.map-sidebar::-webkit-scrollbar-track{

    background:#f4f6f4;

}

.map-sidebar::-webkit-scrollbar-thumb{

    background:#cbd6d0;

    border-radius:10px;

}


/* =========================================================
   JUDUL SIDEBAR
========================================================= */

.sidebar-title{

    font-family:"Poppins",sans-serif;

    font-size:27px;

    line-height:1.2;

    font-weight:800;

    color:#23382d;

    margin-bottom:30px;

}


/* =========================================================
   ITEM LAYER
========================================================= */

.layer-item{

    display:flex;

    align-items:center;

    gap:12px;

    width:100%;

    margin-bottom:21px;

    cursor:pointer;

    user-select:none;

}


.layer-item input{

    width:22px;

    height:22px;

    margin:0;

    flex-shrink:0;

    cursor:pointer;

    accent-color:#31966c;

}


.layer-color{

    width:18px;

    height:18px;

    min-width:18px;

    border-radius:50%;

    display:inline-block;

}


.layer-name{

    color:#293b32;

    font-size:15px;

    font-weight:600;

    line-height:1.3;

}


/* =========================================================
   DIVIDER
========================================================= */

.sidebar-divider{

    border:0;

    height:1px;

    background:#e0e6e2;

    margin:30px 0;

}


/* =========================================================
   JUDUL SECTION SIDEBAR
========================================================= */

.sidebar-section-title{

    font-family:"Poppins",sans-serif;

    font-size:21px;

    line-height:1.2;

    font-weight:800;

    color:#263a30;

    margin-bottom:17px;

}


/* =========================================================
   SELECT
========================================================= */

.sidebar-select{

    display:block;

    width:100%;

    height:52px;

    padding:0 15px;

    border:1px solid #d9e2dc;

    border-radius:14px;

    background:#ffffff;

    color:#35453d;

    font-size:14px;

    outline:none;

    cursor:pointer;

    transition:.2s;

}


.sidebar-select:focus{

    border-color:#31966c;

    box-shadow:0 0 0 3px rgba(49,150,108,.10);

}


/* =========================================================
   SEARCH
========================================================= */

.sidebar-search{

    width:100%;

    height:52px;

    display:flex;

    align-items:center;

    border:1px solid #d9e2dc;

    border-radius:14px;

    background:#ffffff;

    overflow:hidden;

    transition:.2s;

}


.sidebar-search:focus-within{

    border-color:#31966c;

    box-shadow:0 0 0 3px rgba(49,150,108,.10);

}


.sidebar-search > i{

    margin-left:15px;

    color:#7a8880;

    font-size:14px;

}


.sidebar-search input{

    flex:1;

    min-width:0;

    height:100%;

    border:0;

    outline:0;

    padding:0 10px;

    font-size:13px;

    color:#273a31;

}


.sidebar-search input::placeholder{

    color:#929c96;

}


.sidebar-search button{

    width:44px;

    min-width:44px;

    height:100%;

    border:0;

    background:#ffffff;

    color:#8a958f;

    cursor:pointer;

}


.sidebar-search button:hover{

    color:#31966c;

}


/* =========================================================
   HASIL PENCARIAN
========================================================= */

.search-result{

    margin-top:10px;

    font-size:12px;

    line-height:1.5;

    color:#78847e;

}


/* =========================================================
   PETA CONTAINER
========================================================= */

.map-container{

    position:relative;

    flex:1;

    min-width:0;

    height:100%;

    overflow:hidden;

}


#map{

    width:100%;

    height:100%;

    background:#e9eeeb;

}


/* =========================================================
   JUDUL PETA
========================================================= */

.map-title{

    position:absolute;

    z-index:900;

    top:20px;

    left:50%;

    transform:translateX(-50%);

    background:rgba(255,255,255,.96);

    border-radius:17px;

    padding:12px 24px;

    box-shadow:0 5px 20px rgba(0,0,0,.13);

    font-family:"Poppins",sans-serif;

    font-size:18px;

    font-weight:700;

    color:#283b32;

    white-space:nowrap;

    pointer-events:none;

}


/* =========================================================
   BASEMAP PANEL
========================================================= */

.basemap-panel{

    position:absolute;

    z-index:900;

    top:20px;

    right:20px;

    width:205px;

    padding:15px 17px;

    background:rgba(255,255,255,.97);

    border-radius:17px;

    box-shadow:0 7px 22px rgba(0,0,0,.15);

}


.basemap-title{

    display:flex;

    align-items:center;

    gap:8px;

    font-family:"Poppins",sans-serif;

    font-size:15px;

    font-weight:800;

    color:#293d33;

    margin-bottom:11px;

}


.basemap-title i{

    color:#31966c;

}


.basemap-option{

    display:flex;

    align-items:center;

    gap:9px;

    margin:9px 0;

    color:#405048;

    font-size:13px;

    font-weight:600;

    cursor:pointer;

    user-select:none;

}


.basemap-option input{

    width:17px;

    height:17px;

    margin:0;

    accent-color:#31966c;

    cursor:pointer;

}


/* =========================================================
   KOMPAS
========================================================= */

.compass{

    position:absolute;

    z-index:900;

    top:100px;

    left:22px;

    width:80px;

    height:80px;

    border-radius:50%;

    background:rgba(255,255,255,.96);

    box-shadow:0 5px 18px rgba(0,0,0,.14);

    display:flex;

    align-items:center;

    justify-content:center;

}


.compass-inner{

    position:relative;

    width:57px;

    height:57px;

    border:1px solid #dce3df;

    border-radius:50%;

}


.compass-inner span{

    position:absolute;

    font-size:10px;

    font-weight:800;

    font-family:"Inter",sans-serif;

}


.compass-n{

    top:-4px;

    left:23px;

    color:#dd5964;

}


.compass-s{

    bottom:-4px;

    left:23px;

    color:#4c5b53;

}


.compass-e{

    right:-5px;

    top:21px;

    color:#4c5b53;

}


.compass-w{

    left:-5px;

    top:21px;

    color:#4c5b53;

}


.compass-arrow{

    position:absolute;

    left:21px;

    top:15px;

    width:0;

    height:0;

    border-left:7px solid transparent;

    border-right:7px solid transparent;

    border-bottom:19px solid #dd5964;

}


/* =========================================================
   LEGENDA
========================================================= */

.map-legend{

    position:absolute;

    z-index:900;

    left:20px;

    bottom:20px;

    width:245px;

    padding:17px 19px;

    background:rgba(255,255,255,.97);

    border-radius:17px;

    box-shadow:0 7px 22px rgba(0,0,0,.14);

}


.map-legend h5{

    margin:0 0 13px;

    font-family:"Poppins",sans-serif;

    font-size:17px;

    font-weight:800;

    color:#283c32;

}


.legend-item{

    display:flex;

    align-items:center;

    gap:10px;

    margin:9px 0;

    font-size:13px;

    color:#4b5952;

}


.legend-circle{

    width:16px;

    height:16px;

    min-width:16px;

    border-radius:50%;

}


.legend-line{

    width:27px;

    height:5px;

    min-width:27px;

    border-radius:10px;

}


.legend-polygon{

    width:20px;

    height:16px;

    min-width:20px;

    border-radius:3px;

    background:rgba(216,153,77,.30);

    border:2px solid #d8994d;

}


/* =========================================================
   HOME BUTTON
========================================================= */

.home-button{

    position:absolute;

    z-index:900;

    right:20px;

    bottom:185px;

    width:44px;

    height:44px;

    border:0;

    border-radius:12px;

    background:#ffffff;

    color:#315447;

    box-shadow:0 5px 18px rgba(0,0,0,.15);

    cursor:pointer;

    transition:.2s;

}


.home-button:hover{

    background:#31966c;

    color:#ffffff;

    transform:translateY(-2px);

}


/* =========================================================
   LEAFLET POPUP
========================================================= */

.leaflet-popup-content-wrapper{

    border-radius:14px;

}


.leaflet-popup-content{

    margin:15px;

}


/* =========================================================
   FOOTER
========================================================= */

footer{

    position:relative;

    width:100%;

    background:#19352a;

    color:#ffffff;

    padding:55px 0 25px;

    z-index:10;

}


footer .footer-brand{

    font-family:"Poppins",sans-serif;

    font-size:22px;

    font-weight:800;

    margin-bottom:12px;

}


footer .footer-brand i{

    margin-right:6px;

}


footer p{

    color:rgba(255,255,255,.72);

    margin-bottom:0;

}


footer h6{

    font-family:"Poppins",sans-serif;

    font-weight:700;

    margin-bottom:18px;

}


footer a{

    display:block;

    color:rgba(255,255,255,.72);

    text-decoration:none;

    margin-bottom:10px;

    transition:.2s;

}


footer a:hover{

    color:#ffffff;

    transform:translateX(3px);

}


.footer-bottom{

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:20px;

    border-top:1px solid rgba(255,255,255,.15);

    margin-top:35px;

    padding-top:20px;

    color:rgba(255,255,255,.60);

    font-size:13px;

}


/* =========================================================
   MOBILE
========================================================= */

@media(max-width:900px){

    .map-sidebar{

        width:275px;

        min-width:275px;

        padding:25px 20px;

    }


    .sidebar-title{

        font-size:24px;

    }


    .map-title{

        font-size:15px;

        padding:11px 17px;

    }


    .basemap-panel{

        width:180px;

    }

}


@media(max-width:700px){

    .map-page{

        padding-top:70px;

    }


    .map-layout{

        display:block;

        height:auto;

        min-height:0;

    }


    .map-sidebar{

        width:100%;

        min-width:100%;

        height:auto;

        max-height:none;

        padding:25px 20px;

        border-right:0;

        border-bottom:1px solid #e1e7e3;

    }


    .map-container{

        width:100%;

        height:650px;

    }


    .map-title{

        top:15px;

        left:15px;

        transform:none;

        font-size:14px;

    }


    .basemap-panel{

        top:65px;

        right:10px;

        width:175px;

        padding:12px;

    }


    .compass{

        top:65px;

        left:15px;

        transform:scale(.85);

        transform-origin:top left;

    }


    .map-legend{

        left:10px;

        bottom:10px;

        width:205px;

        padding:13px 15px;

    }


    .home-button{

        right:10px;

        bottom:165px;

    }


    footer{

        padding:40px 0 20px;

    }


    .footer-bottom{

        flex-direction:column;

        align-items:flex-start;

    }

}

</style>

</head>


<body>


<?php include "header.php"; ?>


<!-- =========================================================
     HALAMAN PETA
========================================================= -->

<div class="map-page">


    <div class="map-layout">


        <!-- =================================================
             SIDEBAR
        ================================================== -->

        <aside class="map-sidebar">


            <div class="sidebar-title">
                Layer Peta
            </div>


            <!-- SAWAH -->

            <label class="layer-item">

                <input
                    type="checkbox"
                    id="checkSawah"
                    checked
                >

                <span
                    class="layer-color"
                    style="background:#52a96e;"
                ></span>

                <span class="layer-name">
                    Sebaran Lahan Padi
                </span>

            </label>


            <!-- IRIGASI -->

            <label class="layer-item">

                <input
                    type="checkbox"
                    id="checkIrigasi"
                    checked
                >

                <span
                    class="layer-color"
                    style="background:#4aa0d2;"
                ></span>

                <span class="layer-name">
                    Jaringan Irigasi
                </span>

            </label>


            <!-- TANAH -->

            <label class="layer-item">

                <input
                    type="checkbox"
                    id="checkTanah"
                    checked
                >

                <span
                    class="layer-color"
                    style="background:#d8994d;"
                ></span>

                <span class="layer-name">
                    Jenis Tanah
                </span>

            </label>


            <!-- PRODUKSI -->

            <label class="layer-item">

                <input
                    type="checkbox"
                    id="checkProduksi"
                >

                <span
                    class="layer-color"
                    style="background:#f18154;"
                ></span>

                <span class="layer-name">
                    Produksi Padi
                </span>

            </label>


            <hr class="sidebar-divider">


            <!-- =================================================
                 FILTER VARIETAS
            ================================================== -->

            <div class="sidebar-section-title">
                Filter Varietas
            </div>


            <select
                id="varietasFilter"
                class="sidebar-select"
            >

                <option value="all">
                    Semua Varietas
                </option>

            </select>


            <hr class="sidebar-divider">


            <!-- =================================================
                 PENCARIAN
            ================================================== -->

            <div class="sidebar-section-title">
                Cari Lahan
            </div>


            <div class="sidebar-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    id="searchLahan"
                    placeholder="ID, varietas, kelompok tani..."
                >

                <button
                    type="button"
                    id="clearSearch"
                    title="Bersihkan pencarian"
                >

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>


            <div
                id="searchResult"
                class="search-result"
            >
                Klik objek pada peta untuk melihat detail atribut.
            </div>


        </aside>


        <!-- =================================================
             MAP
        ================================================== -->

        <div class="map-container">


            <div class="map-title">

                <i
                    class="fa-solid fa-location-dot"
                    style="color:#e35e6b;margin-right:7px;"
                ></i>

                WebGIS • Desa Seriti

            </div>


            <div id="map"></div>


            <!-- =================================================
                 BASEMAP
            ================================================== -->

            <div class="basemap-panel">

                <div class="basemap-title">

                    <i class="fa-solid fa-layer-group"></i>

                    Basemap

                </div>


                <label class="basemap-option">

                    <input
                        type="radio"
                        name="basemap"
                        value="osm"
                        checked
                    >

                    OpenStreetMap

                </label>


                <label class="basemap-option">

                    <input
                        type="radio"
                        name="basemap"
                        value="satellite"
                    >

                    Satelit

                </label>


                <label class="basemap-option">

                    <input
                        type="radio"
                        name="basemap"
                        value="topo"
                    >

                    Topografi

                </label>

            </div>


            <!-- =================================================
                 KOMPAS
            ================================================== -->

            <div class="compass">

                <div class="compass-inner">

                    <span class="compass-n">
                        N
                    </span>

                    <span class="compass-s">
                        S
                    </span>

                    <span class="compass-e">
                        E
                    </span>

                    <span class="compass-w">
                        W
                    </span>

                    <span class="compass-arrow"></span>

                </div>

            </div>


            <!-- =================================================
                 LEGENDA
            ================================================== -->

            <div class="map-legend">

                <h5>
                    Legenda
                </h5>


                <div class="legend-item">

                    <span
                        class="legend-circle"
                        style="background:#52a96e;"
                    ></span>

                    Lahan padi sawah

                </div>


                <div class="legend-item">

                    <span
                        class="legend-line"
                        style="background:#4aa0d2;"
                    ></span>

                    Jaringan irigasi

                </div>


                <div class="legend-item">

                    <span
                        class="legend-polygon"
                    ></span>

                    Jenis tanah

                </div>

            </div>


            <!-- =================================================
                 HOME
            ================================================== -->

            <button
                type="button"
                class="home-button"
                id="homeButton"
                title="Kembali ke lokasi awal"
            >

                <i class="fa-solid fa-house"></i>

            </button>


        </div>

    </div>

</div>


<!-- =========================================================
     FOOTER
========================================================= -->

<?php include "footer.php"; ?>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>


<script
    src="https://unpkg.com/leaflet-minimap@3.6.1/dist/Control.MiniMap.min.js">
</script>


<script>

/* =========================================================
   KONFIGURASI API
========================================================= */

const API_SAWAH =
    "../api/sawah.php";

const API_IRIGASI =
    "../api/irigasi.php";

const API_TANAH =
    "../api/tanah.php";


/* =========================================================
   POSISI AWAL PETA
========================================================= */

const INITIAL_CENTER = [
    -2.8260180876511707,
    120.19794142793265
];

const INITIAL_ZOOM = 15;


/* =========================================================
   INISIALISASI MAP
========================================================= */

const map = L.map("map", {

    zoomControl:true,

    attributionControl:true

});


map.setView(
    INITIAL_CENTER,
    INITIAL_ZOOM
);


/* =========================================================
   BASEMAP OSM
========================================================= */

const osm = L.tileLayer(

    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",

    {

        maxZoom:20,

        attribution:
            "&copy; OpenStreetMap contributors"

    }

);


/* =========================================================
   BASEMAP SATELIT
========================================================= */

const satellite = L.tileLayer(

    "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",

    {

        maxZoom:20,

        attribution:
            "Tiles &copy; Esri"

    }

);


/* =========================================================
   BASEMAP TOPOGRAFI
========================================================= */

const topo = L.tileLayer(

    "https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png",

    {

        maxZoom:17,

        attribution:
            "&copy; OpenTopoMap contributors"

    }

);


/* DEFAULT */

osm.addTo(map);


/* =========================================================
   GANTI BASEMAP
========================================================= */

document
.querySelectorAll(
    'input[name="basemap"]'
)
.forEach(
    function(input){

        input.addEventListener(
            "change",
            function(){

                map.removeLayer(osm);

                map.removeLayer(satellite);

                map.removeLayer(topo);


                if(
                    this.value === "osm"
                ){

                    osm.addTo(map);

                }


                if(
                    this.value === "satellite"
                ){

                    satellite.addTo(map);

                }


                if(
                    this.value === "topo"
                ){

                    topo.addTo(map);

                }

            }
        );

    }
);


/* =========================================================
   LAYER GROUP
========================================================= */

const sawahLayer =
    L.layerGroup();

const irigasiLayer =
    L.layerGroup();

const tanahLayer =
    L.layerGroup();


sawahLayer.addTo(map);

irigasiLayer.addTo(map);

tanahLayer.addTo(map);


/* =========================================================
   DATA
========================================================= */

let sawahData = [];

let irigasiData = [];

let tanahData = [];


/* =========================================================
   MENGAMBIL GEOMETRY
========================================================= */

function getGeometry(item){

    let geometry = item.geometry || item.geojson || item.geom;

    if(!geometry) return null;

    if(typeof geometry === "string"){
        try{
            geometry = JSON.parse(geometry);
        }catch(error){
            console.error("Geometry bukan JSON valid:", error);
            return null;
        }
    }

    // Jika database menyimpan GeoJSON Feature, ambil bagian geometry-nya.
    if(geometry && geometry.type === "Feature"){
        geometry = geometry.geometry;
    }

    // L.geoJSON membutuhkan Geometry pada properti geometry Feature.
    if(!geometry || !geometry.type || geometry.coordinates === undefined){
        return null;
    }

    return geometry;
}


/* =========================================================
   POPUP
========================================================= */

function popupContent(
    title,
    data
){

    let html = `

        <div style="
            font-family:Inter,sans-serif;
            min-width:250px;
        ">

            <h5 style="
                color:#287151;
                font-weight:800;
                margin-bottom:12px;
            ">

                ${escapeHtml(title)}

            </h5>

            <table style="
                width:100%;
                font-size:12px;
                border-collapse:collapse;
            ">

    `;


    Object.keys(
        data || {}
    )
    .forEach(
        function(key){

            let value =
                data[key];


            if(

                value !== null &&

                value !== undefined &&

                value !== "" &&

                key !== "geometry" &&

                key !== "geojson" &&

                key !== "geom"

            ){

                let label =
                    key
                    .replaceAll(
                        "_",
                        " "
                    );


                label =
                    label.replace(
                        /\b\w/g,
                        c => c.toUpperCase()
                    );


                html += `

                    <tr>

                        <td style="
                            padding:6px;
                            font-weight:700;
                            color:#68766f;
                            border-bottom:1px solid #eeeeee;
                            vertical-align:top;
                        ">

                            ${escapeHtml(label)}

                        </td>


                        <td style="
                            padding:6px;
                            border-bottom:1px solid #eeeeee;
                            vertical-align:top;
                        ">

                            ${escapeHtml(
                                String(value)
                            )}

                        </td>

                    </tr>

                `;

            }

        }
    );


    html += `

            </table>

        </div>

    `;


    return html;

}


/* =========================================================
   ESCAPE HTML
========================================================= */

function escapeHtml(value){

    return value
        .replaceAll("&","&amp;")
        .replaceAll("<","&lt;")
        .replaceAll(">","&gt;")
        .replaceAll('"',"&quot;")
        .replaceAll("'","&#039;");

}


/* =========================================================
   MEMBUAT FEATURE
========================================================= */

function makeFeature(item){

    const geometry =
        getGeometry(item);


    if(!geometry){

        return null;

    }


    return {

        type:"Feature",

        properties:item,

        geometry:geometry

    };

}


/* =========================================================
   LOAD SAWAH
========================================================= */

async function loadSawah(){

    try{

        const response =
            await fetch(
                API_SAWAH,
                {
                    cache:"no-store"
                }
            );


        if(!response.ok){

            throw new Error(
                "API sawah gagal: " +
                response.status
            );

        }


        const result =
            await response.json();


            // API dapat mengembalikan array biasa atau GeoJSON FeatureCollection.
        if(Array.isArray(result)){
            sawahData = result;
        }else if(result && Array.isArray(result.features)){
            sawahData = result.features.map(function(feature){
                return Object.assign({}, feature.properties || {}, {
                    geometry: feature.geometry
                });
            });
        }else{
            sawahData = result && Array.isArray(result.data) ? result.data : [];
        }


        sawahLayer.clearLayers();


        sawahData.forEach(
            function(item){

                const feature =
                    makeFeature(item);


                if(!feature){

                    return;

                }


                const layer =
                    L.geoJSON(
                        feature,
                        {

                            style:{

                                color:"#41945d",

                                weight:2,

                                fillColor:"#52a96e",

                                fillOpacity:.32

                            },


                            pointToLayer:
                            function(
                                feature,
                                latlng
                            ){

                                return L.circleMarker(
                                    latlng,
                                    {

                                        radius:7,

                                        color:"#ffffff",

                                        weight:2,

                                        fillColor:"#52a96e",

                                        fillOpacity:.95

                                    }
                                );

                            }

                        }
                    );


                layer.bindPopup(
                    popupContent(
                        "Lahan Padi Sawah",
                        item
                    )
                );


                sawahLayer.addLayer(
                    layer
                );

            }
        );


        createVarietas();

        updateSearchInfo();


    }
    catch(error){

        console.error(
            "Gagal memuat sawah:",
            error
        );

    }

}


/* =========================================================
   LOAD IRIGASI
========================================================= */

async function loadIrigasi(){

    try{

        const response =
            await fetch(
                API_IRIGASI,
                {
                    cache:"no-store"
                }
            );


        if(!response.ok){

            throw new Error(
                "API irigasi gagal: " +
                response.status
            );

        }


        const result =
            await response.json();


        if(Array.isArray(result)){
            irigasiData = result;
        }else if(result && Array.isArray(result.features)){
            irigasiData = result.features.map(function(feature){
                return Object.assign({}, feature.properties || {}, {geometry: feature.geometry});
            });
        }else{
            irigasiData = result && Array.isArray(result.data) ? result.data : [];
        }


        irigasiLayer.clearLayers();


        irigasiData.forEach(
            function(item){

                const feature =
                    makeFeature(item);


                if(!feature){

                    return;

                }


                const layer =
                    L.geoJSON(
                        feature,
                        {

                            style:{

                                color:"#318bc1",

                                weight:5,

                                opacity:.90

                            }

                        }
                    );


                layer.bindPopup(
                    popupContent(
                        "Jaringan Irigasi",
                        item
                    )
                );


                irigasiLayer.addLayer(
                    layer
                );

            }
        );

    }
    catch(error){

        console.error(
            "Gagal memuat irigasi:",
            error
        );

    }

}


/* =========================================================
   LOAD TANAH
========================================================= */

async function loadTanah(){

    try{

        const response =
            await fetch(
                API_TANAH,
                {
                    cache:"no-store"
                }
            );


        if(!response.ok){

            throw new Error(
                "API tanah gagal: " +
                response.status
            );

        }


        const result =
            await response.json();


        if(Array.isArray(result)){
            tanahData = result;
        }else if(result && Array.isArray(result.features)){
            tanahData = result.features.map(function(feature){
                return Object.assign({}, feature.properties || {}, {geometry: feature.geometry});
            });
        }else{
            tanahData = result && Array.isArray(result.data) ? result.data : [];
        }


        tanahLayer.clearLayers();


        const colors = [

            "#d8994d",

            "#c67e39",

            "#b36d32",

            "#e0ad6a",

            "#a96032",

            "#c98e50"

        ];


        tanahData.forEach(
            function(
                item,
                index
            ){

                const feature =
                    makeFeature(item);


                if(!feature){

                    return;

                }


                const color =
                    colors[
                        index %
                        colors.length
                    ];


                const layer =
                    L.geoJSON(
                        feature,
                        {

                            style:{

                                color:color,

                                weight:2,

                                fillColor:color,

                                fillOpacity:.28

                            }

                        }
                    );


                layer.bindPopup(
                    popupContent(
                        "Jenis Tanah",
                        item
                    )
                );


                tanahLayer.addLayer(
                    layer
                );

            }
        );

    }
    catch(error){

        console.error(
            "Gagal memuat tanah:",
            error
        );

    }

}


/* =========================================================
   VARIETAS
========================================================= */

function createVarietas(){

    const select =
        document.getElementById(
            "varietasFilter"
        );


    const varieties = [];


    sawahData.forEach(
        function(item){

            const key =
                Object.keys(item)
                .find(
                    function(k){

                        return k
                            .toLowerCase()
                            .includes(
                                "varietas"
                            );

                    }
                );


            if(
                key &&
                item[key] !== null &&
                item[key] !== undefined &&
                String(item[key]).trim() !== ""
            ){

                const value =
                    String(
                        item[key]
                    ).trim();


                if(
                    !varieties.includes(
                        value
                    )
                ){

                    varieties.push(
                        value
                    );

                }

            }

        }
    );


    select.innerHTML = `

        <option value="all">
            Semua Varietas
        </option>

    `;


    varieties.sort(
        function(a,b){

            return a.localeCompare(
                b,
                "id"
            );

        }
    );


    varieties.forEach(
        function(varietas){

            const option =
                document.createElement(
                    "option"
                );


            option.value =
                varietas;


            option.textContent =
                varietas;


            select.appendChild(
                option
            );

        }
    );

}


/* =========================================================
   RENDER ULANG SAWAH
========================================================= */

function renderSawah(){

    const selected =
        document.getElementById(
            "varietasFilter"
        ).value
        .toLowerCase();


    sawahLayer.clearLayers();


    sawahData.forEach(
        function(item){

            const feature =
                makeFeature(item);


            if(!feature){

                return;

            }


            let varietas = "";


            const key =
                Object.keys(item)
                .find(
                    function(k){

                        return k
                            .toLowerCase()
                            .includes(
                                "varietas"
                            );

                    }
                );


            if(key){

                varietas =
                    String(
                        item[key]
                    )
                    .trim()
                    .toLowerCase();

            }


            if(

                selected !== "all" &&

                varietas !== selected

            ){

                return;

            }


            const layer =
                L.geoJSON(
                    feature,
                    {

                        style:{

                            color:"#41945d",

                            weight:2,

                            fillColor:"#52a96e",

                            fillOpacity:.32

                        }

                    }
                );


            layer.bindPopup(
                popupContent(
                    "Lahan Padi Sawah",
                    item
                )
            );


            sawahLayer.addLayer(
                layer
            );

        }
    );


    updateSearchInfo();

}


/* =========================================================
   EVENT FILTER VARIETAS
========================================================= */

document
.getElementById(
    "varietasFilter"
)
.addEventListener(
    "change",
    function(){

        renderSawah();

    }
);


/* =========================================================
   CHECKBOX SAWAH
========================================================= */

document
.getElementById(
    "checkSawah"
)
.addEventListener(
    "change",
    function(){

        if(
            this.checked
        ){

            sawahLayer.addTo(
                map
            );

        }
        else{

            map.removeLayer(
                sawahLayer
            );

        }

    }
);


/* =========================================================
   CHECKBOX IRIGASI
========================================================= */

document
.getElementById(
    "checkIrigasi"
)
.addEventListener(
    "change",
    function(){

        if(
            this.checked
        ){

            irigasiLayer.addTo(
                map
            );

        }
        else{

            map.removeLayer(
                irigasiLayer
            );

        }

    }
);


/* =========================================================
   CHECKBOX TANAH
========================================================= */

document
.getElementById(
    "checkTanah"
)
.addEventListener(
    "change",
    function(){

        if(
            this.checked
        ){

            tanahLayer.addTo(
                map
            );

        }
        else{

            map.removeLayer(
                tanahLayer
            );

        }

    }
);


/* =========================================================
   PRODUKSI
========================================================= */

document
.getElementById(
    "checkProduksi"
)
.addEventListener(
    "change",
    function(){

        /*
         * Layer produksi menggunakan
         * layer sawah yang sama.
         *
         * Jika nanti tersedia GeoJSON
         * khusus produksi, bagian ini
         * dapat dikembangkan.
         */

        if(
            this.checked
        ){

            sawahLayer.setStyle({

                color:"#e36f45",

                weight:2,

                fillColor:"#f18154",

                fillOpacity:.45

            });

        }
        else{

            renderSawah();

        }

    }
);


/* =========================================================
   PENCARIAN
========================================================= */

document
.getElementById(
    "searchLahan"
)
.addEventListener(
    "input",
    function(){

        const keyword =
            this.value
            .trim()
            .toLowerCase();


        if(!keyword){

            document.getElementById(
                "searchResult"
            ).innerText =
                "Klik objek pada peta untuk melihat detail atribut.";

            return;

        }


        let found = null;


        /*
         * Cari pada data sawah
         */

        for(
            const item
            of sawahData
        ){

            const text =
                Object
                .values(item)
                .join(" ")
                .toLowerCase();


            if(
                text.includes(
                    keyword
                )
            ){

                found = item;

                break;

            }

        }


        /*
         * Jika ditemukan
         */

        if(found){

            zoomToData(
                found,
                "sawah"
            );


            document.getElementById(
                "searchResult"
            ).innerText =
                "Data lahan ditemukan.";

        }
        else{

            document.getElementById(
                "searchResult"
            ).innerText =
                "Data tidak ditemukan.";

        }

    }
);


/* =========================================================
   CLEAR SEARCH
========================================================= */

document
.getElementById(
    "clearSearch"
)
.addEventListener(
    "click",
    function(){

        document.getElementById(
            "searchLahan"
        ).value = "";


        document.getElementById(
            "searchResult"
        ).innerText =
            "Klik objek pada peta untuk melihat detail atribut.";

    }
);


/* =========================================================
   ZOOM DATA
========================================================= */

function zoomToData(
    item,
    type
){

    const feature =
        makeFeature(item);


    if(!feature){

        return;

    }


    const temp =
        L.geoJSON(
            feature
        );


    const bounds =
        temp.getBounds();


    if(
        bounds.isValid()
    ){

        map.fitBounds(
            bounds,
            {

                padding:[
                    80,
                    80
                ],

                maxZoom:18

            }
        );

    }


    temp
    .bindPopup(
        popupContent(
            type === "sawah"
            ? "Lahan Padi Sawah"
            : "Data",
            item
        )
    )
    .openPopup();

}


/* =========================================================
   UPDATE INFORMASI SEARCH
========================================================= */

function updateSearchInfo(){

    const result =
        document.getElementById(
            "searchResult"
        );


    if(
        sawahData.length === 0
    ){

        result.innerText =
            "Belum terdapat data lahan.";

        return;

    }


    result.innerText =
        sawahData.length +
        " data lahan tersedia.";

}


/* =========================================================
   HOME BUTTON
========================================================= */

document
.getElementById(
    "homeButton"
)
.addEventListener(
    "click",
    function(){

        map.setView(
            INITIAL_CENTER,
            INITIAL_ZOOM
        );

    }
);


/* =========================================================
   MINIMAP
========================================================= */

const miniLayer =
    L.tileLayer(

        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",

        {

            attribution:
                "&copy; OpenStreetMap"

        }

    );


const miniMap =
    new L.Control.MiniMap(

        miniLayer,

        {

            position:"bottomright",

            width:220,

            height:125,

            minimized:false,

            toggleDisplay:true,

            zoomLevelOffset:-5,

            aimingRectOptions:{

                color:"#31966c",

                weight:2,

                fillOpacity:.10

            },

            shadowRectOptions:{

                color:"#31966c",

                weight:1,

                opacity:.4,

                fillOpacity:0

            }

        }

    );


miniMap.addTo(
    map
);


/* =========================================================
   LOAD SEMUA DATA
========================================================= */

loadSawah();

loadIrigasi();

loadTanah();


/* =========================================================
   INVALIDATE SIZE
========================================================= */

setTimeout(
    function(){

        map.invalidateSize();

    },
    500
);


/* =========================================================
   INVALIDATE KETIKA WINDOW RESIZE
========================================================= */

window.addEventListener(
    "resize",
    function(){

        setTimeout(
            function(){

                map.invalidateSize();

            },
            200
        );

    }
);

</script>


</body>

</html>