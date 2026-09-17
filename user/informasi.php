<?php
require_once "../config/database.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Informasi | Padi Seriti
</title>


<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">


<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<link
href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap"
rel="stylesheet">


<link
rel="stylesheet"
href="../assets/css/style.css">

</head>


<body>


<?php include "header.php"; ?>


<section
class="information-section"
style="padding-top:150px;min-height:80vh;">

<div class="container">


<div class="section-heading text-center">

<div class="section-tag">

<i class="fa-solid fa-circle-info"></i>

INFORMASI

</div>


<h2>

Data Pertanian

<span>Terintegrasi</span>

</h2>


<p>

WebGIS Pertanian Presisi Padi Sawah Desa Seriti
mengintegrasikan data spasial dengan data
atribut pertanian.

</p>

</div>



<div class="row g-4">


<div class="col-lg-4">

<div class="info-card">

<div class="info-icon">

<i class="fa-solid fa-seedling"></i>

</div>


<h4>
Data Lahan Sawah
</h4>


<p>

Data lahan sawah digunakan untuk mengetahui
lokasi, luas, varietas, produksi, kelompok tani,
serta informasi pendukung lainnya.

</p>


<a href="peta.php">

Lihat pada peta

<i class="fa-solid fa-arrow-right"></i>

</a>

</div>

</div>



<div class="col-lg-4">

<div class="info-card">

<div class="info-icon">

<i class="fa-solid fa-water"></i>

</div>


<h4>
Jaringan Irigasi
</h4>


<p>

Layer jaringan irigasi menampilkan lokasi
jaringan, panjang, sumber air, kondisi,
dan keterangan jaringan.

</p>


<a href="peta.php">

Lihat pada peta

<i class="fa-solid fa-arrow-right"></i>

</a>

</div>

</div>



<div class="col-lg-4">

<div class="info-card">

<div class="info-icon">

<i class="fa-solid fa-mountain"></i>

</div>


<h4>
Jenis Tanah
</h4>


<p>

Layer jenis tanah memberikan informasi
spasial mengenai persebaran tanah
yang terdapat di wilayah Desa Seriti.

</p>


<a href="peta.php">

Lihat pada peta

<i class="fa-solid fa-arrow-right"></i>

</a>

</div>

</div>


</div>

</div>

</section>


<?php include "footer.php"; ?>


<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>