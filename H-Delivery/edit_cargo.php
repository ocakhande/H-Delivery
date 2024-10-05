<?php 
include('Database\db.php');
include('Functions\session_manager.php');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kargo Düzenleme | H-Delivery</title>
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
              global $conn;
              $query = "SELECT * FROM cargo_data WHERE id = {$_GET['id']}";
              $query_run = mysqli_query($conn, $query);

              if (mysqli_num_rows($query_run) > 0) {
                $row = mysqli_fetch_assoc($query_run);
                echo '<div class="alert alert-success" role="alert">Kargo bilgileri başarıyla getirildi.</div>';
              } else {
                echo '<div class="alert alert-danger" role="alert">Kargo bilgileri getirilirken bir hata oluştu.</div>';
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
        <form id="cargoForm" action="Functions/update_cargo.php" method="POST">
          <h3 class="mb-4 text-center">Alıcı Bilgileri</h3>
          <div class="mb-3">
            <input type="text" class="form-control" id="receiverFullName" name="receiverFullName" placeholder="Ad-Soyad" value="<?php echo $row['receiverFullName']; ?>" required>
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" id="receiverEmail" name="receiverEmail" placeholder="Mail Adresi" value="<?php echo $row['receiverEmail']; ?>"  required>
          </div>
          <div class="mb-3">
            <input type="tel" class="form-control" id="receiverPhoneNumber" name="receiverPhoneNumber" placeholder="Telefon Numarası" value="<?php echo $row['receiverPhoneNumber']; ?>" required>
          </div>
          <div class="mb-3">
                    <select class="form-select" id="receiverCity" name="receiverCity" required>
                      <option value="" disabled>Şehir Seçiniz</option>
                    </select>
                  </div>
          <div class="mb-3">
            <select class="form-select" id="receiverDistrict" name="receiverDistrict" value="<?php echo $row['receiverDistrict']; ?>" required>
              <option value="" disabled selected>İlçe Seçiniz</option>
            </select>
          </div>
          <div class="mb-3">
          <textarea class="form-control" id="receiverAddress" name="receiverAddress" rows="3" placeholder="Adres" required><?php echo $row['receiverAddress']; ?></textarea>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="form-container">
          <h3 class="mb-4 text-center">Gönderici Bilgileri</h3>
          <div class="mb-3">
            <input type="text" class="form-control" id="senderFullName" name="senderFullName" placeholder="Ad-Soyad" value="<?php echo $row['senderFullName']; ?>" required>
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" id="senderEmail" name="senderEmail" placeholder="Mail Adresi" value="<?php echo $row['senderEmail']; ?>" required>
          </div>
          <div class="mb-3">
            <input type="tel" class="form-control" id="senderPhoneNumber" name="senderPhoneNumber" placeholder="Telefon Numarası" value="<?php echo $row['senderPhoneNumber']; ?>" required>
          </div>
          <div class="mb-3">
                  <select class="form-select" id="senderCity" name="senderCity" required>
                    <option value="" disabled>Şehir Seçiniz</option>
                  </select>
                </div>
          <div class="mb-3">
            <select class="form-select" id="senderDistrict" name="senderDistrict" value="<?php echo $row['senderDistrict']; ?>" required>
              <option value="" disabled selected>İlçe Seçiniz</option>
            </select>
          </div>
          <div class="mb-3">
            <textarea class="form-control" id="senderAddress" name="senderAddress" rows="3" placeholder="Adres"  required><?php echo $row['senderAddress']; ?></textarea>
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
              <option value="" disabled>Kargo Türü Seçiniz</option>
              <option value="standart" <?php if($row['type'] == 'standart') echo 'selected'; ?>>Standart Kargo</option>
              <option value="kirilabilir" <?php if($row['type'] == 'kirilabilir') echo 'selected'; ?>>Kırılabilir Eşya</option>
              <option value="degerli" <?php if($row['type'] == 'degerli') echo 'selected'; ?>>Değerli Eşya</option>
              <option value="gida" <?php if($row['type'] == 'gida') echo 'selected'; ?>>Gıda</option>
            </select>
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" id="cargoWeight" name="cargoWeight" placeholder="Ağırlık (kg)" value="<?php echo $row['weight']; ?>" required>
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" id="cargoLength" name="cargoLength" placeholder="Uzunluk (cm)" value="<?php echo $row['length']; ?>" required>
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" id="cargoWidth" name="cargoWidth" placeholder="Genişlik (cm)" value="<?php echo $row['width']; ?>" required>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paymentType" id="receiverPaid" value="receiverPaid" <?php if($row['paymentType'] == 'receiverPaid') echo 'checked'; ?> required>
              <label class="form-check-label" for="receiverPaid">
                Alıcı Ödemeli
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="paymentType" id="senderPaid" value="senderPaid" <?php if($row['paymentType'] == 'senderPaid') echo 'checked'; ?> required>
              <label class="form-check-label" for="senderPaid">
                Gönderici Ödemeli
              </label>
            </div>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="cargoPrice" name="cargoPrice" placeholder="Kargo Ücreti (TL)" value="<?php echo $row['price']; ?>" readonly>
          </div>
          <input type="hidden" name="cargoID" value="<?php echo $_GET['id']; ?>">
          <div class="mb-3">
    <select class="form-select" id="cargoStatus" name="cargoStatus" required>
        <option value="" disabled>Durum Seçiniz</option>
        <option value="beklemede" <?php if($row['status'] == 'Gönderi Alındı') echo 'selected'; ?>>Gönderi Alındı</option>
        <option value="yolda" <?php if($row['status'] == 'Taşımada') echo 'selected'; ?>>Taşımada</option>
        <option value="teslim edildi" <?php if($row['status'] == 'Teslim Edildi') echo 'selected'; ?>>Teslim Edildi</option>
        <option value="teslim edildi" <?php if($row['status'] == 'İade Edildi') echo 'selected'; ?>>İade Edildi</option>
    </select>
</div>

          <div class="text-center">
            <button type="submit" class="btn btn-warning save_changes" name="save_changes">Save Changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

  <footer>
    <!-- Footer -->
    <?php include('Components\footer.php');?>
  </footer>

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

      var receiverCitySelected = '<?php echo $row['receiverCity']; ?>';
      var receiverDistrictSelected = '<?php echo $row['receiverDistrict']; ?>';
      if (receiverCitySelected) {
        $('#receiverCity').val(receiverCitySelected).trigger('change');
        setTimeout(function() {
          $('#receiverDistrict').val(receiverDistrictSelected);
        }, 500);
      }

      var senderCitySelected = '<?php echo $row['senderCity']; ?>';
      var senderDistrictSelected = '<?php echo $row['senderDistrict']; ?>';
      if (senderCitySelected) {
        $('#senderCity').val(senderCitySelected).trigger('change');
        setTimeout(function() {
          $('#senderDistrict').val(senderDistrictSelected);
        }, 500);
      }
      
      $('#receiverCity').change(function() {
        var selectedCity = $(this).val();
        var ilceler = data.find(item => item.plaka == selectedCity).ilceleri;
        $('#receiverDistrict').html('<option value="" disabled selected>İlçe Seçiniz</option>');
        $.each(ilceler, function(index, value) {
          $('#receiverDistrict').append($('<option>', {
            value: value,
            text: value
          }));
        });
      });
  
      $('#senderCity').change(function() {
        var selectedCity = $(this).val();
        var ilceler = data.find(item => item.plaka == selectedCity).ilceleri;
        $('#senderDistrict').html('<option value="" disabled selected>İlçe Seçiniz</option>');
        $.each(ilceler, function(index, value) {
          $('#senderDistrict').append($('<option>', {
            value: value,
            text: value
          }));
        });
      });

      // Alert mesajları için otomatik kapatma
      $('.alert').delay(900).fadeOut('fast');
    });
  </script>
</body>
</html>
