<?php
session_start();
require '../admin/function.php';

$kategori = mysqli_query($conn, "SELECT * FROM kategori");

if (isset($_GET['keyword']) and isset($_GET['filter'])) {
    $key = $_GET['keyword'];
    $filter = $_GET['filter'];
    if ($_GET['filter'] == 'all') {
        $sql = mysqli_query($conn, "SELECT * FROM tabel_film JOIN kategori ON tabel_film.id_kategori = kategori.id_kategori WHERE nama_film LIKE '%$key%'"); // SEARCH
    } else {
        $sql = mysqli_query($conn, "SELECT * FROM tabel_film JOIN kategori ON tabel_film.id_kategori = kategori.id_kategori WHERE nama_film LIKE '%$key%' AND id_kategori = '$filter'"); // SEARCH dan FILTER   
    }
} else {
    $sql = mysqli_query($conn, "SELECT * FROM tabel_film JOIN kategori ON tabel_film.id_kategori = kategori.id_kategori"); // ALL
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yura's Studio</title>
    <link rel="stylesheet" href="tampilan.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg py-3 " style="background-color: black;">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="#" style="color: white;">Yura's Studio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php
            if (!isset($_SESSION['email'])) {
                echo
                '<div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="tampilan2.php" style="color: white;">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php" style="color: white;">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="studio.php" style="color: white;">Studio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="kontak.php" style="color: white;">Kontak</a>
                    </li>
                </ul>
                <a class="btn btn-dark rounded-pill me-3" href="../login/login.php" style="color: white; background-color: #EA168E;">
                    Login | Register
                </a>
                </div>';
            } else {
                $role = $_SESSION['role_akun'];
                if ($role == 2) {
                    echo
                    '<div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="tampilan2.php" style="color: white;">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="about.php" style="color: white;">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="list_tiket.php" style="color: white;">Tiket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="studio.php" style="color: white;">Studio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="kontak.php" style="color: white;">Kontak</a>
                        </li>
                    </ul>
                    <a class="btn rounded-pill me-3" href="../login/log_out.php" style="color: white; background-color: #EA168E;">
                        Log Out
                    </a>
                    </div>';
                }
            }


            ?>
        </div>
    </nav>

    <!-- section 1 -->
    <div class="sec">
        <section class="section1">
            <h1 class="text-center h1" style="color: white;">SELAMAT DATANG DI<br>YURA'S STUDIO</h1>
            <a href="#film" class="btn btn-dark button">Lihat Film</a>
        </section>
    </div>



    <section class="section" id="film">
        <div class="container">
            <div class="row mt-5">
                <h1 class="text-center my-5">Film Yang Tersedia</h1>
                <?php foreach ($sql as $data) : ?>
                    <div class="card mb-3 ms-3" style="max-width: 540px;">
                        <div class="row g-0 ">
                            <div class="col-md-4">
                                <img style="margin-left: -12px;" src="../admin/img/<?= $data['foto'];?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $data['nama_film'];?></h5>
                                    <p class="card-text"><?= $data['nama_kategori'];?></p>
                                    <a href="detail.php?id=<?= $data['id_film']; ?>" class="btn" style="margin-top: 95px; color: white; background-color:#EA168E;">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <footer class="text-center mt-5 pt-3">
        <p>Copyright 2023 By Yura's Studio</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>