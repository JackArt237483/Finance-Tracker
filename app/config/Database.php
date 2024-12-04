<?php

class Database {
    private $dbPath = __DIR__ . "/../../database/database.sqlite"; // Путь к базе данных

    public function connect() {
        try {
            $pdo = new PDO("sqlite:" . $this->dbPath);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }
}
