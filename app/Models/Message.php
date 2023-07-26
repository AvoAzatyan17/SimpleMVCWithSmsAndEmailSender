<?php

namespace App\Models;

use PDO;
use PDOException;

class Message
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllMessages(): bool|array
    {
        $stmt = $this->db->query("SELECT * FROM messages");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createMessage($text, $phone, $email): bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO messages (text, phone, email) VALUES (:text, :phone, :email);");
            $stmt->bindParam(':text', $text, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return "Message inserted successfully.";
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}