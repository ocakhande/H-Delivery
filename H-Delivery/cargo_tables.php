<?php
include('Database/db.php'); 
include('Functions\session_manager.php');

$allowedOrders = ['created_at DESC', 'created_at ASC']; //Artan azalan sıralama
$orderBy = isset($_GET['order']) && in_array($_GET['order'], $allowedOrders) ? $_GET['order'] : 'created_at DESC';

// Veritabanından kargoların sorgusu
$sql = "SELECT * FROM cargo_data ORDER BY $orderBy";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

$cargoList = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cargoList .= '<tr>';
        $cargoList .= '<td>' . $row['id'] . '</td>';
        $cargoList .= '<td>' . $row['tracking_number'] . '</td>';
        $cargoList .= '<td>' . $row['receiverFullName'] . '</td>';
        $cargoList .= '<td>' . $row['senderFullName'] . '</td>';
        $cargoList .= '<td>' . $row['type'] . '</td>';
        $cargoList .= '<td>' . $row['weight'] . '</td>';
        $cargoList .= '<td>' . $row['paymentType'] . '</td>';
        $cargoList .= '<td>' . $row['price'] . '</td>';
        $cargoList .= '<td>' . $row['status'] . '</td>';
        $cargoList .= '<td>' . $row['created_at'] . '</td>';
        $cargoList .= '<td>';
        $cargoList .= '<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' . $row['id'] . '" data-status="' . $row['status'] . '">Edit Status</button>';
        $cargoList .= '<a href="edit_cargo.php?id=' . $row['id'] . '" class="btn btn-info btn-sm">Edit</a>';
        $cargoList .= '<button class="btn btn-danger btn-sm" onclick="openDeleteModal(' . $row['id'] . ')">Sil</button>';
        $cargoList .= '</td>';
        $cargoList .= '</tr>';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gönderilen Kargolar | H-Delivery</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="il_ilce.js"></script>
  <script src="JS\edit_status.js"></script>
  <script src="JS\delete_cargo.js"></script>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/admin.css">
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

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 text-center">Gönderilen Kargolar</h1>
        </div>
  
        <div class="container-fluid my-5">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Takip Kodu</th>
                      <th>Alıcı Adı</th>
                      <th>Gönderici Adı</th>
                      <th>Kargo Türü</th>
                      <th>Ağırlık (kg)</th>
                      <th>Ödeme Türü</th>
                      <th>Kargo Ücreti (TL)</th>
                      <th>Status</th>
                      <th>
                        <div class="dropdown border-0">
                          <button class="dropdown-toggle btn btn-outline-none" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">Tarih</button>
                            <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                <li><a class="dropdown-item" href="?order=created_at DESC">Yeniden Eskiye</a></li>
                                <li><a class="dropdown-item" href="?order=created_at ASC">Eskiden Yeniye</a></li>
                            </ul>
                        </div></th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php echo $cargoList; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>
      
<!--Delete Cargo Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteModalLabel">Kargoyu Sil</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Bu kargoyu silmek istediğinizden emin misiniz?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sil</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="successMessageModal" tabindex="-1" aria-labelledby="successMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal başlık kısmı -->
      <!-- <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->

      <!-- Modal içerik kısmı -->
      <div class="modal-body">
        <p>Kargo başarıyla silindi.</p>
      </div>
    </div>
  </div>
</div>




<!-- Edit Status Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Durum Bilgisi Güncelleme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" action="Functions/edit_status.php">
                    <input type="hidden" id="cargoId" name="cargoId">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="Gönderi alındı">Gönderi alındı</option>
                            <option value="Taşımada">Taşımada</option>
                            <option value="Teslim Edildi">Teslim Edildi</option>
                            <option value="İade Edildi">İade Edildi</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

      <!-- FOOTER -->
      <?php include('Components/footer.php'); ?>
  
      <!-- Bootstrap ve diğer script dosyaları -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script>
        // Silme işlemi için kargo ID'sini tutacak değişken
        var cargoIdToDelete;

        function openDeleteModal(id) {
          cargoIdToDelete = id;
          $('#confirmDeleteModal').modal('show');
        }

        // Silme işlemi gerçekleştirilir
        $('#confirmDeleteBtn').click(function() {
          $.ajax({
            url: 'Functions/delete_cargo.php',
            type: 'POST',
            data: { id: cargoIdToDelete },
            success: function(response) {
              var result = JSON.parse(response);
              if (result.status === 'success') {
                $('#confirmDeleteModal').modal('hide'); 
                $('#successMessageModal').modal('show');
                setTimeout(function() {
                  $('#successMessageModal').modal('hide'); 
                  location.reload();
                }, 2000);
              } else {
                alert("Kargo silinirken bir hata oluştu: " + result.message);
              }
            },
            error: function() {
              alert("Bir hata oluştu. Lütfen tekrar deneyin.");
            }
          });
        });
      </script>
    </body>
</html>