<?php


require_once __DIR__ . '/../functions.php';

// Redirect if already logged in
if (isAdminLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

header('Location: login.php')


?>