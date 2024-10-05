<?php
include('Database/db.php'); 
include('Functions\session_manager.php');

$sql = "SELECT users.id, users.email, roles.role_name
        FROM users
        INNER JOIN roles ON users.role_id = roles.id";
$result = mysqli_query($conn, $sql);

$userList = '';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $userList .= '<tr>';
        $userList .= '<td>' . $row['email'] . '</td>'; 
        $userList .= '<td>' . $row['role_name'] . '</td>'; 
        $userList .= '<td>';
        $userList .= '<button class="btn btn-primary btn-sm editUserBtn" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="' . $row['id'] . '">Edit</button>';
        $userList .= '<button class="btn btn-danger btn-sm" onclick="openDeleteUserModal(' . $row['id'] . ')">Delete</button>';
        $userList .= '</td>';
        $userList .= '</tr>';
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kullanıcılar Listesi | H-Delivery</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="il_ilce.js"></script>
  <script src="JS\edit_user.js"></script>
  <script src="JS\delete_user.js"></script>
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
      <?php include('Components/admin_sidenavbar.php'); ?>
      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 text-center">Kullanıcılar Listesi</h1>
        </div>
  
        <div class="container my-5">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Rol</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php echo $userList; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Kullanıcıyı Düzenle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editUserForm">
          <input type="hidden" id="editUserId" name="id">
          <div class="mb-3">
            <label for="editEmail" class="form-label">E-posta Adresi</label>
            <input type="email" class="form-control" id="editEmail" name="email">
          </div>
          <div class="mb-3">
            <label for="editRole" class="form-label">Rol</label>
            <select class="form-select" id="editRole" name="role">
              <option value="admin">Admin</option>
              <option value="employee">Çalışan</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
      </div>
    </div>
  </div>
</div>


     
      <!-- Delete User Modal -->
      <div class="modal fade" id="confirmDeleteUserModal" tabindex="-1" aria-labelledby="confirmDeleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteUserModalLabel">Kullanıcıyı Sil</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Bu kullanıcıyı silmek istediğinizden emin misiniz?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="confirmDeleteUserBtn">Sil</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
            </div>
          </div>
        </div>
      </div>
            <!-- FOOTER -->
            <?php include('Components/footer.php'); ?>
  

      <!-- Bootstrap ve diğer script dosyaları -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script>
        var userIdToDelete;
        function openDeleteUserModal(id) {
          userIdToDelete = id;
          $('#confirmDeleteUserModal').modal('show');
        }

        $('#confirmDeleteUserBtn').click(function() {
          $.ajax({
            url: 'Functions/delete_user.php',
            type: 'POST',
            data: { id: userIdToDelete },
            success: function(response) {
              var result = JSON.parse(response);
              if (result.status === 'success') {
                $('#confirmDeleteUserModal').modal('hide');
                $('#successMessageUserModal').modal('show'); 
                setTimeout(function() {
                  $('#successMessageUserModal').modal('hide');
                  location.reload();
                }, 2000);
              } else {
                alert("Kullanıcı silinirken bir hata oluştu: " + result.message);
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
