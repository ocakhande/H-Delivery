<?php
include('Database/db.php');
include('Functions/filter_input.php');
include('Functions/session_manager.php');


$errors = array();
$success_msg = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];


if (empty($current_password)) {
    $errors['current_password'] = 'Mevcut şifre boş olamaz.';
}

if (empty($new_password)) {
    $errors['new_password'] = 'Yeni şifre boş olamaz.';
} elseif (!validate_password($new_password)) {
    $errors['new_password'] = 'Yeni şifreniz en az 8 karakterden oluşmalı, bir büyük harf, bir küçük harf, bir rakam ve bir özel karakter içermelidir.';
}

if (empty($confirm_password)) {
    $errors['confirm_password'] = 'Yeni şifre tekrar boş olamaz.';
} elseif ($new_password !== $confirm_password) {
    $errors['confirm_password'] = 'Yeni şifreler uyuşmuyor.';
}


    if (empty($errors)) {
        $user_id = $_SESSION['user_id'];


        $query = "SELECT password FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $current_password_hash = $user['password'];

            if (password_verify($current_password, $current_password_hash)) {
                $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);


                $update_query = "UPDATE users SET password = ? WHERE id = ?";
                $update_stmt = $conn->prepare($update_query);
                $update_stmt->bind_param('si', $new_password_hash, $user_id);

                if ($update_stmt->execute()) {
                    $success_msg = 'Şifreniz başarıyla değiştirildi.';
                } else {
                    $errors['db_error'] = 'Şifre güncelleme işlemi sırasında bir hata oluştu.';
                }
            } else {
                $errors['current_password'] = 'Mevcut şifrenizi yanlış girdiniz.';
            }
        } else {
            $errors['db_error'] = 'Kullanıcı bulunamadı.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Şifre Değiştir | H-Delivery</title>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/add_user.css">

</head>
<body>
  <!-- NAVBAR -->
  <header>
    <?php include('Components/user_navbar.php'); ?>
  </header>

  <div class="container-fluid">
    <div class="row">
      <!-- Side Navigation -->
      <?php
        if ($role === 'admin') {
            include('Components\admin_sidenavbar.php');
        } elseif ($role === 'employee') {
            include('Components\user_sidebar.php');
        }
      ?>


      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <!-- Form -->
        <div class="container my-5">
          <div class="row justify-content-center">
            <div class="col-md-6">
              <h2 class="text-center mb-4">Şifre Değiştir</h2>
              <div class="mt-1 mb-2"> 
              <!-- Error and Success Messages -->
              <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger" role="alert" id="error-alert">
                  <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>

              <?php if (!empty($success_msg)) : ?>
                <div class="alert alert-success" role="alert" id="success-alert">
                  <?php echo $success_msg; ?>
                </div>
              <?php endif; ?>
              
              <form action="change_password.php" method="POST" id="change-password-form">
                <div class="mb-3">
                  <input type="password" class="form-control" name="current_password" placeholder="Mevcut Şifre" required>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" name="new_password" placeholder="Yeni Şifre" required>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" name="confirm_password" placeholder="Yeni Şifre Tekrar" required>
                </div>
                <button type="submit" class="btn btn-warning btn-block" name="change_password_btn" id="change-password-btn">Şifre Değiştir</button>
              </form>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include('Components/footer.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    window.setTimeout(function() {
      var errorAlert = document.getElementById('error-alert');
      if (errorAlert) {
        errorAlert.style.display = 'none';
      }

      var successAlert = document.getElementById('success-alert');
      if (successAlert) {
        successAlert.style.display = 'none';
      }
    }, 2500);

    var formDiv = document.querySelector('.container.my-5');
    var formButton = document.getElementById('change-password-btn');
    formButton.style.display = 'block';
    formButton.style.margin = 'auto';
  </script>
</body>
</html>
