<?php
require 'konekke_local.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    $kompetensi_keahlian = implode(", ", $_POST['kompetensi_keahlian']);

    // Handle file upload
    $target_dir = "uploads/siswa/";
    $target_file = $target_dir . basename($_FILES["foto_siswa"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["foto_siswa"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["foto_siswa"]["size"] > 500000) { // 500 KB max size
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["foto_siswa"]["tmp_name"], $target_file)) {
            // Prepare and bind
            $stmt = $koneklocalhost->prepare("INSERT INTO siswa (namasiswa, tempatlahir, tanggal, kelas, nis, alamat, golongan_darah, nama_orangtua, alamat_orangtua, catatan_kesehatan, kompetensi_keahlian, foto_siswa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($koneklocalhost->error));
            }
            $stmt->bind_param("sssissssssss", $namasiswa, $tempatlahir, $tanggal, $kelas, $nis, $alamat, $golongan_darah, $nama_orangtua, $alamat_orangtua, $catatan_kesehatan, $kompetensi_keahlian, $target_file);

            // Execute statement
            if ($stmt->execute()) {
                echo "New record created successfully";
                header('Location: datasiswa.php');
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $koneklocalhost->close();
}
?>
