<?php
include('../Database/db.php'); 

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];


    $sql = "SELECT users.id, users.email, users.role_id, roles.role_name
            FROM users
            INNER JOIN roles ON users.role_id = roles.id
            WHERE users.id = $userId";
    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        $sqlRoles = "SELECT id, role_name FROM roles";
        $resultRoles = mysqli_query($conn, $sqlRoles);
        $roles = [];
        while ($row = mysqli_fetch_assoc($resultRoles)) {
            $row['selected'] = ($row['id'] == $user['role_id']) ? true : false; 
            $roles[] = $row;
        }

        $response = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'roles' => $roles
        ];
        echo json_encode($response);
    } else {
        $response = ['error' => 'Veritabanı sorgusu başarısız.'];
        echo json_encode($response);
    }
} else {
    $response = ['error' => 'Kullanıcı ID bilgisi alınamadı.'];
    echo json_encode($response);
}

mysqli_close($conn);
?>
