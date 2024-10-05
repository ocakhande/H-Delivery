<?php
include('../Database/db.php');
include('filter_input.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al ve sanitize et
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $confirmPassword = sanitize_input($_POST['confirmPassword']);
    $role = sanitize_input($_POST['role']);

    // Email doğrulama
    if (!validate_email($email)) {
        $_SESSION['error'] = 'Geçersiz e-posta adresi.';
        header('Location: ../add_user.php');
        exit;
    }

    // Şifre doğrulama
    if (!validate_password($password)) {
        $_SESSION['error'] = 'Şifre en az 8 karakter olmalı, bir büyük harf, bir küçük harf ve bir özel karakter içermeli.';
        header('Location: ../add_user.php');
        exit;
    }

    // Şifreler aynı mı 
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = 'Şifreler eşleşmiyor.';
        header('Location: ../add_user.php');
        exit;
    }

    // Şifreyi hash'le
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Rol ID'sini bulma
    $query = "SELECT id FROM roles WHERE role_name = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $role);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $role_id = $row['id'];

        // E-posta adresinin tekrarlanıp tekrarlanmadığını kontrol et
        $email_check_query = "SELECT id FROM users WHERE email = ?";
        $stmt_check = mysqli_prepare($conn, $email_check_query);
        mysqli_stmt_bind_param($stmt_check, 's', $email);
        mysqli_stmt_execute($stmt_check);
        $result_check = mysqli_stmt_get_result($stmt_check);

        if (mysqli_num_rows($result_check) > 0) {
            $_SESSION['error'] = 'Bu e-posta adresi zaten kayıtlı.';
            header('Location: ../add_user.php');
            exit;
        }

        // Kullanıcıyı veritabanına ekle
        $query_insert = "INSERT INTO users (email, password, role_id) VALUES (?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $query_insert);
        mysqli_stmt_bind_param($stmt_insert, 'ssi', $email, $hashed_password, $role_id);
        $result_insert = mysqli_stmt_execute($stmt_insert);

        if ($result_insert) {
            $_SESSION['success'] = 'Kullanıcı başarıyla eklenmiştir.';
        } else {
            $_SESSION['error'] = 'Kullanıcı eklenirken bir hata oluştu: ' . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt_insert);
        mysqli_stmt_close($stmt_check);
    } else {
        $_SESSION['error'] = 'Geçersiz rol seçimi.';
    }


    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header('Location: ../add_user.php');
    exit;
} else {
    $_SESSION['error'] = 'Geçersiz istek.';
    header('Location: ../add_user.php');
    exit;
}
?>

