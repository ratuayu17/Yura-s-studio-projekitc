<?php 
require './config/koneksi.php';

if(isset($_POST['daftar'])) {
	if(register($_POST) > 0) {
		echo "<script>
		alert('Register Telah Berhasil!');
		document.location.href = 'login.php';
		</script>";
	} else {
		echo "<script>
		alert('Register Gagal!');
		document.location.href = 'register.php';
		</script>";
	}
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style/style_login.css">
	<title>Register</title>
</head>
<body>
	<div class="container">
		<div class="login-container">
			<h2>Register</h2>
			<form action="" method="post">
				<div class="input-group">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" required>
				</div>
				<div class="input-group">
					<label for="email">Email</label>
					<input type="email" id="email" name="email" required>
				</div>
				<div class="input-group">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" required>
				</div>
				<div class="input-group">
					<button type="submit" name="daftar">Register</button>
				</div>
				<div class="link">
					Sudah Punya Akun? <a href="login.php">Login Sekarang!</a>
				</div>
			</form>
		</div>
	</div>
</body>
</html>