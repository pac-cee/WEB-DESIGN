<?php
// Authentication logic for Eventify
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/roles.php';
session_start();

function login($email, $password) {
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT id, name, email, password_hash, role FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $name, $email, $hash, $role);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_role'] = $role;
            return true;
        }
    }
    return false;
}

function logout() {
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit();
}

// Handle logout via GET
if (isset($_GET['logout'])) {
    logout();
}


function require_role($role) {
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== $role) {
        header('Location: /index.php');
        exit();
    }
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function get_user_role() {
    return $_SESSION['user_role'] ?? null;
}
