<?php

namespace config;

use PDO;
use PDOException;

$host = 'localhost';
$username = 'root';
$password = '123456';
$dbname = 'message_sender';

try {
    $GLOBALS["db"] = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $GLOBALS["db"]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
