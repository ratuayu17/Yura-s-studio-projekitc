<?php
session_start();
require '../admin/function.php';

if ($_SESSION['login'] !== true) {
    echo "<script>
    alert('Login terlebih dahulu');
	document.location.href = '../login/login.php';
	</script>";
}

function Bayar()
{

    $NamaFile = $_FILES['bukti']['name'];
    $UkuranSize = $_FILES['bukti']['size'];
    $Error = $_FILES['bukti']['error'];
    $Temp_file = $_FILES['bukti']['tmp_name'];

    $EkstensiValid = ['jpg', 'png', 'jpeg'];
    $EkstensiFile = pathinfo($NamaFile, PATHINFO_EXTENSION);

    if ($Error == 4) {
        echo "<script>
        alert('Wajib Upload Poster');
        </script>";
        return false;
    } else if (!in_array($EkstensiFile, $EkstensiValid)) {
        echo "<script>
        alert('Ekstensi File Harus Berupa jpg, png, jpeg');
        </script>";
        return false;
    } else if ($UkuranSize > 5000000) {
        echo "<script>
        alert('Maksimal File 5 MB');
        </script>";
        return false;
    }

    $namaFileBaru = pathinfo($NamaFile, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $EkstensiFile;
    move_uploaded_file($Temp_file, 'bukti_bayar/' . $namaFileBaru);

    return $namaFileBaru;
}

$id_bayar = $_GET['id_bayar'];

if (isset($_POST['bayar'])) {
    global $conn;

    $pesanan = $_POST['id_pesan'];
    $namaa = $_POST['nama_penyetor'];
    $bank = $_POST['via_bank'];
    $tgl = $_POST['tanggal_bayar'];

    $gambar = Bayar();
    if (!$gambar) {
        echo "<script>
        alert('Harus Upload Foto');
        </script>";

        return false;
    }

    $sql = mysqli_query($conn, "INSERT INTO bayar_tiket VALUES (NULL,'$pesanan', '$namaa', '$bank','$tgl','$gambar')");
    // var_dump($sql);
    // die();

    $quer = mysqli_query($conn, "UPDATE pemesanan SET status_validasi = 1 WHERE id_pesan = '$id_bayar'");


    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
		alert('Pembayaran Telah Berhasil!');
		document.location.href = 'list_tiket.php';
		</script>";
    } else {
        echo "<script>
		alert('Pembayaran Telah Gagal!');
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
    <nav class="navbar navbar-expand-lg py-3" style="background-color: black;">
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
                    <a class="btn btn-dark rounded-pill me-3" href="../login/logout.php" style="color: white; background-color: #EA168E;">
                        Log Out
                    </a>
                    </div>';
                }
            }


            ?>
        </div>
    </nav>

    <div class="section">
        <div class="container">
            <div class="row mt-3 d-flex justify-content-center">
                <?php
                $row = mysqli_query($conn, "SELECT studio.harga_tiket FROM studio JOIN pemesanan ON pemesanan.id_studio = studio.id_studio WHERE pemesanan.id_pesan = '$id_bayar'");
                if ($row) {
                    $sql = mysqli_fetch_assoc($row);
                    $harga = $sql['harga_tiket'];
                    echo '.<div class="container">
                    <div class="alert alert-danger">Total Harga RP. ' . $harga . '</strong>
                    <h4>Nomor Rekening : 170796281105 (BSI)</h4>
                    </div><br>
                    </div>';
                }
                ?>

                <div class="row d-flex justify-content-center">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <h3 class="text-center">Pembayaran</h3>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_pesan" value="<?= $id_bayar; ?>">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Penyetor</label>
                                <input type="text" name="nama_penyetor" id="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <select class="form-select" name="via_bank" required>
                                        <option value="" selected> Pilih Pembayaran </option>
                                        <option value="BCA"> BCA </option>
                                        <option value="BNI"> BNI </option>
                                        <option value="BSI"> BSI </option>
                                        <option value="MANDIRI"> MANDIRI </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="text" name="tanggal_bayar" id="tanggal" class="form-control" value="<?= date('d-m-Y');?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="bukti" class="form-label">Bukti Pembayaran</label>
                                <input type="file" name="bukti" id="bukti" class="form-control" required>
                            </div>
                            <div class="mb-3 d-flex justify-content-center">
                                <button type="submit" name="bayar" class="btn btn-outline-dark mt-3 w-100">Bayar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <footer class="text-center pt-3 mt-5">
                <p>Copyright 2023 By Taman Hiburan Yura</p>
            </footer>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>