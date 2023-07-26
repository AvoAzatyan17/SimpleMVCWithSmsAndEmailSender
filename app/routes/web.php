<?php
use App\Controllers\HomeController;

$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    $controller = new HomeController();
    $controller->index();
} elseif ($action === 'addAction') {
    $controller = new HomeController();
    $controller->addAction();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
}
