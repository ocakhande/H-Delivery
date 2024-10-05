<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kargo Takip | H-Delivery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="CSS/alert.css">
  <script src="/H-Delivery/JS/send_cargo.js"></script>

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
          <img src="icons\calc.jpg" class="about-img img-fluid" alt="About Us Image">
        </div>
        <div class="col-lg-6">
          <div class="h-100 p-5 bg-light border rounded-3">
          <h3 class="mb-4 text-center">Kargo Ücreti Hesapla</h3>
          <div class="mb-3">
            <select class="form-select" id="cargoType" name="cargoType" required>
              <option value="" disabled selected>Kargo Türü Seçiniz</option>
              <option value="standart">Standart Kargo</option>
              <option value="kirilabilir">Kırılabilir Eşya</option>
              <option value="degerli">Değerli Eşya</option>
              <option value="gida">Gıda</option>
            </select>
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" id="cargoWeight" name="cargoWeight" placeholder="Ağırlık (kg)" required>
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" id="cargoLength" name="cargoLength" placeholder="Uzunluk (cm)" required>
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" id="cargoWidth" name="cargoWidth" placeholder="Genişlik (cm)" required>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paymentType" id="receiverPaid" value="receiverPaid" required>
              <label class="form-check-label" for="receiverPaid">
                Alıcı Ödemeli
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paymentType" id="senderPaid" value="senderPaid">
              <label class="form-check-label" for="senderPaid">
                Gönderici Ödemeli
              </label>
            </div>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="cargoPrice" name="cargoPrice" placeholder="Kargo Ücreti (TL)" readonly>
          </div>
          </form> <br>
          <div class="container mt-3 text-center">
  <p>***Hesaplanan fiyatlara herhangi bir indirim dahil edilmemiştir. Mevcut kampanyalardan haberdar olmak için <a href="kampanyalar.php">kampanyalar</a> sayfasını ziyaret edebilir, şubelerimizden detaylı bilgi alabilirsiniz.</p>
</div>
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
