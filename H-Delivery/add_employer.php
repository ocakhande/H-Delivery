<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Çalışan Ekle | H-Delivery</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="JS\il_ilce.js"></script>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/alert.css">

  <?php
  include('Functions\session_manager.php');
  ?>
  
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
<?php include('Components\admin_sidenavbar.php');?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="container my-5">
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


            <h2 class="text-center mb-4">Çalışan Ekleme Formu</h2>
        
            <!-- Personal and Work-related Information Form -->
            <div class="row justify-content-center">
              <div class="col-lg-7">
                <div class="form-container">
                  <form id="employeeForm" action="Functions/register_employee.php" method="POST">
                    <!-- Personal Information -->
                    <div class="mb-3">
                      <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Ad-Soyad" required>
                    </div>
                    <div class="mb-3">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Mail Adresi" required>
                    </div>
                    <div class="mb-3">
                      <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Telefon Numarası" required>
                    </div>
                    <div class="mb-3">
                      <select class="form-select" id="gender" name="gender" required>
                        <option value="" disabled selected>Cinsiyet Seçiniz</option>
                        <option value="female">Kadın</option>
                        <option value="male">Erkek</option>
                        <option value="other">Belirtmek İstemiyorum</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <input type="date" class="form-control" id="birthDate" name="birthDate" placeholder="Doğum Tarihi" required>
                    </div>
                    <div class="mb-3">
                      <select class="form-select" id="city" name="city" required>
                        <option value="" disabled selected>Şehir Seçiniz</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <select class="form-select" id="district" name="district" required>
                        <option value="" disabled selected>İlçe Seçiniz</option>
                      </select>
                    </div>
        
                    <!-- Address -->
                    <div class="mb-3">
                      <textarea class="form-control" id="address" name="address" placeholder="Adres" rows="3"></textarea>
                    </div>
        
                    <!-- Work-related Information -->
                    <div class="mb-3">
                      <select class="form-select" id="department" name="department" required>
                        <option value="" disabled selected>Çalışan Departmanı Seçiniz</option>
                        <option value="IT">IT</option>
                        <option value="Operasyon">Operasyon</option>
                        <option value="Müşteri Hizmetleri">Müşteri Hizmetleri</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="position" name="position" placeholder="Çalışan Pozisyonu" required>
                    </div>
        
                    <div class="mb-3 text-center">
                      <button type="submit" class="btn btn-warning" name="register_emp_btn">Çalışanı Ekle</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        
          </div>
        </main>
        
<!--FOOTER-->
        <?php include('C:\xampp\htdocs\H-Delivery\Components\footer.php');?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


 <script>
    $(document).ready(function() {
      $.each(data, function(index, value) {
        $('#city').append($('<option>', {
          value: value.plaka,
          text: value.il
        }));
      });

      $('#city').change(function() {
        var selectedCity = $(this).val();
        var ilceler = data.find(item => item.plaka == selectedCity).ilceleri;
        $('#district').html('');
        $.each(ilceler, function(index, value) {
          $('#district').append($('<option>', {
            value: value,
            text: value
          }));
        });
      });
    });
  </script>
</body>
</html>
