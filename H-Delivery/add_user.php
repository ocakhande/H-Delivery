<?php
include('Database/db.php');
include('Functions/session_manager.php');
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kullanıcı Ekle | H-Delivery</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/add_user.css">
  <style>
    .alert {
      text-align: center;
    }
  </style>
</head>
<body>
    <!--NAVBAR -->
    <header>
    <?php include('Components/user_navbar.php');?>
    </header>

    <div class="container-fluid">
      <div class="row">
        
        <!-- Side Navigation -->
        <?php include('Components/admin_sidenavbar.php');?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2 text-center">Kullanıcı Ekle</h1>
          </div>

          <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error']; ?>
          </div>
          <?php unset($_SESSION['error']); ?>
          <?php endif; ?>

          <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success']; ?>
          </div>
          <?php unset($_SESSION['success']); ?>
          <?php endif; ?>

          <div class="container my-5">
            <div class="row justify-content-center">
              <div class="col-lg-5">
                <div class="form-container">
                  <form id="addUserForm" action="Functions/register_user.php" method="POST">
                    <div class="mb-3">
                      <input type="email" class="form-control" id="email" name="email" placeholder="E-Posta Adresi" required>
                    </div>
                    <div class="mb-3 position-relative">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Şifre" required>
                      <img src="icons/eye.png" width="20px" class="eye-icon position-absolute end-0 top-50 translate-middle-y toggle-password" style="cursor: pointer;" alt="Şifreyi Göster">
                    </div>

                    <div class="mb-3 position-relative">
                      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Şifre Tekrarı" required>
                      <img src="icons/eye.png" width="20px" class="eye-icon-confirm position-absolute end-0 top-50 translate-middle-y toggle-confirm-password" style="cursor: pointer;" alt="Şifreyi Göster">
                    </div>

                    <div class="mb-3">
                      <select class="form-select" id="role" name="role" required>
                        <option value="" disabled selected>Rol Seçiniz</option>
                        <option value="admin">Admin</option>
                        <option value="employee">Çalışan</option>
                      </select>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-warning" name="btn_add_user">Kullanıcı Ekle</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

    <!-- FOOTER -->
    <?php include('Components/footer.php');?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function() {
      $(".eye-icon").click(function() {
        var passwordField = $(this).prev("input");

        if (passwordField.attr("type") === "password") {
          passwordField.attr("type", "text");
          $(this).attr("src", "icons/eye.png");
        } else {
          passwordField.attr("type", "password");
          $(this).attr("src", "icons/eye.png");
        }
      });

      $(".eye-icon-confirm").click(function() {
        var confirmPasswordField = $(this).prev("input");

        if (confirmPasswordField.attr("type") === "password") {
          confirmPasswordField.attr("type", "text");
          $(this).attr("src", "icons/eye.png");
        } else {
          confirmPasswordField.attr("type", "password");
          $(this).attr("src", "icons/eye.png");
        }
      });

      setTimeout(function() {
        $(".alert").fadeOut("slow", function() {
          $(this).remove();
        });
      }, 2500);
    });
    </script>

</body>
</html>
