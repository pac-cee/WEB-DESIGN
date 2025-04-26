<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database.php';

// Debug: Check if database connection is successful
if(isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Validate the input
    // Enhanced validation
    if(empty($first_name) || empty($last_name) || empty($address) || empty($telephone) || empty($username) || empty($password)) {
        echo "<p style='color:red;'>All fields are required.</p>";
    } elseif(!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
        echo "<p style='color:red;'>First Name: Only letters, hyphens, apostrophes, and spaces allowed.</p>";
    } elseif(!preg_match("/^[a-zA-Z-' ]*$/", $last_name)) {
        echo "<p style='color:red;'>Last Name: Only letters, hyphens, apostrophes, and spaces allowed.</p>";
    } elseif(!preg_match("/^[0-9]{7,15}$/", $telephone)) {
        echo "<p style='color:red;'>telephone: Only numbers allowed (7-15 digits).</p>";
    } elseif(!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Username must be a valid email address.</p>";
    } elseif(strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[^a-zA-Z0-9]/", $password)) {
        echo "<p style='color:red;'>Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.</p>";
    } else {
        // First check if username already exists
        $check_username = "SELECT * FROM Credentials WHERE username = ?";
        $check_stmt = mysqli_stmt_init($conn);
        
        if(!$check_stmt) {
            echo "<p style='color:red;'>Failed to initialize statement: " . mysqli_error($conn) . "</p>";
        } else {
            mysqli_stmt_prepare($check_stmt, $check_username);
            mysqli_stmt_bind_param($check_stmt, "s", $username);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);
            
            if(mysqli_stmt_num_rows($check_stmt) > 0) {
                echo "<div class='alert alert-danger' style='color:red; font-weight:bold; padding:10px; background-color:#f8d7da; border:1px solid red;'>Username already exists. Please choose a different username.</div>";
            } else {
                // Now attempt to insert the data
                $sql = "INSERT INTO Credentials (first_name, last_name, address, telephone, username, password) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                
                if(!$stmt) {
                    echo "<p style='color:red;'>Failed to initialize statement: " . mysqli_error($conn) . "</p>";
                } else {
                    $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                    
                    if($preparestmt) {
                        mysqli_stmt_bind_param($stmt, "ssssss", $first_name, $last_name, $address, $telephone, $username, $hash_password);
                        
                        if(mysqli_stmt_execute($stmt)) {
                            echo "<div class='alert alert-success' style='color:green; font-weight:bold; padding:15px; background-color:#e7f3e7; border:1px solid green; margin:20px auto; text-align:center; max-width:400px; border-radius:5px;'>
                                    Successfully registered! You are good to go.
                                  </div>";
                        } else {
                            echo "<p style='color:red;'>Registration failed: " . mysqli_stmt_error($stmt) . "</p>";
                        }
                        
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "<p style='color:red;'>Prepare failed: " . mysqli_error($conn) . "</p>";
                    }
                }
            }
            
            mysqli_stmt_close($check_stmt);
        }
        
        mysqli_close($conn);
    }
}else if (isset($_POST['Login'])) {
    // Print raw POST data for debugging
    echo "<p>Login attempt - POST data received:</p>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    // Trim whitespace from inputs
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    echo "<p>Attempting login with username: <strong>" . htmlspecialchars($username) . "</strong></p>";
    
    if (empty($username) || empty($password)) {
        echo "<p style='color:red;'>All fields are required.</p>";
        return;
    }

    // Debug: Check if user exists with this username
    $debug_sql = "SELECT username FROM Credentials WHERE username = ?";
    $debug_stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($debug_stmt, $debug_sql)) {
        mysqli_stmt_bind_param($debug_stmt, "s", $username);
        mysqli_stmt_execute($debug_stmt);
        mysqli_stmt_store_result($debug_stmt);
        echo "<p>Users found with this username: " . mysqli_stmt_num_rows($debug_stmt) . "</p>";
        mysqli_stmt_close($debug_stmt);
    }

    // SQL to select user by username
    $sql = "SELECT * FROM Credentials WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!$stmt) {
        echo "<p style='color:red;'>Failed to initialize statement: " . mysqli_error($conn) . "</p>";
    } else {
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                echo "<p>User found! Checking password...</p>";
                echo "<p>Database columns available: " . implode(", ", array_keys($row)) . "</p>";
                
                // Check if password column exists
                if (!isset($row['password'])) {
                    echo "<p style='color:red;'>ERROR: No 'password' column found in database result!</p>";
                    echo "<p>Available columns: " . implode(", ", array_keys($row)) . "</p>";
                } else {
                    // Show just first few characters of the hash (for security)
                    $hash_preview = substr($row['password'], 0, 10) . "...";
                    echo "<p>password hash in database (start): " . $hash_preview . "</p>";
                    
                    // Verify password
                    if (password_verify($password, $row['password'])) {
                        echo "<div class='alert alert-success' style='color:green;'>Login successful!</div>";
                        
                        // Start session and redirect
                        session_start();
                        $_SESSION['id'] = $row['id']; 
                        $_SESSION['first_name'] = $row['first_name'];
                        $_SESSION['last_name'] = $row['last_name'];
                        $_SESSION['phone'] = $row['telephone'];
                        $_SESSION['address'] = $row['address'];
                        $_SESSION['username'] = $row['username'];
                        
                        // Redirect to home page
                        header("Location: HomePage.php");
                        exit();
                    } else {
                        echo "<p style='color:red;'>password verification failed.</p>";
                        
                        // Check if hash is actually bcrypt
                        if (strpos($row['password'], '$2y$') !== 0) {
                            echo "<p style='color:red;'>WARNING: password hash in database is not in bcrypt format!</p>";
                        }
                    }
                }
            } else {
                echo "<p style='color:red;'>Username not found.</p>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<p style='color:red;'>Prepare failed: " . mysqli_error($conn) . "</p>";
        }
    }

    mysqli_close($conn);
}


if (isset($_POST['cancle'])) {

}
?>