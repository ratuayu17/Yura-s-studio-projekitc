<?php
session_start();
require '../admin/function.php';

if ($_SESSION['login'] !== true) {
    echo "<script>
    alert('Login terlebih dahulu');
	document.location.href = '../login/login.php';
	</script>";
}

$id_studio = $_GET['id_mesan'];
$bangku_film = mysqli_query($conn, "SELECT * FROM tabel_bangku");
$pesanan = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id_studio = '$id_studio'");
$data_pesan = mysqli_fetch_array($pesanan);

if (isset($_POST['pesan'])) {
    global $conn;

    $bangku = $_POST['tabel_bangku'];
    $id = $_POST['id_studio'];
    $id_user = $_SESSION['role_akun'];
    $user = $_SESSION['email'];
    $tgl = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    for ($a = 0; $a < count($bangku); $a++) {
        $sql = mysqli_query($conn, "INSERT INTO pemesanan VALUES (NULL,'$id', '$id_user','$user','$tgl','$jumlah', '$bangku[$a]', 0)");
    }


    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
		alert('Pemesanan Berhasil Di tambah!');
		document.location.href = 'list_tiket.php';
		</script>";
    } else {
        echo "<script>
		alert('Pemesanan Gagal Di tambah!');
		document.location.href = 'studio.php';
		</script>";
    }
}


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
            <a class="navbar-brand ms-3" href="#" style="color: white;">YuraLand</a>
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
                        <a class="nav-link active" href="galeri.php" style="color: white;">Galeri</a>
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

    <div class="section" id="app">
        <div class="container">
            <div class="row d-flex justify-content-center mt-3">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h3 class="text-center my-3">Form Pemesanan Tiket</h3>
                    <form action="" method="post">
                        <input type="hidden" name="id_studio" value="<?= $id_studio; ?>">
                        <div class="mb-3">
                            <label for="tgl" class="form-label">Tanggal</label>
                            <input type="text" name="tanggal" id="tgl" class="form-control border-dark" value="<?= date('d-m-Y') ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Bangku</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control border-dark" :value="count">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Pilih Bangku</label><br>
                            <?php foreach ($bangku_film as $bangku2) : ?>
                                <label for="">
                                    <input class="form-check-input ms-2 mb-3 border-dark" type="checkbox" name="tabel_bangku[]" :value="<?= $bangku2['id_bangku']; ?>" @change="updateCount($event)" 
                                    <?php 
                                        foreach ($pesanan as $won) :
                                        echo $won['id_bangku'] == $bangku2['id_bangku'] ? 'checked disabled' : ''; endforeach;
                                         ?>>
                                    <label class="form-check-label ms-3" for="satu">
                                        <?= $bangku2['nama_bangku']; ?>
                                    </label>
                                </label>
                            <?php endforeach; ?>
                        </div>


                        <!-- <div class="mb-3">
                            <label for="bayar" class="form-label">Pembayaran</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-dark" type="radio" name="bayar" id="bca" value="BCA">
                                <label class="form-check-label" for="bca">BCA</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-dark" type="radio" name="bayar" id="bni" value="BNI">
                                <label class="form-check-label" for="bni">BNI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-dark" type="radio" name="bayar" id="bsi" value="BSI">
                                <label class="form-check-label" for="bsi">BSI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-dark" type="radio" name="bayar" id="mandiri" value="MANDIRI">
                                <label class="form-check-label border-dark" for="mandiri">Mandiri</label>
                            </div>
                        </div> -->
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-dark w-100" name="pesan">Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center pt-3 mt-5">
        <p>Copyright 2023 By Taman Hiburan Yura</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script type="module">
        import {
            createApp
        } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

        createApp({
            data() {
                return {
                    count: 0,
                }
            },
            methods: {
                updateCount(event) {
                    if (event.target.checked) {
                        this.count++;
                    } else {
                        this.count--;
                    }
                }
            }
        }).mount('#app')
    </script>
</body>

</html>