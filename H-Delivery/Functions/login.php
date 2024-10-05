<?php
session_start();
include('../Database/db.php'); // Veritabanı bağlantısı

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Role'ü veritabanında bulmak
    $role_query = "SELECT id FROM roles WHERE role_name = ?";
    $stmt = $conn->prepare($role_query);
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $role_result = $stmt->get_result();
    $role_row = $role_result->fetch_assoc();
    $role_id = $role_row['id'];

    // Kullanıcıyı kontrol etme
    $query = "SELECT * FROM users WHERE email = ? AND role_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $email, $role_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $role;
        header("Location: ../dashboard.php");
        exit();
    } else if ($user && !password_verify($password, $user['password'])) {
        $_SESSION['error'] = "Yanlış şifre veya hesap bilgileri.";
        header("Location: ../admin_login.php");
        exit();
    } else {
        $_SESSION['error'] = "Kullanıcı bulunamadı.";
        header("Location: ../admin_login.php");
        exit();
    }
}
?>
