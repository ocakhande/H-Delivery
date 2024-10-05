<?php
include('Database/db.php');
include('Functions/session_manager.php');

// Veritabanından verileri çekme işlemi
$sql = "SELECT COUNT(*) AS total_cargo FROM cargo_data";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_cargo = $row['total_cargo'];

$sql = "SELECT COUNT(*) AS received_cargo FROM cargo_data WHERE status = 'Gönderi Alındı'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$received_cargo = $row['received_cargo'];

$sql = "SELECT COUNT(*) AS in_transit_cargo FROM cargo_data WHERE status = 'Taşımada'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$in_transit_cargo = $row['in_transit_cargo'];

$sql = "SELECT COUNT(*) AS delivered_cargo FROM cargo_data WHERE status = 'Teslim Edildi'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$delivered_cargo = $row['delivered_cargo'];

$sql = "SELECT COUNT(*) AS returned_cargo FROM cargo_data WHERE status = 'İade Edildi'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$returned_cargo = $row['returned_cargo'];

$sql = "SELECT COUNT(*) AS total_employees FROM employees";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_employees = $row['total_employees'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | H-Delivery</title>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" href="CSS/dashboard.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
  <header>
    <!-- NAVBAR -->
    <?php include('Components/user_navbar.php'); ?>
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
          <h1 class="h2 text-center">Dashboard</h1>
        </div>

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <img src="icons\Dashboard\total.png" class="icon" alt="total-icon">
                  Toplam Kargo Sayısı
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $total_cargo; ?></h5>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <img src="icons\Dashboard\received2.png" class="icon" alt="delivered-icon">
                  Gönderi Alındı
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $received_cargo; ?></h5>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <img src="icons\Dashboard\transport.png" class="icon" alt="transit-icon">
                  Taşımada Olan Kargo
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $in_transit_cargo; ?></h5>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <img src="icons\Dashboard\delivered.png" class="icon" alt="delivered-icon">
                  Teslim Edilen Kargo
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $delivered_cargo; ?></h5>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <img src="icons\Dashboard\return.png" class="icon" alt="returned-icon">
                  İade Edilen Kargo
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $returned_cargo; ?></h5>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <img src="icons\Dashboard\staff.png" class="icon" alt="employees-icon">
                  Toplam Çalışan
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $total_employees; ?></h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <footer>
    <!-- FOOTER -->
    <?php include('Components/footer.php'); ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
