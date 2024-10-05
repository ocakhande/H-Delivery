<?php
session_start();
include('../Database/db.php');

$errors = array();

if (isset($_POST['save_changes'])) {
    $cargoID = mysqli_real_escape_string($conn, $_POST['cargoID']);
    $cargoID = mysqli_real_escape_string($conn, $_POST['cargoID']);
    $receiverFullName = mysqli_real_escape_string($conn, $_POST['receiverFullName']);
    $receiverEmail = mysqli_real_escape_string($conn, $_POST['receiverEmail']);
    $receiverPhoneNumber = mysqli_real_escape_string($conn, $_POST['receiverPhoneNumber']);
    $receiverCity = mysqli_real_escape_string($conn, $_POST['receiverCity']);
    $receiverDistrict = mysqli_real_escape_string($conn, $_POST['receiverDistrict']);
    $receiverAddress = mysqli_real_escape_string($conn, $_POST['receiverAddress']);

    $senderFullName = mysqli_real_escape_string($conn, $_POST['senderFullName']);
    $senderEmail = mysqli_real_escape_string($conn, $_POST['senderEmail']);
    $senderPhoneNumber = mysqli_real_escape_string($conn, $_POST['senderPhoneNumber']);
    $senderCity = mysqli_real_escape_string($conn, $_POST['senderCity']);
    $senderDistrict = mysqli_real_escape_string($conn, $_POST['senderDistrict']);
    $senderAddress = mysqli_real_escape_string($conn, $_POST['senderAddress']);

    $cargoType = mysqli_real_escape_string($conn, $_POST['cargoType']);
    $cargoWeight = mysqli_real_escape_string($conn, $_POST['cargoWeight']);
    $cargoLength = mysqli_real_escape_string($conn, $_POST['cargoLength']);
    $cargoWidth = mysqli_real_escape_string($conn, $_POST['cargoWidth']);
    $cargoPrice = mysqli_real_escape_string($conn, $_POST['cargoPrice']);
    $cargoStatus = mysqli_real_escape_string($conn, $_POST['cargoStatus']);
    

    // Update Query
    $query = "UPDATE cargo_data SET 
                receiverFullName='$receiverFullName', 
                receiverEmail='$receiverEmail', 
                receiverPhoneNumber='$receiverPhoneNumber', 
                receiverCity='$receiverCity', 
                receiverDistrict='$receiverDistrict', 
                receiverAddress='$receiverAddress', 
                senderFullName='$senderFullName', 
                senderEmail='$senderEmail', 
                senderPhoneNumber='$senderPhoneNumber', 
                senderCity='$senderCity', 
                senderDistrict='$senderDistrict', 
                senderAddress='$senderAddress', 
                type='$cargoType', 
                weight='$cargoWeight', 
                length='$cargoLength', 
                width='$cargoWidth', 
                price='$cargoPrice', 
                status='$cargoStatus'
              WHERE id='$cargoID'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = 'Kargo başarıyla güncellendi.';
        header('Location: ../cargo_tables.php');
        exit; 
    } else {
        $_SESSION['error'] = 'Kargo güncellenirken bir hata oluştu. Lütfen tekrar deneyin.';
        header("Location: ../edit_cargo.php?id=$cargoID");
        exit; 
    }
} else {
    $_SESSION['error'] = 'Eksik bilgi gönderildi. Lütfen tekrar deneyin.';
    header('Location: ../cargo_tables.php');
    exit; 
}

mysqli_close($conn);
?>
