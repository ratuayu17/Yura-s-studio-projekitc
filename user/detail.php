<?php
session_start();
require '../admin/function.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tabel_film JOIN kategori ON tabel_film.id_kategori = kategori.id_kategori WHERE id_film = $id");
$fetch = mysqli_fetch_assoc($query);

$nama = $fetch['nama_film'];
$foto = $fetch['foto'];
if ($foto == null) {
    $img = 'Tidak ada foto';
} else {
    $img = '<img src="../admin/img/' . $foto . '" alt="Image" class="img-fluid mb-4">';
}
$jenis = $fetch['nama_kategori'];
$sutradara = $fetch['sutradara'];
$penulis = $fetch['penulis'];
$pemain = $fetch['pemain'];
$sinopsis = $fetch['sinopsis'];

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yura's Studio</title>
    <link rel="stylesheet" href="style2.css">
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
                    <a class="btn btn-dark rounded-pill me-3" href="../login/log_out.php" style="color: white; background-color: #EA168E;">
                        Log Out
                    </a>
                    </div>';
                }
            }


            ?>
        </div>
    </nav>

    <div class="section" style="background-image: white;">
        <div class="container">
            <div class="row d-flex justify-content-center" style="margin-top: 100px;">
                <div class="col-lg-6 d-flex justify-content-center">
                    <img src="../admin/img/<?= $foto; ?>" alt="Image" class="img-fluid mb-4" width="300px"><br>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="row">
                        <h3 class="h3"><?= $nama; ?></h3>
                        <p class="">Genre : <?= $jenis; ?></p>
                        <p class="">Sutradara : <?= $sutradara; ?></p>
                        <p class="">Penulis : <?= $penulis; ?></p>
                        <p class="">Cast : <?= $pemain; ?></p>
                        <p class="">Sinopsis : <?= $sinopsis; ?></p>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <a href="studio.php" class="btn btn-dark mt-3" style="width: 150px;">Lihat Studio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center" style="margin-top: 120px;">
        <p>Copyright 2023 By Yura's Studio</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>