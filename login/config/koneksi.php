<?php 
$koneksi = mysqli_connect("localhost", "root", "", "film");

function register($data) {
    global $koneksi;

    $username = $data['username'];
    $email = $data['email'];
    $pass = $data['password'];

    $hash = password_hash($pass, PASSWORD_DEFAULT);
    

    $row = mysqli_query($koneksi, "INSERT INTO users VALUES ('', '$username', '$email', '$hash', '2')");

    return mysqli_affected_rows($koneksi);
    

}

?>