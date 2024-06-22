<?php
session_start();
if ($_SESSION['login'] !== true) {
	echo "<script>
	document.location.href = '/projek_itc/login/login.php';
	</script>";
}
require 'function.php';

$query = mysqli_query($conn, "SELECT * FROM tabel_film JOIN kategori ON tabel_film.id_kategori = kategori.id_kategori");
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
                                    <?= $_SESSION['username'];?>
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
                            <a class="nav-link active" href="list_film.php">
                                <i class="bi bi-film"><span style="font-style: normal;"> Tabel Film</span></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_studio.php">
                                <i class="bi bi-film"><span style="font-style: normal;"> Tabel Studio</span></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_pemesanan.php">
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
        <div class="row" style="margin-top: 120px; margin-bottom: 50px;">
            <div class="col">
                <h3 class="my-3 text-center">Tabel Film</h3>
                <table class="table table-bordered table-sm my-0 border-dark">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="d-none d-xl-table-cell">Nama Film</th>
                            <th class="d-none d-xl-table-cell">Poster</th>
                            <th class="d-none d-md-table-cell">Durasi</th>
                            <th class="d-none d-md-table-cell">Sutradara</th>
                            <th class="d-none d-md-table-cell">Penulis</th>
                            <th class="d-none d-md-table-cell">Pemain</th>
                            <th class="d-none d-md-table-cell">Sinopsis</th>
                            <th class="d-none d-md-table-cell">Jam Tayang</th>
                            <th class="d-none d-md-table-cell">Kategori</th>
                            <th class="d-none d-md-table-cell">Aksi</th>
                        </tr>
                    </thead>
                    <?php foreach ($query as $film) : ?>
                        <tbody>
                            <tr>
                                <td class="d-none d-xl-table-cell"><?= $no++; ?></td>
                                <td class="d-none d-xl-table-cell"><?= $film['nama_film']; ?></td>
                                <td class="d-none d-md-table-cell">
                                    <img src="./img/<?= $film['foto']; ?>" alt="" width="100px">
                                </td>
                                <td class="d-none d-md-table-cell"><?= $film['durasi']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $film['sutradara']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $film['penulis']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $film['pemain']; ?></td>
                                <td class="sinopsis" style="display:block; border: 1px solid black; padding:5px; width:200px; height: 410px; overflow:auto;"><?= $film['sinopsis']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $film['jam_tayang']; ?></td>
                                <td class="d-none d-md-table-cell"><?= $film['nama_kategori']; ?></td>
                                <td class="d-none d-md-table-cell">
                                    <a href="edit.php?id_edit=<?= $film['id_film'];?>" class="btn btn-primary">Edit</a>
                                    <a href="hapus_film.php?id_hapus=<?= $film['id_film'];?>" class="btn btn-danger mt-2">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>