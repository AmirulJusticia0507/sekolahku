<?php
include 'konekke_local.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $status_id = $_POST['status_id'];
    $jabatan_id = $_POST['jabatan_id'];
    $foto_guru = $_FILES['foto_guru']['name'];

    // Upload foto guru jika ada file baru yang diunggah
    if ($foto_guru) {
        $target_dir = "uploads/guru/";
        $target_file = $target_dir . basename($_FILES["foto_guru"]["name"]);
        move_uploaded_file($_FILES["foto_guru"]["tmp_name"], $target_file);
    }

    // Update data guru
    $sql = "UPDATE guru SET nama=?, tempat_lahir=?, tanggal_lahir=?, jenis_kelamin=?, alamat=?, email=?, no_telepon=?, status_id=?, jabatan_id=?, foto_guru=? WHERE nip=?";
    $stmt = $koneklocalhost->prepare($sql);
    $stmt->bind_param("sssssssssss", $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $alamat, $email, $no_telepon, $status_id, $jabatan_id, $foto_guru, $nip);
    
    if ($stmt->execute()) {
        header("Location: rekapdataguru.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $koneklocalhost->close();
}
?>
