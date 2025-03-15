<?php

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            $this->connection = new SQLite3(__DIR__ . '/../../database/users.sqlite');
            $this->createTables();
        } catch (Exception $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    private function createTables() {
        $query = "CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        
        $this->connection->exec($query);
    }

    public function __destruct() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
