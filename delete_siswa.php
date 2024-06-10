<?php
include 'konekke_local.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis'];
    $alasan = $_POST['alasan'];

    // Ambil data siswa sebelum dihapus
    $sql = "SELECT * FROM siswa WHERE nis = ?";
    $stmt = $koneklocalhost->prepare($sql);
    $stmt->bind_param("s", $nis);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $siswa = $result->fetch_assoc();

        // Simpan data siswa ke riwayat_hapus_siswa sebelum dihapus
        $sql = "INSERT INTO riwayat_hapus_siswa (nis, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, email, no_telepon, kelas, foto_siswa, alasan_penghapusan)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $koneklocalhost->prepare($sql);
        $stmt->bind_param("sssssssssss", $siswa['nis'], $siswa['nama'], $siswa['tempat_lahir'], $siswa['tanggal_lahir'], $siswa['jenis_kelamin'], $siswa['alamat'], $siswa['email'], $siswa['no_telepon'], $siswa['kelas'], $siswa['foto_siswa'], $alasan);
        $stmt->execute();

        // Hapus data siswa
        $sql = "DELETE FROM siswa WHERE nis = ?";
        $stmt = $koneklocalhost->prepare($sql);
        $stmt->bind_param("s", $nis);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus data siswa']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Data siswa tidak ditemukan']);
    }

    $stmt->close();
    $koneklocalhost->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Metode request tidak valid']);
}
?>
