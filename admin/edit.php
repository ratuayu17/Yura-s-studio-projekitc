<?php
session_start();
if ($_SESSION['login'] !== true) {
    echo "<script>
	document.location.href = '/projek_itc/login/login.php';
	</script>";
}
include 'function.php';

$id = $_GET['id_edit'];
$edit_film = mysqli_query($conn, "SELECT * FROM tabel_film JOIN kategori ON tabel_film.id_kategori = kategori.id_kategori WHERE tabel_film.id_film = '$id'");

if(isset($_POST['edit'])) {
    if(editFilm($_POST) > 0) {
        echo "<script>
        alert('Data berhasil di edit');
        document.location.href = 'list_film.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal di edit');
        document.location.href = 'edit.php';
        </script>";
    }
}



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
                                    <!-- ambil session --> admin
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="#">Log Out</a></li>
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
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0 h4 text-center">Form Edit Film</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <?php foreach($edit_film as $data):?>
                            <form action="" method="post" class="row g-3" enctype="multipart/form-data">
                                <input type="hidden" name="id_film" value="<?= $data['id_film'];?>">
                                <div class="col-12">
                                    <label class="form-label">Nama Film</label>
                                    <input type="text" class="form-control" name="nama_film" value="<?= $data['nama_film'];?>">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Durasi</label>
                                    <input type="text" class="form-control" name="durasi" value="<?= $data['durasi'];?>">
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <select class="form-select" name="jam_tayang">
                                            <option selected>Pilih Jam</option>
                                            <option value="10:59" <?php if($data['jam_tayang'] == "10:59") {echo "selected";}?>> 10:59 </option>
                                            <option value="12:30" <?php if($data['jam_tayang'] == "12:30") {echo "selected";}?>> 12:30 </option>
                                            <option value="15:34" <?php if($data['jam_tayang'] == "15:34") {echo "selected";}?>> 15:34 </option>
                                            <option value="17:32" <?php if($data['jam_tayang'] == "17:32") {echo "selected";}?>> 17:32 </option>
                                            <option value="19:59" <?php if($data['jam_tayang'] == "19:59") {echo "selected";}?>> 19:59 </option>
                                            <option value="21:30" <?php if($data['jam_tayang'] == "21:30") {echo "selected";}?>> 21:30 </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-group">
                                        <select class="form-select" name="id_kategori">
                                            <option selected>Pilih Genre</option>
                                            <?php
                                            $sql = mysqli_query($conn, "SELECT * FROM kategori");
                                            ?>
                                            <?php foreach ($sql as $genre) : ?>
                                                <option value="<?= $genre['id_kategori']; ?>" <?= $genre['id_kategori'] == $data['id_kategori'] ? 'selected' : ''?>>
                                                <?= $genre['nama_kategori']; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <button class="btn btn-dark" name="edit">Edit Film</button>
                                </div>
                            </form>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>