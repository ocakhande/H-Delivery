<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kargo Takip | H-Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="CSS/alert.css">


</head>
<body>
  <header>
    <!--NAVBAR-->
    <?php include('Components\navbar.php'); ?>
  </header>
  <div class="container mt-5 content-wrapper">
    <?php if (isset($_GET['error']) && $_GET['error'] == 'cargo_not_found'): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Hatalı kargo takip numarası girdiniz. Lütfen tekrar deneyin.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <div class="container my-5">
      <div class="row">
        <div class="col-lg-6">
          <img src="icons\6159988.jpg" class="about-img img-fluid" alt="About Us Image">
        </div>
        <div class="col-lg-6">
          <div class="h-100 p-5 bg-light border rounded-3">
            <h1>Kargonuzu Hızlıca Takip Edin!</h1>
            <p>Kargonuzun durumunu öğrenmek için gönderi kodunuzu girin ve kargonuz hakkında detaylı bilgi alın.</p>
            <form action="Functions/sorgula.php" method="GET" class="d-flex mt-3">
              <input type="hidden" name="source_page" value="tracking_cargo.php">
              <input class="form-control me-2" type="text" maxlength="13" name="tracking_number" placeholder="Takip Numarası Girin" aria-label="Search" required>
              <button class="btn btn-warning" type="submit">Sorgula</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <div class="footer-container">
    <?php include('Components\footer.php'); ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
