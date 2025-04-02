<?php

$db_config = [
    'host' => '127.0.0.1',
    'port' => '3306',
    'username' => 'root',
    'password' => 'Euqificap12.',
    'database' => 'mydb'  // Changed to new database name
];

try {
    $pdo = new PDO(
        "mysql:host={$db_config['host']};port={$db_config['port']};dbname={$db_config['database']}",
        $db_config['username'],
        $db_config['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5,
        ]
    );
    

    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>