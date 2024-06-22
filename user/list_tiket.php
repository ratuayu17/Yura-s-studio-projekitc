<?php
session_start();
require '../admin/function.php';

$user = $_SESSION['email'];
$list = mysqli_query($conn, "SELECT pemesanan.id_pesan, studio.nama_studio, tabel_film.nama_film, pemesanan.tanggal, pemesanan.jumlah, pemesanan.email_user, tabel_film.jam_tayang, pemesanan.status_validasi FROM pemesanan JOIN studio ON pemesanan.id_studio = studio.id_studio JOIN users ON users.id_user = pemesanan.id_user JOIN tabel_film ON tabel_film.id_film = studio.id_film WHERE pemesanan.email_user = '$user'");
$no = 1;

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YuraLand</title>
    <link rel="stylesheet" href="style.css">
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

    <!-- section -->
        <div class="container">
            <div class="row d-flex justify-content-center mt-4">
                <div class="col-md-6 text-center">
                    <h3 class="mb-4">Tiket</h3>
                    <div class="table">
                        <table class="table table-bordered border-dark ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Studio</th>
                                    <th>Nama Film</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Jam Tayang</th>
                                    <th>Status Bayar</th>
                                    <th>Status Tiket</th>
                                </tr>
                            </thead>
                            <?php foreach ($list as $tiket) : ?>
                                <tbody>
                                    <tr class="">
                                        <td><?= $no++; ?></td>
                                        <td><?= $tiket['nama_studio']; ?></td>
                                        <td><?= $tiket['nama_film']; ?></td>
                                        <td><?= $tiket['tanggal']; ?></td>
                                        <td>1</td>
                                        <td><?= $tiket['jam_tayang']; ?></td>
                                        <td>
                                            <?php
                                            if ($tiket['status_validasi'] == 0) {
                                                echo '<a href="bayar.php?id_bayar=' . $tiket["id_pesan"] . '" class="btn btn-primary"> Klik Untuk Bayar </a>';
                                            } else if ($tiket['status_validasi'] == 1){
                                                echo '<a href="" class="btn btn-light disable">Menunggu Verifikasi</a>';
                                            } else if($tiket['status_validasi'] == 2){
                                                echo '<a href="" class="btn btn-danger">Pembayaran Gagal, Silakan Pesan Kembali</a>';
                                            } else {
                                                echo "<a href='' class='btn btn-success'disable> Sudah bayar </a>";
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($tiket['status_validasi'] == 0) {
                                                echo '<a href="" class="btn btn-warning"> Pending</a>';
                                            } else if($tiket['status_validasi'] == 1){
                                                echo '<a href="" class="btn btn-warning"> Pending</a>';
                                            } else if($tiket['status_validasi'] == 2){
                                                echo '<a href="" class="btn btn-warning"> Pending</a>';
                                            } else if($tiket['status_validasi'] == 3){
                                                echo '<a href="cetak_tiket.php?id=' . $tiket["id_pesan"] . '" class="btn btn-outline-success">Cetak Tiket</a>';
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                        </table> 
                    </div>

                </div>
            </div>
        </div>

    <footer class="text-center pt-3" style="margin-top: 65px;">
        <p>Copyright 2023 By Yura's Studio</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>