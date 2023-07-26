<?php

namespace App\Controllers;

use App\Models\Message;
use App\Service\SendEmailService;
use App\Service\SendSmsService;

session_start();

class HomeController
{
    private Message $model;

    public function __construct()
    {
        $this->model = new Message($GLOBALS["db"]);
    }

    public function index(): void
    {
        $messages = $this->model->getAllMessages();
        include 'views/list.php';
    }

    public function addAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])) {
                if ($_POST['csrf_token'] === $_SESSION['csrf_token']) {
                    $text = $_POST['text'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    if (empty($text)) {
                        die("Text are required.");
                    }
                    if ($this->model->createMessage($text, $phone, $email)) {
                        echo "Message created successfully.";
                        header("Location: index.php");
                        exit();
                    }
                    unset($_SESSION['csrf_token']);
                } else {
                    die("CSRF token validation failed.");
                }
                $emailSent = SendEmailService::sendEmail($email, 'Contact Form Submission', $text);
                $smsSent = SendSmsService::sendSms($phone, $text);
                if ($smsSent && $emailSent) {
                    echo "Message sent successfully via SMS and Email.";
                } else {
                    echo "Failed to send message.";
                }
            } else {
                die("CSRF token missing.");
            }
            header("Location: index.php");
            exit();
        }
    }
}