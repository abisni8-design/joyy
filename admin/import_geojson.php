<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
require_once '../config/database.php';

$allowed = ['sawah','irigasi','tanah'];
$type = $_GET['type'] ?? $_POST['type'] ?? 'sawah';
if (!in_array($type, $allowed, true)) $type = 'sawah';

$labels = ['sawah'=>'Lahan Sawah','irigasi'=>'Jaringan Irigasi','tanah'=>'Jenis Tanah'];
$error = '';
$success = '';

function prop($props, $keys, $default='') {
    $normalized = [];
    foreach ($props as $k=>$v) $normalized[strtolower(trim((string)$k))] = is_scalar($v) ? (string)$v : json_encode($v, JSON_UNESCAPED_UNICODE);
    foreach ($keys as $key) {
        $k = strtolower($key);
        if (isset($normalized[$k]) && trim($normalized[$k]) !== '') return trim($normalized[$k]);
    }
    return $default;
}
function numprop($props, $keys, $default=0) {
    $v = prop($props, $keys, '');
    $v = str_replace(',', '.', preg_replace('/[^0-9,.-]/', '', $v));
    return is_numeric($v) ? (float)$v : $default;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['geojson']) || $_FILES['geojson']['error'] !== UPLOAD_ERR_OK) {
        $error = 'Pilih file GeoJSON terlebih dahulu.';
    } else {
        $ext = strtolower(pathinfo($_FILES['geojson']['name'], PATHINFO_EXTENSION));
        if ($ext !== 'geojson' && $ext !== 'json') {
            $error = 'File harus berformat .geojson atau .json.';
        } else {
            $raw = file_get_contents($_FILES['geojson']['tmp_name']);
            $json = json_decode($raw, true);
            if (!$json || !isset($json['type'])) {
                $error = 'Isi file GeoJSON tidak valid.';
            } else {
                if ($json['type'] === 'FeatureCollection') $features = $json['features'] ?? [];
                elseif ($json['type'] === 'Feature') $features = [$json];
                else $features = [];
                if (!$features) $error = 'GeoJSON tidak memiliki feature yang dapat diimpor.';
                else {
                    try {
                        $pdo->beginTransaction();
                        $count = 0;
                        foreach ($features as $idx=>$feature) {
                            $geometry = $feature['geometry'] ?? null;
                            if (!$geometry || !isset($geometry['type'])) continue;
                            $props = is_array($feature['properties'] ?? null) ? $feature['properties'] : [];
                            $geom = json_encode($geometry, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                            if ($type === 'sawah') {
                                $name = prop($props, ['nama_lahan','nama','name','namalahan'], 'Lahan Sawah '.($idx+1));
                                $sql = 'INSERT INTO sawah (nama_lahan,luas,varietas,produksi,kelompok_tani,kondisi_irigasi,jenis_tanah,keterangan,geometry) VALUES (?,?,?,?,?,?,?,?,?)';
                                $pdo->prepare($sql)->execute([$name,numprop($props,['luas','luas_ha','area'],0),prop($props,['varietas','varietas_padi','jenis_varietas']),numprop($props,['produksi','produksi_ton','prod'],0),prop($props,['kelompok_tani','poktan','kelompok']),prop($props,['kondisi_irigasi','irigasi','kondisi']),prop($props,['jenis_tanah','tanah','soil']),prop($props,['keterangan','ket','description']),$geom]);
                            } elseif ($type === 'irigasi') {
                                $name = prop($props, ['nama_irigasi','nama','name','irigasi'], 'Irigasi '.($idx+1));
                                $sql = 'INSERT INTO irigasi (nama_irigasi,panjang,kondisi,sumber_air,keterangan,geometry) VALUES (?,?,?,?,?,?)';
                                $pdo->prepare($sql)->execute([$name,numprop($props,['panjang','length','panjang_m'],0),prop($props,['kondisi','condition']),prop($props,['sumber_air','sumber','source']),prop($props,['keterangan','ket','description']),$geom]);
                            } else {
                                $name = prop($props, ['jenis_tanah','jenis','nama','name','soil'], 'Jenis Tanah '.($idx+1));
                                $sql = 'INSERT INTO tanah (jenis_tanah,luas,karakteristik,keterangan,geometry) VALUES (?,?,?,?,?)';
                                $pdo->prepare($sql)->execute([$name,numprop($props,['luas','luas_ha','area'],0),prop($props,['karakteristik','karakter','characteristic']),prop($props,['keterangan','ket','description']),$geom]);
                            }
                            $count++;
                        }
                        $pdo->commit();
                        $success = "Berhasil mengimpor $count feature ke data {$labels[$type]}.";
                    } catch (Throwable $e) {
                        if ($pdo->inTransaction()) $pdo->rollBack();
                        $error = 'Gagal mengimpor data: '.$e->getMessage();
                    }
                }
            }
        }
    }
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Import GeoJSON | Padi Seriti</title><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"><link rel="stylesheet" href="admin.css"></head><body class="admin-page"><div class="admin-shell"><?php $admin_root='.';$active=$type; include 'sidebar.php'; ?><main class="admin-main"><div class="topbar"><div><div class="eyebrow">DATA SPASIAL</div><h1>Import GeoJSON</h1></div><a href="<?=$type?>/index.php" class="btn-back">← Kembali</a></div><?php if($success):?><div class="alert alert-success"><?=htmlspecialchars($success)?></div><?php endif;?><?php if($error):?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif;?><div class="import-card"><div class="section-head"><div class="section-icon"><i class="fa-solid fa-file-import"></i></div><div><h3>Import <?=$labels[$type]?></h3><p>Upload satu FeatureCollection untuk memasukkan banyak data.</p></div></div><form method="post" enctype="multipart/form-data"><input type="hidden" name="type" value="<?=$type?>"><div class="field mb-3"><label>File GeoJSON <span>*</span></label><input type="file" name="geojson" accept=".geojson,.json,application/geo+json,application/json" required><small>FeatureCollection dapat berisi banyak feature. Atribut yang cocok dengan kolom database akan dipetakan otomatis.</small></div><p class="import-help">Maksimal 10 MB. Untuk satu data gunakan tombol Tambah Data pada masing-masing modul.</p><div class="d-flex justify-content-end gap-2"><a href="<?=$type?>/index.php" class="btn-cancel">Batal</a><button class="btn-save" type="submit"><i class="fa-solid fa-upload"></i> Import Data</button></div></form></div></main></div></body></html>