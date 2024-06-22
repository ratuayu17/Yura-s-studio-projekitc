<?php
require '../admin/function.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM pemesanan JOIN studio ON pemesanan.id_studio = studio.id_studio JOIN users ON users.id_user = pemesanan.id_user JOIN tabel_film ON tabel_film.id_film = studio.id_film JOIN tabel_bangku ON tabel_bangku.id_bangku = pemesanan.id_bangku JOIN bayar_tiket ON bayar_tiket.id_pesan = pemesanan.id_pesan WHERE pemesanan.id_pesan = $id");
$fetch = mysqli_fetch_assoc($query);

$nama_studio = $fetch['nama_studio'];
$nama_film = $fetch['nama_film'];
$tanggal = $fetch['tanggal'];
$jumlah = $fetch['jumlah'];
$jam = $fetch['jam_tayang'];
$harga = $fetch['harga_tiket'];
$bayar = $fetch['via_bank'];
$bangku = $fetch['nama_bangku'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
	<style>
		.container {
			width: 27em;
			margin: 3em auto;
			/* color: #fff; */
			font-family: system-ui;
		}

		.card {
			background: linear-gradient(to bottom,
					#DD4A48 0%,
					#DD4A48 26%,
					#F5EEDC 26%,
					#F5EEDC 100%);
			height: 190px;
			float: left;
			position: relative;
			padding: 1em;
			margin-top: 100px;
		}

		.card-left {
			border-top-left-radius: 8px;
			border-bottom-left-radius: 8px;
			width: 16em;
		}

		.card-right {
			width: 6.5em;
			border-left: 0.18em dashed #fff;
			border-top-right-radius: 8px;
			border-bottom-right-radius: 8px;
		}

		.card-right::before,
		.card-right::after {
			content: "";
			position: absolute;
			display: block;
			width: 0.9em;
			height: 0.9em;
			background: #fff;
			border-radius: 50%;
			left: -0.5em;
		}

		.card-right::before {
			top: -0.4em;
		}

		.card-right::after {
			bottom: -0.4em;
		}

		h1 {
			font-size: 1.1em;
			margin-top: 0;
			color: #F5EEDC;
		}

		h1 span {
			font-weight: normal;
		}

		.title,
		.name,
		.seat,
		.time {
			text-transform: capitalize;
			font-weight: normal;
		}

		.title h2,
		.name h2,
		.seat h2,
		.time h2 {
			font-size: 0.9em;
			color: #0E2954;
			margin: 0;
		}

		.title span,
		.name span,
		.seat span,
		.time span {
			font-size: 0.7em;
			color: #1b417d;
		}

		.title {
			margin: 2em 0 0 0;
		}

		.name,
		.seat {
			margin: 0.7em 0 0 0;
		}

		.time {
			margin: 0.7em 0 0 1em;
		}

		.seat,
		.time {
			float: left;
		}

		.hkedua {
			font-size: 0.7em;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="card card-left">
			<h1><?= $nama_studio; ?></h1>
			<div class="title">
				<h2><?= $nama_film; ?></h2>
			</div>
			<div class="seat">
				<h2>Tanggal</h2>
				<span><?= $tanggal; ?></span>
			</div>
			<div class="time">
				<h2>Nomor Bangku</h2>
				<span><?= $bangku; ?></span>
			</div>
			<div class="seat">
				<h2>Harga - Pembayaran</h2>
				<span><?= $harga; ?> (<?= $bayar; ?>)</span>
			</div>
			<div class="time">
				<h2>Jam Tayang</h2>
				<span><?= $jam; ?></span>
			</div>
		</div>

		<div class="card card-right">
			<h1 class="hkedua"><?= $nama_studio; ?></h1>
			<div class="title">
				<h2>Jumlah : 1</h2>
			</div>
			<div class="name">
				<h2>Total Bayar</h2>
				<span>RP. <?= $harga; ?></span>
			</div>
			<?php
			date_default_timezone_set("Asia/Jakarta");
			?>
			<div class="seat">
				<span><?= date('Y-m-d'); ?></span>
				<span><?= date('H:i:s'); ?></span>
			</div>
		</div>
		<script>
			window.print();
		</script>
	</div>
</body>

</html>