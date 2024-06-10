<?php
require 'konekke_local.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = $_POST['nip'];

    $sql = "SELECT * FROM guru WHERE nip = ?";
    $stmt = $koneklocalhost->prepare($sql);
    $stmt->bind_param("s", $nip);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Data not found']);
    }

    $stmt->close();
    $koneklocalhost->close();
}
?>
