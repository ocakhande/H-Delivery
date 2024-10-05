<?php
session_start();
include('../Database/db.php'); // Veritabanı bağlantısını dahil etme

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cargoId = $_POST['cargoId'];
    $newStatus = $_POST['status'];
    $updateTime = date("Y-m-d H:i:s");

    // Eski durum geçmişini alma
    $sqlSelect = "SELECT * FROM cargo_data WHERE id = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param('i', $cargoId);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $statusHistory = json_decode($row['status_history'], true);

        // Yeni durumu ve güncelleme zamanını status_history dizisine ekleme
        $statusHistory[] = array('status' => $newStatus, 'updated_at' => $updateTime);

        // JSON formatına çevirip güncelleme
        $statusHistoryJson = json_encode($statusHistory);
        
        // Durumu ve durum geçmişini güncelleme
        $sqlUpdate = "UPDATE cargo_data SET status = ?, status_history = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param('ssi', $newStatus, $statusHistoryJson, $cargoId);

        if ($stmtUpdate->execute()) {
            $_SESSION['message'] = "Kargo durumu başarıyla güncellendi.";
        } else {
            $_SESSION['message'] = "Kargo durumu güncellenirken bir hata oluştu.";
        }
    } else {
        $_SESSION['message'] = "Kargo bulunamadı.";
    }

    $stmtSelect->close();
    $stmtUpdate->close();
    $conn->close();

    header('Location: ../cargo_tables.php'); 
    exit();
}
?>
