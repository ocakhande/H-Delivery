<?php
include('Database\db.php'); 
include('Functions\session_manager.php');
$query = "SELECT * FROM employees";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Veritabanı hatası: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Çalışanlar | H-Delivery</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="il_ilce.js"></script>
  <link rel="icon" type="image/png" href="icons/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="CSS/alert.css">
</head>
<body>
  <header>
    <!-- NAVBAR -->
    <?php include('Components\user_navbar.php');?>
  </header>

  <div class="container-fluid">
    <div class="row">
      <!-- Side Navigation -->
      <?php include('Components\admin_sidenavbar.php');?>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container my-5">

       <?php if(isset($_SESSION['success'])) {
                    echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
                    unset($_SESSION['success']);
                }
                if(isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
                    unset($_SESSION['error']);
                }
                ?>

          <h2 class="text-center mb-4">Çalışanlar Tablosu</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Çalışan Adı</th>
                  <th>Çalışan E-Posta</th>
                  <th>Çalışan Telefon Numarası</th>
                  <th>Çalışan Departmanı</th>
                  <th>Çalışan Pozisyonu</th>
                  <th>İşlemler</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr data-id="' . $row['id'] . '">';
                  echo '<td>' . $row['id'] . '</td>';
                  echo '<td>' . $row['fullName'] . '</td>';
                  echo '<td>' . $row['email'] . '</td>';
                  echo '<td>' . $row['phoneNumber'] . '</td>';
                  echo '<td>' . $row['department'] . '</td>';
                  echo '<td>' . $row['position'] . '</td>';
                  echo '<td>';
                  if ($role === 'admin') {
                    echo '<a href="edit_employee.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Düzenle</a>';
                } else {
                    echo '<button class="btn btn-primary btn-sm" disabled>Düzenle</button>';
                }
                  echo '<button class="btn btn-danger btn-sm" onclick="openDeleteModal(' . $row['id'] . ')">Sil</button>';
                  echo '</td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Confirm Delete Modal -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Çalışanı Sil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Çalışanı silmek istediğinizden emin misiniz?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sil</button>
        </div>
      </div>
    </div>
  </div>


<!-- Success Message Modal -->
<div class="modal fade" id="successMessageUserModal" tabindex="-1" aria-labelledby="successMessageUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <p>Çalışan başarıyla silindi.</p>
      </div>
    </div>
  </div>
</div>


  <!-- FOOTER -->
  <?php include('Components\footer.php');?>

  <!-- Bootstrap ve diğer script dosyaları -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
var userIdToDelete;

function openDeleteModal(id) {
  userIdToDelete = id;
  $('#confirmDeleteModal').modal('show');
}
$('#confirmDeleteBtn').click(function() {
  $.ajax({
    url: 'Functions/delete_employee.php',
    type: 'POST',
    data: { id: userIdToDelete },
    success: function(response) {
      var result = JSON.parse(response);
      if (result.status === 'success') {
        $('#confirmDeleteModal').modal('hide'); 
        $('#successMessageModal').modal('show'); 
        setTimeout(function() {
          $('#successMessageModal').modal('hide'); 
          location.reload(); 
        }, 1000); 
      } else {
        alert("Çalışan silinirken bir hata oluştu: " + result.message);
      }
    },
    error: function() {
      alert("Bir hata oluştu. Lütfen tekrar deneyin.");
    }
  });
});

$(document).ready(function() {
    setTimeout(function() {
        $('.alert-success').fadeOut('fast');
    }, 800);

    setTimeout(function() {
        $('.alert-danger').fadeOut('fast');
    }, 800);
});
      </script>
</body>
</html>

<?php
mysqli_close($conn);
?>
