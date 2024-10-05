<?php
session_start();
include('../Database/db.php'); 

if (isset($_POST['id'])) {
    $userId = $_POST['id'];


    $sql = "DELETE FROM employees WHERE id = $userId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $response = array('status' => 'success');
    } else {
        $response = array('status' => 'error', 'message' => mysqli_error($conn));
    }
} else {
    $response = array('status' => 'error', 'message' => 'ID parametresi eksik');
}

echo json_encode($response);
?>

