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
Tentang | Padi Seriti
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
class="about-section"
style="padding-top:150px;min-height:80vh;">

<div class="container">

<div class="row align-items-center g-5">


<div class="col-lg-6">

<div class="about-image">

<div class="about-image-content">

<i class="fa-solid fa-map-location-dot"></i>

<span>
GIS
</span>

</div>

</div>

</div>



<div class="col-lg-6">


<div class="section-tag">

<i class="fa-solid fa-leaf"></i>

TENTANG SISTEM

</div>


<h2>

Teknologi untuk

<span>Pertanian Lebih Cerdas</span>

</h2>


<p>

WebGIS Pertanian Presisi Padi Sawah
Desa Seriti merupakan sistem informasi
geografis berbasis web yang digunakan
untuk menyajikan informasi spasial
pertanian secara interaktif.

</p>


<div class="about-list">


<div>

<i class="fa-solid fa-check"></i>

Pemetaan lahan padi sawah

</div>


<div>

<i class="fa-solid fa-check"></i>

Informasi atribut setiap lahan

</div>


<div>

<i class="fa-solid fa-check"></i>

Pemetaan jaringan irigasi

</div>


<div>

<i class="fa-solid fa-check"></i>

Informasi jenis tanah

</div>


<div>

<i class="fa-solid fa-check"></i>

Pengelolaan data oleh administrator

</div>


</div>


<div class="mt-4">

<a
href="peta.php"
class="btn btn-primary-custom">

<i class="fa-solid fa-map me-2"></i>

Buka Peta

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