<?php
session_start();
include('../Database/db.php'); 
include('filter_input.php');

if(isset($_POST['cargo_save'])) {
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
    $paymentType = mysqli_real_escape_string($conn, $_POST['paymentType']);
    $cargoPrice = mysqli_real_escape_string($conn, $_POST['cargoPrice']);

    if (!validate_phone_number($receiverPhoneNumber)) {
        $_SESSION['error'] = "Lütfen geçerli bir alıcı telefon numarası girin.";
        header("Location: ../send_cargo.php");
        exit();
    }

    if (!validate_phone_number($senderPhoneNumber)) {
        $_SESSION['error'] = "Lütfen geçerli bir gönderici telefon numarası girin.";
        header("Location: ../send_cargo.php");
        exit();
    }
    if (!validate_email($receiverEmail)) {
        $_SESSION['error'] = "Lütfen geçerli bir alıcı e-posta adresi girin.";
        header("Location: ../send_cargo.php");
        exit();
    }

    if (!validate_email($senderEmail)) {
        $_SESSION['error'] = "Lütfen geçerli bir gönderici e-posta adresi girin.";
        header("Location: ../send_cargo.php");
        exit();
    }


    $trackingNumber = uniqid();
    $createdAt = date("Y-m-d H:i:s");


    $insert_query = "INSERT INTO cargo_data (tracking_number, created_at, receiverFullName, receiverEmail, receiverPhoneNumber, receiverCity, receiverDistrict, receiverAddress,
                       senderFullName, senderEmail, senderPhoneNumber, senderCity, senderDistrict, senderAddress,
                       type, weight, length, width, paymentType, price)
                     VALUES ('$trackingNumber', '$createdAt','$receiverFullName', '$receiverEmail', '$receiverPhoneNumber', '$receiverCity', '$receiverDistrict', '$receiverAddress',
                             '$senderFullName', '$senderEmail', '$senderPhoneNumber', '$senderCity', '$senderDistrict', '$senderAddress',
                             '$cargoType', '$cargoWeight', '$cargoLength', '$cargoWidth', '$paymentType', '$cargoPrice')";


    if(mysqli_query($conn, $insert_query)) {
        $_SESSION['success'] = "Kargo bilgileri başarıyla kaydedildi.";
    } else {
        $_SESSION['error'] = "Kargo bilgileri kaydedilirken bir hata oluştu: " . mysqli_error($conn);
    }

    header("Location: ../send_cargo.php");
    exit();
}
?>
