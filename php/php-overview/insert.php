<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate inputs
        $name = htmlspecialchars($_POST['name']);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);

        if (empty($name) || empty($email) || empty($age)) {
            throw new Exception('All fields are required');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format');
        }

        if ($age < 1 || $age > 150) {
            throw new Exception('Invalid age');
        }

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO students (name, email, age) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $age]);

        echo 'success';
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo 'Email already exists!';
        } else {
            echo 'Database error: ' . $e->getMessage();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    header('Location: index.html');
    exit;
}