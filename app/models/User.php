<?php
require_once __DIR__ . '/../config/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
        
        return $stmt->execute();
    }

    public function findByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();
        
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function getAll() {
        $query = "SELECT id, name, email, created_at FROM users";
        $result = $this->db->query($query);
        
        $users = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $users[] = $row;
        }
        return $users;
    }

    public function update($id, $data) {
        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':name', $data['name'], SQLITE3_TEXT);
        $stmt->bindValue(':email', $data['email'], SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        
        return $stmt->execute();
    }
}
