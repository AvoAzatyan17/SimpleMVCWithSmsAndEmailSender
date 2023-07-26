<?php

require_once 'config/database.php';
$sql = "CREATE TABLE messages (id INT(11) AUTO_INCREMENT PRIMARY KEY,text VARCHAR(255) NOT NULL,email VARCHAR(255) NOT NULL,phone VARCHAR(20) NOT NULL);";
$GLOBALS["db"]->exec($sql);