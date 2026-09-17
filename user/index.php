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
Padi Seriti | WebGIS Pertanian Presisi
</title>


<!-- =====================================================
     BOOTSTRAP
===================================================== -->

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">


<!-- =====================================================
     FONT AWESOME
===================================================== -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<!-- =====================================================
     GOOGLE FONT
===================================================== -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap"
rel="stylesheet">


<!-- =====================================================
     CSS UTAMA
===================================================== -->

<link
rel="stylesheet"
href="../assets/css/style.css">


<style>

/* =====================================================
   GLOBAL
===================================================== */

:root{

    --green:#168a4a;
    --green-dark:#075d32;
    --green-deep:#03421f;
    --green-light:#eaf8ef;
    --gold:#efc85b;
    --gold-dark:#d6aa35;

    --dark:#10251a;
    --muted:#6d7b73;

    --white:#ffffff;

}


*{

    box-sizing:border-box;

}


html{

    scroll-behavior:smooth;

}


body{

    font-family:'Inter',sans-serif;

    background:#f5f8f6;

    color:var(--dark);

    overflow-x:hidden;

}



/* =====================================================
   HERO SLIDER
===================================================== */

.hero-slider{

    position:relative;

    width:100%;

    height:640px;

    overflow:hidden;

    background:#123c25;

}


/* =====================================================
   SLIDE
===================================================== */

.hero-slide{

    position:absolute;

    inset:0;

    width:100%;

    height:100%;

    background-size:cover;

    background-position:center;

    background-repeat:no-repeat;

    opacity:0;

    visibility:hidden;

    transform:scale(1.06);

    transition:

        opacity 1s ease,

        transform 6s ease,

        visibility 1s ease;

}


.hero-slide.active{

    opacity:1;

    visibility:visible;

    transform:scale(1);

}



/* =====================================================
   OVERLAY TAMBAHAN
===================================================== */

.hero-slide::after{

    content:"";

    position:absolute;

    inset:0;

    background:

        linear-gradient(
            90deg,
            rgba(0,30,15,.30),
            rgba(0,30,15,0)
        );

    pointer-events:none;

}



/* =====================================================
   HERO CONTENT
===================================================== */

.hero-slider-content{

    position:relative;

    z-index:5;

    height:100%;

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:flex-start;

    padding-top:20px;

    padding-bottom:50px;

}


.hero-slider-content h1{

    font-family:'Poppins',sans-serif;

    font-size:clamp(
        42px,
        6vw,
        76px
    );

    line-height:1.08;

    font-weight:800;

    color:#fff;

    max-width:850px;

    margin-bottom:24px;

    text-shadow:

        0 4px 20px
        rgba(0,0,0,.30);

}


.hero-slider-content h1 span{

    color:var(--gold);

}


.hero-slider-content p{

    color:

        rgba(
            255,
            255,
            255,
            .93
        );

    font-size:18px;

    line-height:1.8;

    max-width:710px;

    margin-bottom:32px;

    text-shadow:

        0 2px 8px
        rgba(0,0,0,.35);

}



/* =====================================================
   BADGE
===================================================== */

.hero-slider .hero-badge{

    display:inline-flex;

    align-items:center;

    gap:9px;

    padding:10px 18px;

    border-radius:50px;

    background:

        rgba(
            255,
            255,
            255,
            .14
        );

    border:

        1px solid
        rgba(
            255,
            255,
            255,
            .35
        );

    color:#fff;

    font-size:12px;

    font-weight:800;

    letter-spacing:1px;

    backdrop-filter:blur(12px);

    margin-bottom:22px;

}


.hero-slider .hero-badge i{

    color:var(--gold);

}



/* =====================================================
   HERO BUTTON
===================================================== */

.hero-buttons{

    display:flex;

    gap:14px;

    flex-wrap:wrap;

}


.btn-primary-custom{

    background:var(--gold);

    color:#143421;

    border:none;

    border-radius:12px;

    padding:14px 25px;

    font-weight:700;

    box-shadow:

        0 10px 30px
        rgba(0,0,0,.22);

    transition:.3s;

}


.btn-primary-custom:hover{

    background:#ffd96d;

    color:#143421;

    transform:translateY(-3px);

    box-shadow:

        0 15px 35px
        rgba(0,0,0,.28);

}


.btn-outline-light-custom{

    color:#fff;

    border:

        1px solid
        rgba(255,255,255,.65);

    border-radius:12px;

    padding:14px 25px;

    font-weight:600;

    background:

        rgba(255,255,255,.10);

    backdrop-filter:blur(10px);

    transition:.3s;

}


.btn-outline-light-custom:hover{

    background:#fff;

    color:var(--green-dark);

    transform:translateY(-3px);

}



/* =====================================================
   SLIDER DOTS
===================================================== */

.hero-dots{

    position:absolute;

    z-index:20;

    left:50%;

    bottom:32px;

    transform:translateX(-50%);

    display:flex;

    align-items:center;

    gap:9px;

}


.hero-dot{

    width:10px;

    height:10px;

    padding:0;

    border:none;

    border-radius:50%;

    background:

        rgba(255,255,255,.55);

    cursor:pointer;

    transition:.3s;

}


.hero-dot.active{

    width:34px;

    border-radius:20px;

    background:var(--gold);

}



/* =====================================================
   SLIDER ARROWS
===================================================== */

.hero-arrow{

    position:absolute;

    z-index:20;

    top:50%;

    transform:translateY(-50%);

    width:48px;

    height:48px;

    border-radius:50%;

    border:

        1px solid
        rgba(255,255,255,.35);

    background:

        rgba(0,0,0,.22);

    backdrop-filter:blur(8px);

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    cursor:pointer;

    transition:.3s;

}


.hero-arrow:hover{

    background:#fff;

    color:var(--green-dark);

    transform:

        translateY(-50%)
        scale(1.08);

}


.hero-prev{

    left:25px;

}


.hero-next{

    right:25px;

}



/* =====================================================
   STATISTIK
===================================================== */

.stats-section{

    position:relative;

    margin-top:-65px;

    z-index:30;

    padding-bottom:35px;

}


.stat-card{

    position:relative;

    height:100%;

    min-height:185px;

    padding:28px 24px;

    background:

        rgba(
            255,
            255,
            255,
            .97
        );

    border:

        1px solid
        rgba(255,255,255,.9);

    border-radius:22px;

    box-shadow:

        0 18px 45px
        rgba(19,65,39,.10),

        0 3px 10px
        rgba(0,0,0,.04);

    overflow:hidden;

    transition:.35s;

}


.stat-card::before{

    content:"";

    position:absolute;

    left:0;

    top:0;

    width:100%;

    height:4px;

    background:

        linear-gradient(
            90deg,
            var(--green),
            #64bd83,
            var(--gold)
        );

}


.stat-card:hover{

    transform:translateY(-8px);

    box-shadow:

        0 25px 55px
        rgba(19,65,39,.16);

}


.stat-icon{

    width:54px;

    height:54px;

    border-radius:16px;

    display:flex;

    align-items:center;

    justify-content:center;

    background:var(--green-light);

    color:var(--green);

    font-size:22px;

    margin-bottom:18px;

}


.stat-number{

    font-family:'Poppins',sans-serif;

    font-size:36px;

    font-weight:800;

    color:var(--dark);

    line-height:1;

    margin-bottom:9px;

}


.stat-label{

    color:var(--muted);

    font-size:14px;

    font-weight:600;

}



/* =====================================================
   STATUS DATA
===================================================== */

.data-status{

    margin-top:25px;

    text-align:center;

    font-size:13px;

    color:#75837b;

}


.status-dot{

    display:inline-block;

    width:8px;

    height:8px;

    border-radius:50%;

    background:#28a745;

    margin-right:7px;

    box-shadow:

        0 0 0 4px
        rgba(40,167,69,.12);

}



/* =====================================================
   INFORMATION SECTION
===================================================== */

.information-section{

    padding:80px 0 105px;

}


.section-heading{

    margin-bottom:50px;

}


.section-tag{

    display:inline-flex;

    align-items:center;

    gap:8px;

    color:var(--green);

    background:var(--green-light);

    padding:8px 15px;

    border-radius:50px;

    font-size:12px;

    font-weight:800;

    letter-spacing:.8px;

    margin-bottom:16px;

}


.section-heading h2{

    font-family:'Poppins',sans-serif;

    font-size:42px;

    font-weight:800;

    margin-bottom:13px;

}


.section-heading h2 span{

    color:var(--green);

}


.section-heading p{

    color:var(--muted);

    max-width:650px;

    margin:auto;

    line-height:1.75;

}



/* =====================================================
   INFO CARD
===================================================== */

.info-card{

    height:100%;

    padding:35px 30px;

    background:#fff;

    border-radius:24px;

    border:

        1px solid
        #e7eee9;

    box-shadow:

        0 15px 40px
        rgba(20,60,40,.07);

    transition:.35s;

    position:relative;

    overflow:hidden;

}


.info-card::after{

    content:"";

    position:absolute;

    width:130px;

    height:130px;

    border-radius:50%;

    background:var(--green-light);

    right:-60px;

    bottom:-60px;

    transition:.4s;

}


.info-card:hover{

    transform:translateY(-8px);

    border-color:#cce8d6;

    box-shadow:

        0 25px 55px
        rgba(20,80,45,.12);

}


.info-card:hover::after{

    transform:scale(1.5);

}


.info-icon{

    width:65px;

    height:65px;

    border-radius:18px;

    display:flex;

    align-items:center;

    justify-content:center;

    background:

        linear-gradient(
            135deg,
            #e8f8ee,
            #d5f0df
        );

    color:var(--green);

    font-size:26px;

    margin-bottom:23px;

}


.info-card h4{

    font-family:'Poppins',sans-serif;

    font-size:21px;

    font-weight:700;

    margin-bottom:13px;

}


.info-card p{

    color:var(--muted);

    line-height:1.75;

    margin-bottom:22px;

}


.info-card a{

    position:relative;

    z-index:2;

    color:var(--green);

    text-decoration:none;

    font-weight:700;

    font-size:14px;

}


.info-card a i{

    margin-left:7px;

    transition:.25s;

}


.info-card:hover a i{

    transform:translateX(5px);

}



/* =====================================================
   MOBILE
===================================================== */

@media(max-width:768px){

    .hero-slider{

        height:600px;

    }


    .hero-slider-content{

        padding-left:25px;

        padding-right:25px;

    }


    .hero-slider-content h1{

        font-size:42px;

    }


    .hero-slider-content p{

        font-size:15px;

        line-height:1.7;

    }


    .hero-arrow{

        width:40px;

        height:40px;

    }


    .hero-prev{

        left:12px;

    }


    .hero-next{

        right:12px;

    }


    .stats-section{

        margin-top:-40px;

    }


    .stat-card{

        min-height:160px;

        padding:22px 18px;

    }


    .stat-number{

        font-size:30px;

    }


    .section-heading h2{

        font-size:32px;

    }

}


@media(max-width:480px){

    .hero-slider{

        height:620px;

    }


    .hero-slider-content h1{

        font-size:36px;

    }


    .hero-slider-content p{

        font-size:14px;

    }


    .hero-buttons{

        width:100%;

        flex-direction:column;

    }


    .hero-buttons a{

        width:100%;

        text-align:center;

    }

}

</style>

</head>



<body>


<?php include "header.php"; ?>



<!-- =====================================================
     HERO SLIDER
===================================================== -->

<section
class="hero-slider"
id="beranda">


    <!-- =================================================
         SLIDE 1
    ================================================== -->

    <div
    class="hero-slide active"
    style="
    background-image:
    linear-gradient(
        90deg,
        rgba(3,55,29,.92),
        rgba(3,75,39,.60),
        rgba(0,0,0,.15)
    ),
url('../assets/hero/hero1.png');
    ">


        <div class="container hero-slider-content">


            <div class="hero-badge">

                <i class="fa-solid fa-location-dot"></i>

                DESA SERITI

            </div>


            <h1>

                WebGIS Pertanian

                <span>Presisi</span>

                Padi Sawah

            </h1>


            <p>

                Sistem informasi geografis berbasis web
                untuk memetakan, memantau dan menyajikan
                informasi lahan padi sawah Desa Seriti
                secara interaktif dan terintegrasi.

            </p>


            <div class="hero-buttons">


                <a
                href="peta.php"
                class="btn btn-primary-custom">

                    <i
                    class="fa-solid fa-map-location-dot me-2">
                    </i>

                    Jelajahi Peta

                </a>


                <a
                href="informasi.php"
                class="btn btn-outline-light-custom">

                    <i
                    class="fa-solid fa-circle-info me-2">
                    </i>

                    Pelajari Sistem

                </a>


            </div>


        </div>

    </div>



    <!-- =================================================
         SLIDE 2
    ================================================== -->

    <div
    class="hero-slide"
    style="
    background-image:
    linear-gradient(
        90deg,
        rgba(3,55,29,.92),
        rgba(3,75,39,.60),
        rgba(0,0,0,.15)
    ),
url('../assets/hero/hero2.png');
    ">


        <div class="container hero-slider-content">


            <div class="hero-badge">

                <i class="fa-solid fa-seedling"></i>

                LAHAN PADI SAWAH

            </div>


            <h1>

                Pemetaan Lahan

                <span>Padi Sawah</span>

                Desa Seriti

            </h1>


            <p>

                Menampilkan lokasi dan informasi
                setiap petak lahan sawah secara
                spasial melalui peta interaktif.

            </p>


            <div class="hero-buttons">


                <a
                href="peta.php"
                class="btn btn-primary-custom">

                    <i class="fa-solid fa-map me-2"></i>

                    Buka Peta Sawah

                </a>


            </div>


        </div>

    </div>



    <!-- =================================================
         SLIDE 3
    ================================================== -->

    <div
    class="hero-slide"
    style="
    background-image:
    linear-gradient(
        90deg,
        rgba(3,55,29,.92),
        rgba(3,75,39,.60),
        rgba(0,0,0,.15)
    ),
url('../assets/hero/hero3.png');
    ">


        <div class="container hero-slider-content">


            <div class="hero-badge">

                <i class="fa-solid fa-chart-line"></i>

                PERTANIAN PRESISI

            </div>


            <h1>

                Data Pertanian

                <span>Terintegrasi</span>

            </h1>


            <p>

                Mengintegrasikan data lahan,
                produksi, varietas, irigasi dan
                jenis tanah dalam satu sistem WebGIS.

            </p>


            <div class="hero-buttons">


                <a
                href="informasi.php"
                class="btn btn-primary-custom">

                    <i class="fa-solid fa-circle-info me-2"></i>

                    Lihat Informasi

                </a>


            </div>


        </div>

    </div>



    <!-- =================================================
         TOMBOL SEBELUMNYA
    ================================================== -->

    <button
    type="button"
    class="hero-arrow hero-prev"
    onclick="changeSlide(-1)"
    aria-label="Slide sebelumnya">

        <i class="fa-solid fa-chevron-left"></i>

    </button>



    <!-- =================================================
         TOMBOL SELANJUTNYA
    ================================================== -->

    <button
    type="button"
    class="hero-arrow hero-next"
    onclick="changeSlide(1)"
    aria-label="Slide berikutnya">

        <i class="fa-solid fa-chevron-right"></i>

    </button>



    <!-- =================================================
         DOT NAVIGATION
    ================================================== -->

    <div class="hero-dots">


        <button
        type="button"
        class="hero-dot active"
        onclick="showSlide(0)"
        aria-label="Slide 1">
        </button>


        <button
        type="button"
        class="hero-dot"
        onclick="showSlide(1)"
        aria-label="Slide 2">
        </button>


        <button
        type="button"
        class="hero-dot"
        onclick="showSlide(2)"
        aria-label="Slide 3">
        </button>


    </div>


</section>



<!-- =====================================================
     STATISTIK
===================================================== -->

<section class="stats-section">

<div class="container">


<div class="row g-3 g-md-4">


    <!-- ================================================
         STATISTIK SAWAH
    ================================================= -->

    <div class="col-md-3 col-6">

        <div class="stat-card">


            <div class="stat-icon">

                <i class="fa-solid fa-seedling"></i>

            </div>


            <div
            class="stat-number"
            id="statSawah">

                0

            </div>


            <div class="stat-label">

                Lahan Sawah

            </div>


        </div>

    </div>



    <!-- ================================================
         STATISTIK IRIGASI
    ================================================= -->

    <div class="col-md-3 col-6">

        <div class="stat-card">


            <div class="stat-icon">

                <i class="fa-solid fa-water"></i>

            </div>


            <div
            class="stat-number"
            id="statIrigasi">

                0

            </div>


            <div class="stat-label">

                Jaringan Irigasi

            </div>


        </div>

    </div>



    <!-- ================================================
         STATISTIK TANAH
    ================================================= -->

    <div class="col-md-3 col-6">

        <div class="stat-card">


            <div class="stat-icon">

                <i class="fa-solid fa-mountain"></i>

            </div>


            <div
            class="stat-number"
            id="statTanah">

                0

            </div>


            <div class="stat-label">

                Jenis Tanah

            </div>


        </div>

    </div>



    <!-- ================================================
         STATISTIK LAYER
    ================================================= -->

    <div class="col-md-3 col-6">

        <div class="stat-card">


            <div class="stat-icon">

                <i class="fa-solid fa-layer-group"></i>

            </div>


            <div
            class="stat-number"
            id="statLayer">

                4

            </div>


            <div class="stat-label">

                Layer Peta

            </div>


        </div>

    </div>


</div>



<div class="data-status">

    <span class="status-dot"></span>

    Data peta terhubung dengan sistem WebGIS

</div>


</div>

</section>



<!-- =====================================================
     INFORMASI
===================================================== -->

<section class="information-section">

<div class="container">


    <!-- HEADING -->

    <div class="section-heading text-center">


        <div class="section-tag">

            <i class="fa-solid fa-circle-info"></i>

            WEBGIS PERTANIAN

        </div>


        <h2>

            Data Pertanian

            <span>Terintegrasi</span>

        </h2>


        <p>

            Seluruh data pertanian Desa Seriti
            dapat dilihat melalui peta interaktif
            berbasis sistem informasi geografis.

        </p>


    </div>



    <!-- =================================================
         CARD
    ================================================== -->

    <div class="row g-4">


        <!-- =============================================
             LAHAN SAWAH
        ============================================== -->

        <div class="col-lg-4">

            <div class="info-card">


                <div class="info-icon">

                    <i class="fa-solid fa-seedling"></i>

                </div>


                <h4>

                    Lahan Sawah

                </h4>


                <p>

                    Informasi lokasi lahan, luas,
                    varietas padi, produksi,
                    kelompok tani, kondisi irigasi
                    dan jenis tanah.

                </p>


                <a href="peta.php">

                    Lihat pada peta

                    <i
                    class="fa-solid fa-arrow-right">
                    </i>

                </a>


            </div>

        </div>



        <!-- =============================================
             IRIGASI
        ============================================== -->

        <div class="col-lg-4">

            <div class="info-card">


                <div class="info-icon">

                    <i class="fa-solid fa-water"></i>

                </div>


                <h4>

                    Jaringan Irigasi

                </h4>


                <p>

                    Informasi jaringan irigasi,
                    panjang jaringan, kondisi,
                    sumber air dan keterangan
                    infrastruktur.

                </p>


                <a href="peta.php">

                    Lihat pada peta

                    <i
                    class="fa-solid fa-arrow-right">
                    </i>

                </a>


            </div>

        </div>



        <!-- =============================================
             JENIS TANAH
        ============================================== -->

        <div class="col-lg-4">

            <div class="info-card">


                <div class="info-icon">

                    <i class="fa-solid fa-mountain"></i>

                </div>


                <h4>

                    Jenis Tanah

                </h4>


                <p>

                    Informasi persebaran jenis
                    tanah serta karakteristiknya
                    untuk mendukung pengelolaan
                    lahan pertanian.

                </p>


                <a href="peta.php">

                    Lihat pada peta

                    <i
                    class="fa-solid fa-arrow-right">
                    </i>

                </a>


            </div>

        </div>


    </div>


</div>

</section>



<!-- =====================================================
     FOOTER
===================================================== -->

<?php include "footer.php"; ?>



<!-- =====================================================
     BOOTSTRAP JS
===================================================== -->

<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>



<!-- =====================================================
     HERO SLIDER JAVASCRIPT
===================================================== -->

<script>

let currentSlide = 0;

let sliderTimer = null;


/* Ambil semua slide */

const slides =
    document.querySelectorAll(
        ".hero-slide"
    );


/* Ambil semua titik */

const dots =
    document.querySelectorAll(
        ".hero-dot"
    );



/* =====================================================
   MENAMPILKAN SLIDE
===================================================== */

function showSlide(index){

    if(!slides.length){

        return;

    }


    /* Jika melebihi jumlah slide */

    if(index >= slides.length){

        currentSlide = 0;

    }


    /* Jika kurang dari 0 */

    else if(index < 0){

        currentSlide =
            slides.length - 1;

    }


    else{

        currentSlide = index;

    }



    /* Hilangkan active dari semua */

    slides.forEach(
        function(slide){

            slide.classList.remove(
                "active"
            );

        }
    );



    dots.forEach(
        function(dot){

            dot.classList.remove(
                "active"
            );

        }
    );



    /* Aktifkan slide */

    slides[currentSlide]
        .classList.add(
            "active"
        );



    /* Aktifkan dot */

    if(dots[currentSlide]){

        dots[currentSlide]
            .classList.add(
                "active"
            );

    }

}



/* =====================================================
   NEXT / PREVIOUS
===================================================== */

function changeSlide(direction){

    showSlide(
        currentSlide + direction
    );


    restartSlider();

}



/* =====================================================
   AUTO SLIDER
===================================================== */

function startSlider(){

    sliderTimer =
        setInterval(
            function(){

                showSlide(
                    currentSlide + 1
                );

            },
            5000
        );

}



function stopSlider(){

    if(sliderTimer){

        clearInterval(
            sliderTimer
        );

        sliderTimer = null;

    }

}



function restartSlider(){

    stopSlider();

    startSlider();

}



/* =====================================================
   PAUSE SAAT MOUSE DI HERO
===================================================== */

const heroSlider =
    document.querySelector(
        ".hero-slider"
    );


if(heroSlider){

    heroSlider.addEventListener(
        "mouseenter",
        function(){

            stopSlider();

        }
    );


    heroSlider.addEventListener(
        "mouseleave",
        function(){

            startSlider();

        }
    );

}



/* =====================================================
   SWIPE UNTUK HP
===================================================== */

let touchStartX = 0;

let touchEndX = 0;


if(heroSlider){

    heroSlider.addEventListener(
        "touchstart",
        function(event){

            touchStartX =
                event.changedTouches[0].screenX;

        },
        {
            passive:true
        }
    );


    heroSlider.addEventListener(
        "touchend",
        function(event){

            touchEndX =
                event.changedTouches[0].screenX;


            const distance =
                touchEndX - touchStartX;


            if(Math.abs(distance) > 50){

                if(distance < 0){

                    changeSlide(1);

                }
                else{

                    changeSlide(-1);

                }

            }

        },
        {
            passive:true
        }
    );

}



/* =====================================================
   MULAI SLIDER
===================================================== */

showSlide(0);

startSlider();

</script>



<!-- =====================================================
     STATISTIK API
===================================================== -->

<script>

async function loadStatistics(){

    try{


        /* ==============================================
           AMBIL API SAWAH
        ============================================== */

        const responseSawah =
            await fetch(
                "../api/sawah.php",
                {
                    cache:"no-store"
                }
            );


        /* ==============================================
           AMBIL API IRIGASI
        ============================================== */

        const responseIrigasi =
            await fetch(
                "../api/irigasi.php",
                {
                    cache:"no-store"
                }
            );


        /* ==============================================
           AMBIL API TANAH
        ============================================== */

        const responseTanah =
            await fetch(
                "../api/tanah.php",
                {
                    cache:"no-store"
                }
            );



        /* ==============================================
           CEK RESPONSE
        ============================================== */

        if(!responseSawah.ok){

            throw new Error(
                "API sawah tidak dapat diakses"
            );

        }


        if(!responseIrigasi.ok){

            throw new Error(
                "API irigasi tidak dapat diakses"
            );

        }


        if(!responseTanah.ok){

            throw new Error(
                "API tanah tidak dapat diakses"
            );

        }



        /* ==============================================
           PARSE JSON
        ============================================== */

        const sawah =
            await responseSawah.json();


        const irigasi =
            await responseIrigasi.json();


        const tanah =
            await responseTanah.json();



        /* ==============================================
           NORMALISASI DATA
        ============================================== */

        function normalizeData(result){

            /* Jika API mengembalikan array */

            if(
                Array.isArray(result)
            ){

                return result;

            }


            /* Jika API mengembalikan
               GeoJSON FeatureCollection */

            if(
                result &&
                Array.isArray(
                    result.features
                )
            ){

                return result.features;

            }


            /* Jika API mengembalikan
               {data:[]} */

            if(
                result &&
                Array.isArray(
                    result.data
                )
            ){

                return result.data;

            }


            return [];

        }



        /* ==============================================
           DATA FINAL
        ============================================== */

        const dataSawah =
            normalizeData(
                sawah
            );


        const dataIrigasi =
            normalizeData(
                irigasi
            );


        const dataTanah =
            normalizeData(
                tanah
            );



        /* ==============================================
           TAMPILKAN STATISTIK
        ============================================== */

        animateNumber(
            "statSawah",
            dataSawah.length
        );


        animateNumber(
            "statIrigasi",
            dataIrigasi.length
        );


        animateNumber(
            "statTanah",
            dataTanah.length
        );



        /* ==============================================
           DEBUG CONSOLE
        ============================================== */

        console.log(
            "Jumlah lahan sawah:",
            dataSawah.length
        );


        console.log(
            "Jumlah jaringan irigasi:",
            dataIrigasi.length
        );


        console.log(
            "Jumlah jenis tanah:",
            dataTanah.length
        );


    }

    catch(error){

        console.error(
            "Gagal mengambil statistik:",
            error
        );


        document.getElementById(
            "statSawah"
        ).innerText = "-";


        document.getElementById(
            "statIrigasi"
        ).innerText = "-";


        document.getElementById(
            "statTanah"
        ).innerText = "-";

    }

}



/* =====================================================
   ANIMASI ANGKA
===================================================== */

function animateNumber(
    elementId,
    target
){

    const element =
        document.getElementById(
            elementId
        );


    if(!element){

        return;

    }


    let start = 0;

    const duration = 1000;

    const startTime =
        performance.now();



    function update(currentTime){

        const progress =
            Math.min(
                (
                    currentTime -
                    startTime
                ) / duration,
                1
            );


        const eased =
            1 -
            Math.pow(
                1 - progress,
                3
            );


        const value =
            Math.floor(
                start +
                (
                    target -
                    start
                ) *
                eased
            );


        element.innerText =
            value.toLocaleString(
                "id-ID"
            );


        if(progress < 1){

            requestAnimationFrame(
                update
            );

        }

        else{

            element.innerText =
                target.toLocaleString(
                    "id-ID"
                );

        }

    }


    requestAnimationFrame(
        update
    );

}



/* =====================================================
   JALANKAN STATISTIK
===================================================== */

document.addEventListener(
    "DOMContentLoaded",
    function(){

        loadStatistics();

    }
);

</script>


</body>

</html>