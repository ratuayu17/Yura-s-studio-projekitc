<?php
session_start();
require '../admin/function.php';

$row = "SELECT * FROM studio JOIN tabel_film ON studio.id_film = tabel_film.id_film";

if (isset($_GET['keyword'])) {
    $key = $_GET['keyword'];
    $filter = $_GET['filter'];
    $sort = $_GET['sort'];

    $whereNama = " WHERE nama_studio LIKE '%$key%'";
    if ($_GET['filter'] == 'all') {
        switch ($sort) {
            case 'a_z':
                $list = mysqli_query($conn, $row . $whereNama . "ORDER BY nama_studio ASC");
                break;
            case 'z_a':
                $list = mysqli_query($conn, $row . $whereNama . "ORDER BY nama_studio DESC");
                break;
            case 'stok_terdikit':
                $list = mysqli_query($conn, $row . $whereNama . "ORDER BY harga_tiket ASC");
                break;
            case 'stok_terbanyak':
                $list = mysqli_query($conn, $row . $whereNama . "ORDER BY harga_tiket DESC");
                break;
            default:
                $list = mysqli_query($conn, $row . $whereNama);
        }
    } else {
        $whereKategori = " AND harga_tiket = '$filter'";
        switch ($sort) {
            case 'a_z':
                $list = mysqli_query($conn, $row . $whereNama . $whereKategori . "ORDER BY nama_studio ASC");
                break;
            case 'z_a':
                $list = mysqli_query($conn, $row . $whereNama . $whereKategori . "ORDER BY nama_studio DESC");
                break;
            case 'stok_terdikit':
                $list = mysqli_query($conn, $row . $whereNama . $whereKategori . "ORDER BY harga_tiket ASC");
                break;
            case 'stok_terbanyak':
                $list = mysqli_query($conn, $row . $whereNama . $whereKategori . "ORDER BY harga_tiket DESC");
                break;
            default:
                $list = mysqli_query($conn, $row . $whereNama . $whereKategori);
        }
    }
} else {
    $list = mysqli_query($conn, $row);
}
$kategori = mysqli_query($conn, "SELECT harga_tiket FROM studio");


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yura's Studio</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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

    <div class="section">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col text-center mb-5 mt-5">
                        <h3 class="card-title">STUDIO</h3>
                        <form action="" method="GET" class="mt-4">
                            <div class="input-group">
                                <input type="text" name="keyword" id="" class="form-control border-dark" placeholder="Cari..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">

                                <select name="filter" class="form-select border-dark">
                                    <option value="all">All</option>
                                    <?php foreach ($kategori as $data) : ?>
                                        <option value="<?= $data['harga_tiket'] ?>" <?= isset($_GET['filter']) ? ($_GET['filter'] == $data['harga_tiket'] ? 'selected' : '') : '' ?>>
                                            <?= $data['harga_tiket'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <select name="sort" id="" class="form-select border-dark">
                                    <option value="none" <?= selected('sort', 'none') ?>>None</option>
                                    <option value="a_z" <?= selected('sort', 'a_z') ?>>A - Z</option>
                                    <option value="z_a" <?= selected('sort', 'z_a') ?>>Z - A</option>
                                    <option value="stok_terdikit" <?= selected('sort', 'stok_terdikit') ?>>Harga Termurah</option>
                                    <option value="stok_terbanyak" <?= selected('sort', 'stok_terbanyak') ?>>Harga Termahal</option>
                                </select>

                                <button type="submit" class="btn btn-dark">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-3">
                    <?php foreach ($list as $studio) : ?>
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <img src="../admin/img/<?= $studio['gambar']; ?>" class="card-img-top" alt="...">

                                <div class="card-body">
                                    <p class="card-text"><small class="text-body-secondary"><?= $studio['nomor_telp']; ?></small></p>
                                    <h5 class="card-title"><?= $studio['nama_studio']; ?></h5>
                                    <p class="card-text"><?= $studio['nama_film']; ?></p>
                                    <p class="card-text"><small class="text-body-dark">RP. <?= $studio['harga_tiket']; ?></small></p>
                                    <p class="card-text"><small class="text-body-dark"><?= $studio['alamat']; ?></small></p>

                                    <?php
                                    if (!isset($_SESSION['login'])) {
                                        echo '<a href="../login/login.php" class="btn mt-2 w-100" style="background-color: #EA168E; color: white;">Pesan</a>';
                                    } else {
                                        $role = $_SESSION['role_akun'];
                                        if ($role == 2) {
                                            echo '<a href="pemesanan.php?id_mesan=' . $studio['id_studio'] . '" class="btn mt-2 w-100" style="background-color: #EA168E; color: white;">Pesan</a>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </section>
    </div>

    <footer class="text-center" style="margin-top: 100px;">
        <p>Copyright 2023 By Yura's Studio</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>