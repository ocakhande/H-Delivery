<?php
include('Database/db.php'); 
include('Functions/session_manager.php');


$allowedOrders = ['created_at DESC', 'created_at ASC'];
$orderBy = isset($_GET['order']) && in_array($_GET['order'], $allowedOrders) ? $_GET['order'] : 'created_at DESC';

$sql = "SELECT * FROM contact_messages ORDER BY $orderBy";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Sorgu Hatası: ' . mysqli_error($conn));
}

mysqli_close($conn);

$contactList = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $contactList .= '<tr>';
        $contactList .= '<td>' . $row['id'] . '</td>';
        $contactList .= '<td>' . $row['name'] . '</td>';
        $contactList .= '<td>' . $row['email'] . '</td>';
        $contactList .= '<td>' . $row['phone'] . '</td>';
        $contactList .= '<td>' . $row['subject'] . '</td>';
        $contactList .= '<td>' . $row['message'] . '</td>';
        $contactList .= '<td>' . $row['created_at'] . '</td>';
        $contactList .= '<td>';
        $contactList .= '<button class="btn btn-danger btn-sm" onclick="openDeleteModal(' . $row['id'] . ')">Sil</button>';
        $contactList .= '</td>';
        $contactList .= '</tr>';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>İletişim Formu Verileri | H-Delivery</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        include('Components/admin_sidenavbar.php');
    } elseif ($role === 'employee') {
        include('Components/user_sidebar.php');
    }
    ?>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 text-center">İletişim Formu Verileri</h1>
        </div>
  
        <div class="container-fluid my-5">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Ad Soyad</th>
                      <th>E-posta</th>
                      <th>Telefon</th>
                      <th>Konu</th>
                      <th>Mesaj</th>
                      <th>
                        <div class="dropdown border-0">
                          <button class="dropdown-toggle btn btn-outline-none" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">Tarih</button>
                            <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                <li><a class="dropdown-item" href="?order=created_at DESC">Yeniden Eskiye</a></li>
                                <li><a class="dropdown-item" href="?order=created_at ASC">Eskiden Yeniye</a></li>
                            </ul>
                        </div>
                      </th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php echo $contactList; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>

      <!-- Delete Contact Modal -->
      <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteModalLabel">Mesajı Sil</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Bu mesajı silmek istediğinizden emin misiniz?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sil</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Success Message Modal -->
      <div class="modal fade" id="successMessageModal" tabindex="-1" aria-labelledby="successMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <p>Mesaj başarıyla silindi.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- FOOTER -->
      <?php include('Components/footer.php'); ?>
  
      <!-- Bootstrap ve diğer script dosyaları -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script>
        var contactIdToDelete;

        function openDeleteModal(id) {
          contactIdToDelete = id;
          $('#confirmDeleteModal').modal('show');
        }

        $('#confirmDeleteBtn').click(function() {
          $.ajax({
            url: 'Functions/delete_contact.php',
            type: 'POST',
            data: { id: contactIdToDelete },
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
                alert("Mesaj silinirken bir hata oluştu: " + result.message);
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
