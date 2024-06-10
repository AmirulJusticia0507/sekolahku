<?php
include 'konekke_local.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $alasan = $_POST['alasan'];

    // Ambil data guru sebelum dihapus
    $sql = "SELECT * FROM guru WHERE nip = ?";
    $stmt = $koneklocalhost->prepare($sql);
    $stmt->bind_param("s", $nip);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $guru = $result->fetch_assoc();

        // Simpan data guru ke riwayat_hapus_guru sebelum dihapus
        $sql = "INSERT INTO riwayat_hapus_guru (nip, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, email, no_telepon, status_id, jabatan_id, foto_guru, alasan_penghapusan)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $koneklocalhost->prepare($sql);
        $stmt->bind_param("ssssssssssss", $guru['nip'], $guru['nama'], $guru['tempat_lahir'], $guru['tanggal_lahir'], $guru['jenis_kelamin'], $guru['alamat'], $guru['email'], $guru['no_telepon'], $guru['status_id'], $guru['jabatan_id'], $guru['foto_guru'], $alasan);
        $stmt->execute();

        // Hapus data guru
        $sql = "DELETE FROM guru WHERE nip = ?";
        $stmt = $koneklocalhost->prepare($sql);
        $stmt->bind_param("s", $nip);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
            header('Location: dataguru.php');
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus data guru']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Data guru tidak ditemukan']);
    }

    $stmt->close();
    $koneklocalhost->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Metode request tidak valid']);
}
?>
