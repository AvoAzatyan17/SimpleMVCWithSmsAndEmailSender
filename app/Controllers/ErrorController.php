<?php

namespace App\Controllers;

class ErrorController {
    public function notFoundAction() {
        require 'views/error.php';
    }
}