<?php
// Koneksi ke database
include 'konekke_local.php';

// Ambil term dari inputan pengguna
$term = $_GET['term'];

// Query untuk mencari jabatan guru berdasarkan term
$query = "SELECT nama FROM jabatan_guru WHERE nama LIKE '%$term%' LIMIT 10";
$result = $koneklocalhost->query($query);

// Simpan hasil query dalam array
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row['nama'];
    }
}

// Kembalikan data dalam format JSON
echo json_encode($data);
?>
