<?php
session_start();
include('../Database/db.php');

$errors = array();

if (isset($_POST['edit_emp_btn'])) {
    $employeeID = mysqli_real_escape_string($conn, $_POST['employeeID']);
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $birthDate = mysqli_real_escape_string($conn, $_POST['birthDate']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);


    $query = "UPDATE employees SET 
                fullName='$fullName', 
                email='$email', 
                phoneNumber='$phoneNumber', 
                gender='$gender', 
                birthDate='$birthDate', 
                city='$city', 
                district='$district', 
                address='$address', 
                department='$department', 
                position='$position'
              WHERE id='$employeeID'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = 'Çalışan başarıyla güncellendi.';
        header('Location: ../employer_tables.php');
        exit; 
    } else {
        $_SESSION['error'] = 'Çalışan güncellenirken bir hata oluştu. Lütfen tekrar deneyin.';
        header("Location: ../edit_employee.php?id=$employeeID");
        exit; 
    }
} else {
    $_SESSION['error'] = 'Eksik bilgi gönderildi. Lütfen tekrar deneyin.';
    header('Location: ../employer_tables.php');
    exit;
}

mysqli_close($conn);
?>
