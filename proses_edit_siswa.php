<?php
// Include file koneksi database
include 'konekke_local.php';

// Tangkap data yang dikirimkan dari form
$namasiswa = $_POST['namasiswa'];
$tempatlahir = $_POST['tempatlahir'];
$tanggal = $_POST['tanggal'];
$kelas = $_POST['kelas'];
$nis = $_POST['nis'];
$alamat = $_POST['alamat'];
$golongan_darah = $_POST['golongan_darah'];
$nama_orangtua = $_POST['nama_orangtua'];
$alamat_orangtua = $_POST['alamat_orangtua'];
$catatan_kesehatan = $_POST['catatan_kesehatan'];
$foto_siswa = $_FILES['foto_siswa']['name'];

// Proses upload foto siswa
$target_dir = "uploads/siswa/";
$target_file = $target_dir . basename($_FILES["foto_siswa"]["name"]);
move_uploaded_file($_FILES["foto_siswa"]["tmp_name"], $target_file);

// Query untuk menyimpan data ke database
$sql = "INSERT INTO siswa (namasiswa, tempatlahir, tanggal, kelas, nis, alamat, golongan_darah, nama_orangtua, alamat_orangtua, catatan_kesehatan, foto_siswa) 
        VALUES ('$namasiswa', '$tempatlahir', '$tanggal', '$kelas', '$nis', '$alamat', '$golongan_darah', '$nama_orangtua', '$alamat_orangtua', '$catatan_kesehatan', '$foto_siswa')";

// Jalankan query
if ($koneklocalhost->query($sql) === TRUE) {
    echo "Data siswa berhasil disimpan";
    header('Location: rekapdata.php');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $koneklocalhost->error;
}

// Tutup koneksi database
$koneklocalhost->close();
?>
