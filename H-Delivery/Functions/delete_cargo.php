<?php
include('../Database/db.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Veritabanından kargoyu sil
    $sql = "DELETE FROM cargo_data WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Silme işlemi başarısız."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Geçersiz istek."]);
}
?>
