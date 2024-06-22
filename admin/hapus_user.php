<?php 
require 'function.php';

$id = $_GET['id'];

if(hapusAkun($id) > 0 ) {
    echo "<script>
		alert('Data Berhasil Dihapus');
        document.location.href = 'list_user.php';
		</script>";
	} else {
		echo "<script>
		alert('Data Gagal Dihapus');
        document.location.href = 'list_user.php';
		</script>";

}


?>