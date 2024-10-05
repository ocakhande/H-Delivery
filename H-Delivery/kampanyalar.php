<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kampanyalar | H-Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="CSS/kampanyalar.css">
</head>
<body>
  <header>
    <!-- Navbar -->
    <?php include('Components/navbar.php'); ?>
  </header>

  <div class="container mt-5">
    <h3 class="text-center mb-5">Müşterilerimize Özel Kampanyalar</h3>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <!-- Kampanya kartları -->
      <div class="col">
        <div class="card h-100">
          <img src="icons/kampanya/kamp1.jpg" class="card-img-top" alt="Öğretmen Öğrenci İndirimi">
          <div class="card-body">
            <h5 class="card-title">Öğretmen Öğrenci İndirimi: %25 İndirim!</h5>
            <p class="card-text">Öğretmen ve öğrencilere özel %25 indirim fırsatını kaçırmayın.</p>
            <a href="#" class="btn btn-primary">Detaylar</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100">
          <img src="icons/kampanya/kamp2.jpg" class="card-img-top" alt="Doğum Günü İndirimi">
          <div class="card-body">
            <h5 class="card-title">Doğum Günü İndirimi: %20 İndirim!</h5>
            <p class="card-text">Doğum günü olanlar için tüm gönderimlerde %20 indirim fırsatı.</p>
            <a href="#" class="btn btn-primary">Detaylar</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100">
          <img src="icons/kampanya/kamp3.jpg" class="card-img-top" alt="Ücretsiz Ambalaj">
          <div class="card-body">
            <h5 class="card-title">Kırılabilir Eşyalara Ücretsiz Ambalaj</h5>
            <p class="card-text">Kırılabilir eşyalarınız için ücretsiz sağlam ambalaj hizmeti sunuyoruz.</p>
            <a href="#" class="btn btn-primary">Detaylar</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100">
          <img src="icons/kampanya/kamp4.jpg" class="card-img-top" alt="Özel Günler Kampanyası">
          <div class="card-body">
            <h5 class="card-title">Özel Günler Kampanyası: Anneler Günü'ne Özel!</h5>
            <p class="card-text">Özel günlerde indirimler ve hediye paketleme seçenekleri sizleri bekliyor.</p>
            <a href="#" class="btn btn-primary">Detaylar</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100">
          <img src="icons/kampanya/kamp5.jpg" class="card-img-top" alt="Sosyal Medya Kampanyası">
          <div class="card-body">
            <h5 class="card-title">Sosyal Medya Kampanyası: Takip Edin!</h5>
            <p class="card-text">Sosyal medya üzerinden takip ederek özel kampanya ve indirimlerimizden haberdar olun.</p>
            <a href="#" class="btn btn-primary">Detaylar</a>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100">
          <img src="icons/kampanya/kamp6.png" class="card-img-top" alt="Esnaf Kampanyası">
          <div class="card-body">
            <h5 class="card-title">Esnaf Kampanyası: Özel Fırsatlar!</h5>
            <p class="card-text">Esnaf üyelerimize özel indirimler ve avantajlar sunuyoruz.</p>
            <a href="#" class="btn btn-primary">Detaylar</a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- FOOTER -->
  <div class="footer-container">
    <?php include('Components/footer.php'); ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
