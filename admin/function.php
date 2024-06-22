<?php 
$conn = mysqli_connect("localhost", "root", "", "film");

function tambahFilm($film) {
    global $conn;

    $nama = $film['nama_film'];
    $foto = upload();

    if(!$foto) {
        echo "<script>
            alert('Anda harus upload gambar');
            </script>";
            return false;
       }

    $sutradara = $film['sutradara'];
    $penulis = $film['penulis'];
    $pemain = $film['pemain'];
    $sinopsis = $film['sinopsis'];
    $durasi = $film['durasi'];
    $jam_tayang = $film['jam_tayang'];
    $kategori = $film['id_kategori'];
    
    $query = "INSERT INTO tabel_film VALUES (NULL, '$nama', '$foto', '$sutradara', '$penulis', '$pemain', '$sinopsis', '$durasi', '$jam_tayang', '$kategori')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {

    $namaFile = $_FILES['foto']['name'];
    $ukuranSize = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $temp_file = $_FILES['foto']['tmp_name'];

    $ekstensiValid = ['jpg', 'png', 'jpeg'];
    $ekstensiFile = pathinfo($namaFile, PATHINFO_EXTENSION);

    if($error == 4) {
        echo "<script>
        alert('Wajib Upload Poster');
        </script>";
        return false;   
    } else if (!in_array($ekstensiFile, $ekstensiValid)) {
        echo "<script>
        alert('Ekstensi File Harus Berupa jpg, png, jpeg');
        </script>";
        return false;
    } else if ($ukuranSize > 5000000) {
        echo "<script>
        alert('Maksimal File 5 MB');
        </script>";
        return false;
    }

    $namaFilebaru = pathinfo($namaFile, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $ekstensiFile;
    move_uploaded_file($temp_file, 'img/' . $namaFilebaru);

    return $namaFilebaru;

}

function uploadStudio() {

    $NamaFile = $_FILES['gambar']['name'];
    $UkuranSize = $_FILES['gambar']['size'];
    $Error = $_FILES['gambar']['error'];
    $Temp_file = $_FILES['gambar']['tmp_name'];

    $EkstensiValid = ['jpg', 'png', 'jpeg'];
    $EkstensiFile = pathinfo($NamaFile, PATHINFO_EXTENSION);

    if($Error == 4) {
        echo "<script>
        alert('Wajib Upload Poster');
        </script>";
        return false;   
    } else if (!in_array($EkstensiFile, $EkstensiValid)) {
        echo "<script>
        alert('Ekstensi File Harus Berupa jpg, png, jpeg');
        </script>";
        return false;
    } else if ($UkuranSize > 5000000) {
        echo "<script>
        alert('Maksimal File 5 MB');
        </script>";
        return false;
    }

    $namaFileBaru = pathinfo($NamaFile, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $EkstensiFile;
    move_uploaded_file($Temp_file, 'img/' . $namaFileBaru);

    return $namaFileBaru;

}



function tambahStudio($data) {
    global $conn;

    $film = $data['id_film'];
    $nama = $data['nama_studio'];
    $alamat = $data['alamat'];
    $telepon = $data['nomor_telp'];

    $gambar = uploadStudio();
    if(!$gambar) {
        echo "<script>
        alert('Harus Upload Foto');
        </script>";

        return false;
    }

    $harga = $data['harga_tiket'];
    

    $studio = mysqli_query($conn, "INSERT INTO studio VALUES ('', '$film', '$nama', '$alamat', '$telepon', '$gambar', '$harga')");

    return mysqli_affected_rows($conn);
}


function tiketpesan($data) {
    global $conn;

    $nama = $data['tiketpesan'];
    $jam = $data['jam'];

    $query = mysqli_query($conn, "INSERT INTO tiketpesan VALUES('', '$nama', '$jam')");

    return mysqli_affected_rows($conn);
}

function kategori($isi){
    global $conn;

    $nama = $isi['nama_kategori'];

    $sql = mysqli_query($conn, "INSERT INTO kategori VALUES ('', '$nama')");

    return mysqli_affected_rows($conn);
}

function hapusKategori($id) {
    global $conn;

    $query = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id");

    return mysqli_affected_rows($conn);
}

function hapusFilm($id) {
    global $conn;

    $query = mysqli_query($conn, "DELETE FROM tabel_film WHERE id_film = '$id'");

    return mysqli_affected_rows($conn);
}

function editFilm($data) {
    global $conn;

    $id = $_GET['id_edit'];
    $nama_film = $data['nama_film'];
    $durasi = $data['durasi'];
    $jam = $data['jam_tayang'];
    $kategori = $data['id_kategori'];

    $edit = mysqli_query($conn, "UPDATE tabel_film SET nama_film = '$nama_film', durasi = '$durasi', jam_tayang = '$jam', id_kategori = '$kategori' WHERE id_film = '$id'");

    return mysqli_affected_rows($conn);
}


function editTiket($id_kondisi) {
    global $conn;

    $approved = mysqli_query($conn, "UPDATE pemesanan SET status_validasi = 3 WHERE id_pesan = '$id_kondisi'");

    return mysqli_affected_rows($conn);

} 

function tolak($id) {
    global $conn;

    $approved = mysqli_query($conn, "UPDATE pemesanan SET status_validasi = 2 WHERE id_pesan = '$id'");

    return mysqli_affected_rows($conn);

} 

function htolak($hapus) {
    global $conn;

    $query = mysqli_query($conn, "DELETE FROM pemesanan WHERE id_pesan = '$hapus'");

    return mysqli_affected_rows($conn);
}

function hapusAkun($id_akun) {
    global $conn;

    $hapus = mysqli_query($conn, "DELETE FROM users WHERE id_user = '$id_akun'");

    return mysqli_affected_rows($conn);
}

function hapusStudio($id_studio) {
    global $conn;

    $hapus2 = mysqli_query($conn, "DELETE FROM studio WHERE id_studio = '$id_studio'");

    return mysqli_affected_rows($conn);
}

function editStudio($edit) {
    global $conn;

    $id = $_GET['id'];

    $film = $edit['id_film'];
    $studio = $edit['nama_studio'];
    $alamat= $edit['alamat'];
    $telp = $edit['nomor_telp'];
    $harga = $edit['harga_tiket'];

    $row = mysqli_query($conn, "UPDATE studio SET id_film = '$film', nama_studio = '$studio', alamat = '$alamat', nomor_telp = '$telp', harga_tiket = '$harga' WHERE id_studio = $id");

    return mysqli_affected_rows($conn);

}

function selected($param, $value) {
    $result = isset($_GET[$param]) ? ($_GET[$param] == $value ? 'selected' : '') : '';
    return $result;
}

?>