<?php
header('Content-Type: application/json');
require_once '../config/database.php';

try {
    $stmt = $conn->prepare("
        SELECT * FROM books 
        WHERE stock_quantity > 0 
        ORDER BY stock_quantity DESC 
        LIMIT 10
    ");
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['status' => 'success', 'data' => $books]);
} catch(PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}