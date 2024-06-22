<?php
session_start();
if ($_SESSION['login'] !== true) {
	echo "<script>
	document.location.href = '/projek_itc/login/login.php';
	</script>";
}

require 'function.php';

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
                            <a class="nav-link active" href="dashboard.php">
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
        <div class="row" style="margin-top: 150px;">
            <div class="col-sm-3">
                <div class="card">
                    <?php
                    $film = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tabel_film");

                    if ($film) {
                        $queryy = mysqli_fetch_assoc($film);
                        $total_film = $queryy['total'];
                    }
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Film</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="bi bi-film"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $total_film; ?></h1>
                        <a href="list_film.php" style="text-decoration: none;">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <?php
                    $studio = mysqli_query($conn, "SELECT COUNT(*) AS total_studio FROM studio");

                    if ($studio) {
                        $sql = mysqli_fetch_assoc($studio);
                        $total_studio = $sql['total_studio'];
                    }
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Studio</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="bi bi-film"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $total_studio;?></h1>
                        <a href="list_studio.php" style="text-decoration: none;">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <?php
                    $pesan = mysqli_query($conn, "SELECT COUNT(*) AS total_pesan FROM pemesanan");

                    if ($pesan) {
                        $row2 = mysqli_fetch_assoc($pesan);
                        $total_pesan = $row2['total_pesan'];
                    }
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Pemesanan</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $total_pesan; ?></h1>
                        <a href="list_pemesanan.php" style="text-decoration: none;">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <?php
                    $user = mysqli_query($conn, "SELECT COUNT(*) AS total_user FROM users");

                    if ($user) {
                        $row = mysqli_fetch_assoc($user);
                        $total_user = $row['total_user'];
                    }
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">User</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="bi bi-people"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $total_user; ?></h1>
                        <a href="list_user.php" style="text-decoration: none;">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>