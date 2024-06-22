<?php 
require 'function.php';

$id = $_GET['id'];

if(tolak($id) > 0) {
    echo "<script>
    alert('Tiket telah di tolak');
    document.location.href = 'list_pemesanan.php';
    </script>";
} else {
    echo "<script>
    alert('Tiket gagal di tolak');
    document.location.href = 'list_pemesanan.php';
    </script>";
}
?>