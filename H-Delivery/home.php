<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Anasayfa | H-Delivery</title>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="CSS/anasayfa.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <header>
    <!--NAVBAR -->
    <?php include('Components/navbar.php');?>
  </header>

  <!--CAROUSEL -->
  <div id="carouselExampleIndicators" class="carousel slide col-8 mx-auto" data-bs-ride="carousel" data-bs-interval="2000">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="icons/1.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="icons/2.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="icons/3.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="icons/4.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- ALERT -->
  <div class="container mt-5">
    <?php if (isset($_GET['error']) && $_GET['error'] == 'cargo_not_found'): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Hatalı kargo takip numarası girdiniz. Lütfen tekrar deneyin.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
  </div>

  <!-- Gönderi Sorgula -->
  <div class="container my-5">
    <div class="row">
      <div class="col-md-5 offset-sm-1 mb-4">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h1>Kargonuzu Hızlıca Takip Edin!</h1>
          <p>Kargonuzun durumunu öğrenmek için gönderi kodunuzu girin ve detaylı bilgi alın.</p>
          <form action="Functions/sorgula.php" method="GET" class="d-flex">
            <input type="hidden" name="source_page" value="home.php">
            <input class="form-control me-2" type="text" maxlength="13" name="tracking_number" placeholder="Takip Numarası Girin" aria-label="Search" required>
            <button class="btn btn-warning" type="submit">Sorgula</button>
          </form>
        </div>
      </div>
      <div class="col-md-5 mb-4">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h1>Son Kampanyaları Kaçırmayın!</h1>
          <p>H-Delivery'de yapacağınız gönderilerde özel indirimler ve kampanyaları keşfedin. %25 indirim fırsatını kaçırmayın!</p>
          <a href="#" class="btn btn-warning">Kampanyalara Göz At</a>
        </div>
      </div>
    </div>
  </div>

  <!-- CARDS -->
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-center">"Gönderdiğiniz Kargolar Birilerine Hayat Olsun"</h2>
        <hr>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-sm-3 mb-2">
        <div class="card">
          <img src="Cards-img/cydd.png" class="card-img-top" alt="Çağdaş Yaşamı Destekleme Derneği" height="150px">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary btn-sm">Daha Fazla</a>
          </div>
        </div>
      </div>
      <div class="col-sm-3 mb-2">
        <div class="card">
          <img src="Cards-img/losev.png" class="card-img-top" alt="Lösev" height="150px">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary btn-sm">Daha Fazla</a>
          </div>
        </div>
      </div>
      <div class="col-sm-3 mb-2">
        <div class="card">
          <img src="Cards-img/ahbap.png" class="card-img-top" alt="Ahbap" height="150px">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary btn-sm">Daha Fazla</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="footer">
    <?php include('Components/footer.php'); ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
      document.addEventListener("DOMContentLoaded", function() {
          // URL'deki 'error' parametresini kaldır
          const params = new URLSearchParams(window.location.search);
          if (params.has('error')) {
              params.delete('error');
              const newUrl = window.location.pathname + '?' + params.toString();
              window.history.replaceState({}, document.title, newUrl);
          }
      });
    </script>
  </body>
</html>
