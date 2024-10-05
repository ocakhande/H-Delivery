<?php
include('Database/db.php');
include('Functions/session_manager.php');


$employeeID = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($employeeID)) {
    $_SESSION['error'] = 'Geçersiz işlem. Lütfen tekrar deneyin.';
    header('Location: ../employee_tables.php');
    exit; 
}

$query = "SELECT * FROM employees WHERE id = '$employeeID'";
$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    $row = mysqli_fetch_assoc($query_run);
} else {
    $_SESSION['error'] = 'Çalışan bilgileri getirilirken bir hata oluştu.';
    header('Location: ../employer_tables.php');
    exit; 
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Çalışan Düzenle | H-Delivery</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="JS/il_ilce.js"></script>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/add_employer.css">
</head>
<body>
  <header>
    <?php include('Components/user_navbar.php'); ?>
  </header>

  <div class="container-fluid">
    <div class="row">
      <!-- Side Navigation -->
      <?php include('Components/admin_sidenavbar.php'); ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container my-5">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-6">

              </div>
            </div>
          </div>

          <h2 class="text-center mb-4">Çalışanı Düzenle</h2>
        
          <!-- Personal and Work-related Information Form -->
          <div class="row justify-content-center">
            <div class="col-lg-7">
              <div class="form-container">
                <form id="employeeForm" action="Functions/update_employee.php" method="POST">
                  <!-- Personal Information -->
                  <div class="mb-3">
                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Ad-Soyad" value="<?php echo $row['fullName']; ?>" required>
                  </div>
                  <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Mail Adresi" value="<?php echo $row['email']; ?>" required>
                  </div>
                  <div class="mb-3">
                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Telefon Numarası" value="<?php echo $row['phoneNumber']; ?>" required>
                  </div>
                  <div class="mb-3">
                    <select class="form-select" id="gender" name="gender" required>
                      <option value="" disabled selected>Cinsiyet Seçiniz</option>
                      <option value="female" <?php if($row['gender'] == 'female') echo 'selected'; ?>>Kadın</option>
                      <option value="male" <?php if($row['gender'] == 'male') echo 'selected'; ?>>Erkek</option>
                      <option value="other" <?php if($row['gender'] == 'other') echo 'selected'; ?>>Belirtmek İstemiyorum</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <input type="date" class="form-control" id="birthDate" name="birthDate" value="<?php echo $row['birthDate']; ?>" required>
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
                    <textarea class="form-control" id="address" name="address" placeholder="Adres" rows="3" required><?php echo $row['address']; ?></textarea>
                  </div>
        
                  <!-- Work-related Information -->
                  <div class="mb-3">
                    <select class="form-select" id="department" name="department" required>
                      <option value="" disabled selected>Çalışan Departmanı Seçiniz</option>
                      <option value="IT" <?php if($row['department'] == 'IT') echo 'selected'; ?>>IT</option>
                      <option value="Operasyon" <?php if($row['department'] == 'Operasyon') echo 'selected'; ?>>Operasyon</option>
                      <option value="Müşteri Hizmetleri" <?php if($row['department'] == 'Müşteri Hizmetleri') echo 'selected'; ?>>Müşteri Hizmetleri</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" id="position" name="position" placeholder="Çalışan Pozisyonu" value="<?php echo $row['position']; ?>" required>
                  </div>
        
                  <div class="mb-3 text-center">
                    <input type="hidden" name="employeeID" value="<?php echo $_GET['id']; ?>">
                    <button type="submit" class="btn btn-warning" name="edit_emp_btn">Bilgileri Güncelle</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        
        </div>
      </main>
        
      <!-- Footer -->
      <?php include('Components/footer.php'); ?>

    </div>
  </div>

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
