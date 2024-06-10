<?php
// Include koneksi database dan file konfigurasi
include 'konekke_local.php';

// Tangkap data dari formulir
$nama = $_POST['nama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$no_telepon = $_POST['no_telepon'];
$status_id = $_POST['status_id'];
$jabatan_id = $_POST['jabatan_id'];

// Periksa apakah input 'nip' tersedia dalam $_POST
$nip = isset($_POST['nip']) ? $_POST['nip'] : '';

// Proses upload foto guru
$nama_foto = $_FILES['foto_guru']['name'];
$tmp_foto = $_FILES['foto_guru']['tmp_name'];
$lokasi_foto = "uploads/guru/".$nama_foto;

// Batasan ukuran foto (dalam bytes)
$max_file_size = 1048576; // 1MB

// Periksa ukuran file
if ($_FILES['foto_guru']['size'] > $max_file_size) {
    echo "Ukuran file foto terlalu besar. Harap unggah file dengan ukuran maksimum 1MB.";
    exit;
}

// Mulai transaksi
$koneklocalhost->begin_transaction();

try {
    // Simpan data guru ke dalam tabel guru
    $sql1 = "INSERT INTO guru (nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, email, no_telepon, foto_guru, status_id, jabatan_id, nip) VALUES ('$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$email', '$no_telepon', '$nama_foto', '$status_id', '$jabatan_id', '$nip')";
    $result1 = $koneklocalhost->query($sql1);

    // Periksa apakah query berhasil
    if (!$result1) {
        // Jika terjadi kesalahan, rollback transaksi dan tampilkan pesan error
        $koneklocalhost->rollback();
        echo "Transaksi gagal, silakan coba lagi.";
        exit;
    }

    // Pindahkan foto guru ke lokasi yang ditentukan
    move_uploaded_file($tmp_foto, $lokasi_foto);

    // Commit transaksi jika semua pernyataan SQL berhasil
    $koneklocalhost->commit();
    echo "Data guru berhasil disimpan";
    header('Location: dataguru.php');
    exit;
} catch (Exception $e) {
    // Tangani kesalahan
    $koneklocalhost->rollback();
    echo "Error: " . $e->getMessage();
}

// Tutup koneksi database
$koneklocalhost->close();
?>
