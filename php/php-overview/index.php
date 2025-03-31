<?php
session_start();

// Database connection
$db_config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'users_db'
];

try {
    $pdo = new PDO(
        "mysql:host={$db_config['host']};dbname={$db_config['database']}",
        $db_config['username'],
        $db_config['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Form validation class
class FormValidator {
    private $errors = [];
    
    public function validateName($name) {
        if (empty($name)) {
            $this->errors[] = "Name is required";
        } elseif (strlen($name) < 2) {
            $this->errors[] = "Name must be at least 2 characters";
        }
        return empty($this->errors);
    }
    
    public function getErrors() {
        return $this->errors;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validator = new FormValidator();
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    
    if ($validator->validateName($name)) {
        try {
            // Insert into database
            $stmt = $pdo->prepare("INSERT INTO users (name, created_at) VALUES (?, NOW())");
            $stmt->execute([$name]);
            
            // Store in session
            $_SESSION['user_name'] = $name;
            $_SESSION['success_message'] = "Welcome, $name!";
            
        } catch(PDOException $e) {
            $_SESSION['error_message'] = "Database error: " . $e->getMessage();
        }
    } else {
        $_SESSION['error_message'] = implode(", ", $validator->getErrors());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced PHP Demo</title>
    <style>
        .error { color: red; }
        .success { color: green; }
        .form-container { margin: 20px; padding: 20px; }
    </style>
</head>
<body>
    <div class="form-container">
        <?php
        // Display messages
        if (isset($_SESSION['error_message'])) {
            echo "<p class='error'>" . htmlspecialchars($_SESSION['error_message']) . "</p>";
            unset($_SESSION['error_message']);
        }
        if (isset($_SESSION['success_message'])) {
            echo "<p class='success'>" . htmlspecialchars($_SESSION['success_message']) . "</p>";
            unset($_SESSION['success_message']);
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Enter your name" 
                   value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                   required>
            <input type="submit" value="Submit">
        </form>

        <?php if (isset($_SESSION['user_name'])): ?>
            <h3>Recent Users:</h3>
            <?php
            try {
                $stmt = $pdo->query("SELECT name, created_at FROM users ORDER BY created_at DESC LIMIT 5");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<p>" . htmlspecialchars($row['name']) . 
                         " - " . date("F j, Y, g:i a", strtotime($row['created_at'])) . "</p>";
                }
            } catch(PDOException $e) {
                echo "<p class='error'>Error retrieving users</p>";
            }
            ?>
        <?php endif; ?>
    </div>
</body>
</html>