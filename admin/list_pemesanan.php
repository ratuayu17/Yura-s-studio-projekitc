<?php
session_start();
if ($_SESSION['login'] !== true) {
    echo "<script>
	document.location.href = '/projek_itc/login/login.php';
	</script>";
}
require 'function.php';

$list = mysqli_query($conn, "SELECT * FROM pemesanan JOIN studio ON studio.id_studio = pemesanan.id_studio JOIN users ON users.id_user = pemesanan.id_user JOIN tabel_film ON tabel_film.id_film = studio.id_film JOIN tabel_bangku ON tabel_bangku.id_bangku = pemesanan.id_bangku JOIN bayar_tiket ON bayar_tiket.id_pesan = pemesanan.id_pesan");
$no = 1;

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="dashboard.php">
                        <i class="bi bi-person"></i>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $_SESSION['username']; ?>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Admin</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                                <i class="bi bi-bar-chart-line"><span style="font-style: normal;"> Dashboard</span></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="form_studio.php">
                                <i class="bi bi-plus-circle"><span style="font-style: normal;"> Tambah Studio</span></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="form_tambah.php">
                                <i class="bi bi-plus-circle"><span style="font-style: normal;"> Tambah Film</span></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="form_kategori.php">
                                <i class="bi bi-plus-circle"><span style="font-style: normal;"> Tambah Kategori</span></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_film.php">
                                <i class="bi bi-film"><span style="font-style: normal;"> Tabel Film</span></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_studio.php">
                                <i class="bi bi-film"><span style="font-style: normal;"> Tabel Studio</span></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="list_pemesanan.php">
                                <i class="bi bi-film"><span style="font-style: normal;"> Tabel Pemesanan</span></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_kategori.php">
                                <i class="bi bi-film"><span style="font-style: normal;"> Tabel Kategori</span></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_user.php">
                                <i class="bi bi-people-fill"><span style="font-style: normal;"> Tabel User</span></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">



        <div class="row d-flex justify-content-center" style="margin-top: 120px; margin-bottom: 50px;">
            <div class="col">
                <h3 class="my-3 text-center">Tabel Pemesanan</h3>

                <table class="table table-bordered my-0 border-dark">
                    <thead>
                        <tr>
                            <th class="d-none d-xl-table-cell">No</th>
                            <th class="d-none d-md-table-cell">Nama Studio</th>
                            <th class="d-none d-xl-table-cell">Nama Film</th>
                            <th class="d-none d-md-table-cell">Harga Tiket</th>
                            <th class="d-none d-md-table-cell">Tanggal</th>
                            <th class="d-none d-md-table-cell">User</th>
                            <th class="d-none d-md-table-cell">Jam</th>
                            <th class="d-none d-md-table-cell">No. Bangku</th>
                            <th class="d-none d-md-table-cell">Jumlah Bangku</th>
                            <th class="d-none d-md-table-cell">Bukti Bayar</th>
                            <th class="d-none d-md-table-cell">Action</th>
                            <th class="d-none d-md-table-cell">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $pesanan) : ?>
                            <tr>
                                <td class="d-none d-xl-table-cell"><?= $no++; ?></td>
                                <td class="d-none d-xl-table-cell"><?= $pesanan['nama_studio']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $pesanan['nama_film']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $pesanan['harga_tiket']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $pesanan['tanggal']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $pesanan['email_user']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $pesanan['jam_tayang']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $pesanan['nama_bangku']; ?></td>
                                <td class="d-none d-md-table-cell">1</td>

                                <td class="d-none d-md-table-cell">
                                    <img src="../user/bukti_bayar/<?= $pesanan['bukti']; ?>" alt="" width="150px">
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <a href="edit_status.php?id=<?= $pesanan['id_pesan']; ?>" class='btn btn-success mb-3'> Approved </a>
                                    <a href="tolak.php?id=<?= $pesanan['id_pesan']; ?>" class='btn btn-danger'> Tolak </a>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php
                                    if ($pesanan['status_validasi'] == 1) {
                                        echo '<a href="" class="btn btn-warning"> Pending</a>';
                                    } else if ($pesanan['status_validasi'] == 2) {
                                        echo '<a href="hapus_tolak.php?id=' . $pesanan["id_pesan"] . '" class="btn btn-danger"> Ditolak</a>';
                                    } else {
                                        echo '<a href="" class="btn btn-light disable"> Selesai</a>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
            <div class="col-12 mt-3 d-flex justify-content-end">
                <a href="cetak_exsel.php" class="btn btn-success">Export</a>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>