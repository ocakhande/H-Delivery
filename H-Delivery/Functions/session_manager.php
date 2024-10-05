<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin_login.php");
    exit();
}


$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'employee';

$roles = [
    'admin' => [
        'allowed_pages' => ['dashboard.php', 'cargo_tables.php','list_contact.php', 'send_cargo.php','change_password.php','add_user.php', 'add_employer.php', 'user_list.php', 'employer_tables.php','edit_cargo.php','edit_employee.php'],
        'default_page' => 'dashboard.php'
    ],
    'employee' => [
        'allowed_pages' => ['dashboard.php', 'cargo_tables.php','list_contact.php','change_password.php', 'send_cargo.php','edit_cargo.php'],
        'default_page' => 'dashboard.php'
    ]
];

function checkPagePermission($page) {
    global $roles, $role;

    if (isset($roles[$role]) && in_array($page, $roles[$role]['allowed_pages'])) {
        return true;
    }

    return false;
}

$page = basename($_SERVER['PHP_SELF']);
if (!checkPagePermission($page)) {
    header("Location: ../error.php"); 
    exit();
}
?>
