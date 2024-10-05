<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>İletişim | H-Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="CSS/iletisim.css">
</head>
<body>
  <header>
    <?php include('Components/navbar.php'); ?>
  </header>

  <div class="container">
    <?php
    session_start(); 
    if (isset($_SESSION['success_message'])) {
        echo '<div id="success-alert" class="alert alert-success alert-dismissible fade show text-center" role="alert">'
             . $_SESSION['success_message'] .
             '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['error_message'])) {
        echo '<div id="error-alert" class="alert alert-danger alert-dismissible fade show text-center" role="alert">'
             . $_SESSION['error_message'] .
             '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        unset($_SESSION['error_message']);
    }
    ?>
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="contact-image">
          <img src="Cards-img/Contact.png" class="img-fluid" alt="Contact Image">
        </div>
      </div>
      <div class="col-lg-6 offset-lg-3">
        <div class="contact-form">
          <h2 class="contact-title">Bize Ulaşın</h2>
          <form action="Functions/submit_contact.php" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label"></label>
              <input type="text" class="form-control" id="name" name="name" placeholder="İsim Soyisim" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label"></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail Adresi" required>
            </div>            
            <div class="mb-3">
              <label for="phone" class="form-label"></label>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="İletişim Numarası" pattern="0\d{3} \d{3} \d{4}" required>
              <small class="form-text text-muted">Format: 0XXX XXX XXXX</small>
            </div>
            <div class="mb-3">
              <label for="subject" class="form-label"></label>
              <select class="form-select" id="subject" name="subject" required>
                <option value="">Konu</option>
                <option value="bilgi">Bilgi Talebi</option>
                <option value="sikayet">Şikayet</option>
                <option value="oneri">Öneri</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label"></label>
              <textarea class="form-control" id="message" name="message" rows="5" placeholder="Mesajınızı buraya yazınız..." required></textarea>
            </div>

            <div class="text-center"> 
              <button type="submit" class="btn btn-warning">Gönder</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <hr>
  <div class="footer-container">
    <?php include('Components/footer.php'); ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var alertElement = document.getElementById('success-alert');
      if (alertElement) {
        setTimeout(function() {
          var alert = new bootstrap.Alert(alertElement);
          alert.close();
        }, 1000);
      }

      var errorAlertElement = document.getElementById('error-alert');
      if (errorAlertElement) {
        setTimeout(function() {
          var alert = new bootstrap.Alert(errorAlertElement);
          alert.close();
        }, 2000);
      }
    });
  </script>
</body>
</html>