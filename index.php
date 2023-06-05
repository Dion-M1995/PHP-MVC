<?php

require_once 'Models/DataModel.php';
require_once 'Controllers/DataController.php';


$model = new DataModel();
$controller = new DataController($model);
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfToken = $_POST['csrf_token'] ?? '';

    if (!hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        die('CSRF token validation failed.');
    }
    $controller->handleRequest($_POST['data']);
} else {
    include 'View/AddDataView.php';
}
?>