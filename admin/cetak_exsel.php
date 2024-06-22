<?php
session_start();
if ($_SESSION['login'] !== true) {
    echo "<script>
	document.location.href = '/projek_itc/login/login.php';
	</script>";
}
require 'function.php';

$list = mysqli_query($conn, "SELECT * FROM pemesanan JOIN studio ON studio.id_studio = pemesanan.id_studio JOIN users ON users.id_user = pemesanan.id_user JOIN tabel_film ON tabel_film.id_film = studio.id_film JOIN tabel_bangku ON tabel_bangku.id_bangku = pemesanan.id_bangku");
$no = 1;

header("Content-type: application/vdn-ms-excel");
header("Content-Disposition: attachment; filename=riwayat-pesanan.xls");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Riwayat Pemesanan</h3>
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
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>