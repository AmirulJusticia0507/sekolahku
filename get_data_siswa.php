<?php
include 'konekke_local.php';

// Tangkap NIS yang dikirim melalui AJAX
$nis = $_POST['nis'];

// Query untuk mengambil data siswa berdasarkan NIS
$sql = "SELECT * FROM siswa WHERE nis = '$nis'";
$result = $koneklocalhost->query($sql);

// Periksa apakah data ditemukan
if ($result->num_rows > 0) {
    // Ambil data siswa dan kirim sebagai respons JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    // Jika data tidak ditemukan, kirim respons kosong
    echo json_encode([]);
}

// Tutup koneksi database
$koneklocalhost->close();
?>
