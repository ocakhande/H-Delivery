<?php 
include('Database\db.php');
include('Functions\session_manager.php'); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kargo Gönder | H-Delivery</title>
  <script src="/H-Delivery/JS/send_cargo.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="/H-Delivery/JS/il_ilce.js"></script>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/send_cargo.css">
</head>
<body>
  <header>
    <!--NAVBAR -->
    <header>
    <?php include('Components\user_navbar.php');?>
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
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 text-center">Alıcı ve Gönderici Bilgileri</h1>
  </div>

  <!-- Alert mesajları başlangıç -->
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php
            if(isset($_SESSION['success'])) {
                echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
                unset($_SESSION['success']);
            }
            if(isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
                unset($_SESSION['error']);
            }
            ?>
        </div>
    </div>
</div>
        <!-- Alert mesajları bitiş -->

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="form-container">
        <form id="cargoForm" action="Functions/create_cargo.php" method="POST">
          <h3 class="mb-4 text-center">Alıcı Bilgileri</h3>
          <div class="mb-3">
            <input type="text" class="form-control" id="receiverFullName" name="receiverFullName" placeholder="Ad-Soyad" required>
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" id="receiverEmail" name="receiverEmail" placeholder="Mail Adresi" required>
          </div>
          <div class="mb-3">
            <input type="tel" class="form-control" id="receiverPhoneNumber" name="receiverPhoneNumber" placeholder="Telefon Numarası" required>
          </div>
          <div class="mb-3">
            <select class="form-select" id="receiverCity" name="receiverCity" required>
              <option value="" disabled selected>Şehir Seçiniz</option>
            </select>
          </div>
          <div class="mb-3">
            <select class="form-select" id="receiverDistrict" name="receiverDistrict" required>
              <option value="" disabled selected>İlçe Seçiniz</option>
            </select>
          </div>
          <div class="mb-3">
            <textarea class="form-control" id="receiverAddress" name="receiverAddress" rows="3" placeholder="Adres" required></textarea>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="form-container">
          <h3 class="mb-4 text-center">Gönderici Bilgileri</h3>
          <div class="mb-3">
            <input type="text" class="form-control" id="senderFullName" name="senderFullName" placeholder="Ad-Soyad" required>
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" id="senderEmail" name="senderEmail" placeholder="Mail Adresi" required>
          </div>
          <div class="mb-3">
            <input type="tel" class="form-control" id="senderPhoneNumber" name="senderPhoneNumber" placeholder="Telefon Numarası" required>
          </div>
          <div class="mb-3">
            <select class="form-select" id="senderCity" name="senderCity" required>
              <option value="" disabled selected>Şehir Seçiniz</option>
            </select>
          </div>
          <div class="mb-3">
            <select class="form-select" id="senderDistrict" name="senderDistrict" required>
              <option value="" disabled selected>İlçe Seçiniz</option>
            </select>
          </div>
          <div class="mb-3">
            <textarea class="form-control" id="senderAddress" name="senderAddress" rows="3" placeholder="Adres" required></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="form-container">
          <h3 class="mb-4 text-center">Kargo Bilgileri</h3>
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
          <div class="text-center">
            <button type="submit" class="btn btn-warning" name="cargo_save">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<!--FOOTER-->
<?php include('Components\footer.php');?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  <script>
    $(document).ready(function() {
      // Alıcı ve Gönderici Şehir Seçimi
      $.each(data, function(index, value) {
        $('#receiverCity, #senderCity').append($('<option>', {
          value: value.plaka,
          text: value.il
        }));
      });
  
      // Alıcı Şehir Değişim Olayı
      $('#receiverCity').change(function() {
        var selectedCity = $(this).val();
        var ilceler = data.find(item => item.plaka == selectedCity).ilceleri;
        $('#receiverDistrict').html('');
        $.each(ilceler, function(index, value) {
          $('#receiverDistrict').append($('<option>', {
            value: value,
            text: value
          }));
        });
      });
  
      // Gönderici Şehir Değişim Olayı
      $('#senderCity').change(function() {
        var selectedCity = $(this).val();
        var ilceler = data.find(item => item.plaka == selectedCity).ilceleri;
        $('#senderDistrict').html('');
        $.each(ilceler, function(index, value) {
          $('#senderDistrict').append($('<option>', {
            value: value,
            text: value
          }));
        });
      });
    });
      // Alert mesajları
  $('.alert').delay(900).fadeOut('fast');

  </script>
  
</body>
</html>
