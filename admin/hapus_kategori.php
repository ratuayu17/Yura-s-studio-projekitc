<?php 
require 'function.php';

$id = $_GET['id'];

if(hapusKategori($id) > 0 ) {
    echo "<script>
		alert('Data Berhasil Dihapus');
        document.location.href = 'list_kategori.php';
		</script>";
	} else {
		echo "<script>
		alert('Data Gagal Dihapus');
        document.location.href = 'list_kategori.php';
		</script>";

}


?>