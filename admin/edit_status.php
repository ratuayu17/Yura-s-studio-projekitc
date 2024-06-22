<?php 
require 'function.php';

$id = $_GET['id'];

if(editTiket($id) > 0 ) {
    echo "<script>
	alert('Tiket Telah Disetujui');
    document.location.href = 'list_pemesanan.php';
	</script>";
} else {
    echo "<script>
	alert('Tiket Gagal Disetujui');
    document.location.href = 'list_pemesanan.php';
	</script>";
}



?>