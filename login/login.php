<?php
session_start();
require 'config/koneksi.php';

if (isset($_POST['login'])) {

	$email = $_POST['email'];
	$pass = $_POST['password'];

	$user = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");

	if (mysqli_num_rows($user) > 0) {
		$data = mysqli_fetch_array($user);

		if (password_verify($pass, $data['password'])) {
			$_SESSION['login'] = true;
			$_SESSION['username'] = $data['username'];
			$_SESSION['email'] = $data['email'];
			$_SESSION['role_akun'] = $data['role_akun'];

			if ($data['role_akun'] == 1) {
				echo "<script>
				alert('Admin Berhasil Login');
				document.location.href = '../admin/dashboard.php';
				</script>";
			 } else if($data['role_akun'] == 2) {
				echo "<script>
				alert('Anda Berhasil Login');
				document.location.href = '../user/tampilan2.php';
				</script>";
			} 
			}
			else {
				echo "<script>
				alert('Anda Gagal Login');
				header('location: login.php');
				</script>";
		}
	} else {
		echo "<script>
		alert('email atau password salah!');
		header('location: login.php');
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
	<title>Login</title>
</head>

<body>
	<div class="container">
		<div class="login-container">
			<h2>Login</h2>
			<form action="" method="post">
				<div class="input-group">
					<label for="email">Email</label>
					<input type="email" id="email" name="email" required>
				</div>
				<div class="input-group">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" required>
				</div>
				<div class="input-group">
					<button type="submit" name="login">Login</button>
				</div>
				<div class="link">
					Tidak Punya Akun? <a href="register.php">Daftar Akun Sekarang!</a>
				</div>
			</form>
		</div>
	</div>
</body>

</html>