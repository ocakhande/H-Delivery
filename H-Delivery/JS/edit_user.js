$(document).ready(function() {
    // Kullanıcı güncelleme form submit işlemi
    $("#editUserForm").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'Functions/edit_user.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          var result = JSON.parse(response);
          if (result.status === "success") {
            $('#editUserModal').modal('hide'); // Modalı kapat
            $('#successMessageUserModal').modal('show'); // Başarı mesajı modalını göster
            setTimeout(function() {
              $('#successMessageUserModal').modal('hide'); // 3 saniye sonra başarı mesajı modalını kapat
              location.reload(); // Sayfayı yeniden yükle
            }, 2000);
          } else {
            alert("Kullanıcı güncellenirken bir hata oluştu: " + result.message);
          }
        },
        error: function() {
          alert("Bir hata oluştu. Lütfen tekrar deneyin.");
        }
      });
    });
  });
  