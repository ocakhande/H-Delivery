<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hakkımızda | H-Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="CSS/hakkimizda.css">

</head>
<body>
  <header>
    <!--NAVBAR-->
  <?php include('Components\navbar.php');?>
  </header>

  <div class="container my-5">
    <div class="row">
      <div class="col-lg-6">
        <img src="icons\about-us1.jpg" class="about-img img-fluid" alt="About Us Image">
      </div>
      <div class="col-lg-6">
        <div class="about-content">
          <h2 class="about-title">Hakkımızda</h2>
          <p class="about-text">H-Delivery, 2020 yılında kurulan ve kısa sürede sektörde önemli bir konuma yükselen kargo ve lojistik hizmetleri sağlayıcısıdır. Müşteri memnuniyeti odaklı çalışma prensibiyle hareket eden şirketimiz, yenilikçi çözümler ve teknolojiyi yakından takip ederek, güvenilir ve hızlı hizmet sunmayı ilke edinmiştir.</p>
          <p class="about-text">Geniş hizmet ağıyla Türkiye genelinde ve uluslararası platformda etkin olan H-Delivery, her türlü gönderi ihtiyacınız için çözümler sunar. Sadece kargo taşımacılığı değil, aynı zamanda özel paketleme, depolama ve hızlı teslimat gibi hizmetlerimizle de müşterilerimize katma değer sağlarız.</p>
          <p class="about-text">Müşteri odaklı yaklaşımımız ve güçlü lojistik altyapımızla, her geçen gün daha da büyüyor ve gelişiyoruz. Detaylı bilgi ve hizmetlerimiz hakkında daha fazla bilgi almak için bizimle iletişime geçebilirsiniz.</p>
        </div>
      </div>
    </div>
  </div>


    <!--CARDS -->

    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="text-center">"Projelerimiz ve Daha Fazlası"</h2>
          <hr>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-sm-3 mb-2">
          <div class="card">
            <img src="icons\Projects\kadin2.jpeg" class="card-img-top" alt="Kadınlara İstihdam" height="150px">
            <div class="card-body">
              <h5 class="card-title">Kadınlara İş İstihdamı</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary btn-sm">Daha Fazla</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3 mb-2">
          <div class="card">
            <img src="icons\Projects\drone.jpeg" class="card-img-top" alt="Drone ile Teslimat" height="150px">
            <div class="card-body">
              <h5 class="card-title">Drone ile Teslimat</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary btn-sm">Daha Fazla</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3 mb-2">
          <div class="card">
            <img src="icons\kamp2.jpg" class="card-img-top" alt="Ahbap" height="150px">
            <div class="card-body">
              <h5 class="card-title">Deprem Bölgesine Ücretsiz Gönderim</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary btn-sm">Daha Fazla</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
      

   <!-- FOOTER -->
   <div class="footer-container">
     <?php include('Components\footer.php');?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
