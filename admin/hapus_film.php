<?php 
require 'function.php';

$id = $_GET['id_hapus'];

if(hapusFilm($id) > 0 ) {
    echo "<script>
		alert('Data Berhasil Dihapus');
        document.location.href = 'list_film.php';
		</script>";
	} else {
		echo "<script>
		alert('Data Gagal Dihapus');
        document.location.href = 'list_film.php';
		</script>";

}


?>