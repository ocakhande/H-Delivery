<?php
session_start();

// Tüm oturum değişkenlerini sil
session_unset();

// Oturumu sonlandır
session_destroy();

header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache");
header("Expires: 0"); 

//Giris sayfasına yönlendirme 
header("Location: ../admin_login.php");
exit();
?>
