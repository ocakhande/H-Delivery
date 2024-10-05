<?php
session_start();
include('../Database/db.php');

// Giriş kontrolü
if (!isset($_GET['tracking_number']) || !isset($_GET['source_page'])) {
    header("Location: ../home.php");
    exit();
}

// Veri filtreleme kısmı
$trackingNumber = filter_input(INPUT_GET, 'tracking_number', FILTER_SANITIZE_STRING);
$sourcePage = filter_input(INPUT_GET, 'source_page', FILTER_SANITIZE_STRING);


// SQL sorgusu
$stmt = mysqli_prepare($conn, "SELECT * FROM cargo_data WHERE tracking_number = ?");
if ($stmt === false) {
    header("Location: ../home.php");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $trackingNumber);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if ($result === false) {
    header("Location: ../home.php");
    exit();
}

if (mysqli_num_rows($result) > 0) {
    
    $row = mysqli_fetch_assoc($result);
    //Kargo detaylarının sessiona kaydedilmesi
    $_SESSION['cargo_details'] = $row;
    header("Location: ../cargo_details.php");
    exit();
} else {
    header("Location: ../$sourcePage?error=cargo_not_found");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
