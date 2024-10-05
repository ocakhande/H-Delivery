<?php
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_phone_number($phone) {
    return preg_match('/^0\d{3} \d{3} \d{4}$/', $phone) || preg_match('/^0\d{10}$/', $phone);
}

function sanitize_all_inputs($input_array) {
    $sanitized_array = [];
    foreach ($input_array as $key => $value) {
        $sanitized_array[$key] = sanitize_input($value);
    }
    return $sanitized_array;
}

function is_valid_name($name) {
    return preg_match('/^[a-zA-ZğüşıöçĞÜŞİÖÇ\s]+$/', $name);
}

function validate_password($password) {
    // Şifre en az 8 karakter olmalı, bir büyük harf, bir küçük harf ve bir özel karakter içermeli
    $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    return preg_match($pattern, $password);
}
?>
