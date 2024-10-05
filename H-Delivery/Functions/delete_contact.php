<?php
include('../Database/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM contact_messages WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Mesaj silinirken bir hata oluştu.']);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Geçersiz istek.']);
}
?>
