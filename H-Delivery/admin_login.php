<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Giriş Yap | H-Delivery</title>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS\giris-yap.css">
</head>
<body>
  <!--NAVBAR-->
  <header>
    <?php include('Components\navbar.php');?>
  </header>
  <!-- Giriş Paneli -->
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger text-center" role="alert">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
          </div>
        <?php endif; ?>
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="admin-login-tab" data-bs-toggle="tab" data-bs-target="#admin-login" type="button" role="tab" aria-controls="admin-login" aria-selected="true">Admin Girişi</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="employee-login-tab" data-bs-toggle="tab" data-bs-target="#employee-login" type="button" role="tab" aria-controls="employee-login" aria-selected="false">Çalışan Girişi</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active login-container" id="admin-login" role="tabpanel" aria-labelledby="admin-login-tab">
            <h2>Admin Girişi</h2>
            <form action="Functions/login.php" method="POST">
              <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="E-Posta Adresi" required>
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Şifre" required>
              </div>
              <input type="hidden" name="role" value="admin">
              <button type="submit" class="btn btn-warning" name="login_btn">Giriş Yap</button>
            </form>
          </div>
          <div class="tab-pane fade login-container" id="employee-login" role="tabpanel" aria-labelledby="employee-login-tab">
            <h2>Çalışan Girişi</h2>
            <form action="Functions/login.php" method="POST">
              <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="E-Posta Adresi" required>
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Şifre" required>
              </div>
              <input type="hidden" name="role" value="employee">
              <button type="submit" class="btn btn-warning" name="login_btn">Giriş Yap</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- FOOTER -->
  <footer class="fixed-bottom">
    <?php include('Components\footer.php');?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
