<?php
/**
 * MYSQL DATABASE CONNECTION
 * - Uses PDO for secure connections
 * - Prepared statements
 */

class MySQLConnection {
    private PDO $pdo;

    public function __construct() {
        $host = 'localhost';
        $db   = 'mydb';
        $user = 'root';
        $pass = 'secure_password';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            die("MySQL Connection Failed: " . $e->getMessage());
        }
    }

    public function getData(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE active = :active");
        $stmt->execute(['active' => 1]);
        return $stmt->fetchAll();
    }
}