<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">

    <div class="container">

        <a class="navbar-brand d-flex align-items-center"
           href="index.php">

            <div class="brand-icon">
                <i class="fa-solid fa-wheat-awn"></i>
            </div>

            <div class="ms-2">

                <div class="brand-title">
                    PADI SERITI
                </div>

                <small>
                    Precision Agriculture GIS
                </small>

            </div>

        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div
            class="collapse navbar-collapse"
            id="navbarMenu">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="index.php">
                        Beranda
                    </a>
                </li>


                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="peta.php">
                        Peta
                    </a>
                </li>


                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="informasi.php">
                        Informasi
                    </a>
                </li>


                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="tentang.php">
                        Tentang
                    </a>
                </li>


                <li class="nav-item ms-lg-3">

                    <a
                        href="../admin/login.php"
                        class="btn btn-admin">

                        <i class="fa-solid fa-lock me-2"></i>

                        Admin

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>