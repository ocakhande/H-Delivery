<?php
session_start();
include('../Database/db.php'); 
include('filter_input.php'); // Filter fonskiyonu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri temizleme
    $sanitized_post = sanitize_all_inputs($_POST);

    // Temizlenmiş verileri değişkenlere ata
    $name = $sanitized_post['name'];
    $email = $sanitized_post['email'];
    $phone = $sanitized_post['phone'];
    $subject = $sanitized_post['subject'];
    $message = $sanitized_post['message'];

    // İsim doğrulama
    if (!is_valid_name($name)) {
        $_SESSION['error_message'] = 'Geçersiz isim formatı. Lütfen sadece harf ve boşluk kullanın.';
        header("Location: ../contact-us.php");
        exit();
    }

    // E-posta doğrulama
    if (!validate_email($email)) {
        $_SESSION['error_message'] = 'Geçersiz e-posta adresi';
        header("Location: ../contact-us.php");
        exit();
    }

    // Telefon numarası doğrulama
    if (!validate_phone_number($phone)) {
        $_SESSION['error_message'] = 'Geçersiz telefon numarası';
        header("Location: ../contact-us.php");
        exit();
    }

    // Veritabanına ekleme sorgusu
    $sql = "INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Mesajınız başarıyla gönderildi!";
        header("Location: ../contact-us.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Mesajınız gönderilirken bir hata oluştu: " . $conn->error;
        header("Location: ../contact-us.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
