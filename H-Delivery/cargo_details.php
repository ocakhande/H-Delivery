<?php
session_start();
include('Database/db.php');

// Session'daki kargo bilgilerini alın
if (isset($_SESSION['cargo_details'])) {
    $cargoDetails = $_SESSION['cargo_details'];
    $status = $cargoDetails['status'];
    $statusHistory = json_decode($cargoDetails['status_history'], true);
    
    // Gizli bilgileri kısmen maskeleme
    function maskString($string) {
        $length = strlen($string);
        $visibleChars = 3;
        if ($length > $visibleChars) {
            return substr($string, 0, $visibleChars) . str_repeat('*', $length - $visibleChars);
        }
        return $string;
    }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kargo Detayları | H-Delivery</title>
    <link rel="icon" type="image/png" href="icons/favicon.png">
    <link rel="stylesheet" href="CSS/cargo_details.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header>
        <!-- NAVBAR -->
        <?php include('Components/navbar.php'); ?>
    </header>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card mt-5">
                        <div class="card-header text-center">
                            <h3>Kargo Detayları</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3 tracking-number-card">
                                    <div class="card">
                                        <div class="card-body a">
                                            <h5 class="card-title">Kargo Takip Kodu</h5>
                                            <p class="card-text"><?php echo $cargoDetails['tracking_number']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body a">
                                            <h5 class="card-title">Gönderici Adı</h5>
                                            <p class="card-text"><?php echo maskString($cargoDetails['senderFullName']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body a">
                                            <h5 class="card-title">Alıcı Adı</h5>
                                            <p class="card-text"><?php echo maskString($cargoDetails['receiverFullName']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body a">
                                            <h5 class="card-title">Gönderici Adresi</h5>
                                            <p class="card-text"><?php echo maskString($cargoDetails['senderAddress']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body a">
                                            <h5 class="card-title">Alıcı Adresi</h5>
                                            <p class="card-text"><?php echo maskString($cargoDetails['receiverAddress']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body a">
                                            <h5 class="card-title">Kargo Ağırlığı</h5>
                                            <p class="card-text"><?php echo $cargoDetails['weight']; ?> desi</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body a">
                                            <h5 class="card-title">Ödeme Türü</h5>
                                            <p class="card-text"><?php echo $cargoDetails['paymentType']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body a">
                                            <h5 class="card-title">Oluşturulma Tarihi</h5>
                                            <p class="card-text"><?php echo $cargoDetails['created_at']; ?></p>
                                        </div>
                                    </div>
                                </div>                      
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body a">
                                            <h5 class="card-title">Güncel Durum</h5>
                                            <p class="card-text status-link" id="current-status"><?php echo $status; ?> - <span>Daha Fazla Bilgi</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="status-history" style="display: none;">
                                <h6 class="card-subtitle mb-2 text-muted mt-4">Durum Geçmişi:</h6>
                                <ul class="list-group">
                                    <?php
                                    // Durum geçmişini gösterme
                                    if (!empty($statusHistory)) {
                                        foreach ($statusHistory as $change) {
                                            $status = $change['status'];
                                            $updatedAt = $change['updated_at'];
                                            echo "<li class='list-group-item status-history-item'>Durum '$status' olarak '$updatedAt' tarihinde güncellendi</li>";
                                        }
                                    } else {
                                        echo "<li class='list-group-item status-history-item'>Durum geçmişi bulunamadı.</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- FOOTER -->
        <?php include('Components/footer.php'); ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('current-status').addEventListener('click', function() {
            var statusHistory = document.getElementById('status-history');
            if (statusHistory.style.display === 'none') {
                statusHistory.style.display = 'block';
            } else {
                statusHistory.style.display = 'none';
            }
        });
    </script>
</body>
</html>
<?php
} else {
    echo "Kargo bilgilerine ulaşılamadı.";
}
?>
