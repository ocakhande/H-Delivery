<?php
session_start();
include('../Database/db.php'); 

if(isset($_POST['register_emp_btn'])) {
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

  
    $check_query = "SELECT * FROM employees WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        $_SESSION['error'] = "Bu e-posta adresi zaten kullanılıyor.";
        header("Location: ../add_employer.php");
        exit();
    } else {
        $insert_query = "INSERT INTO employees (fullName, email, phoneNumber, gender, birthDate, city, district, address, department, position)
                         VALUES ('$fullName', '$email', '$phoneNumber', '$gender', '$birthDate', '$city', '$district', '$address', '$department', '$position')";

        if(mysqli_query($conn, $insert_query)) {
            $_SESSION['success'] = "Çalışan başarıyla eklendi.";
            header("Location: ../add_employer.php");
            exit();
        } else {
            $_SESSION['error'] = "Çalışan eklenirken bir hata oluştu: " . mysqli_error($conn);
            header("Location: ../add_employer.php"); 
            exit();
        }
    }
}
?>
