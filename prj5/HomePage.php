<?php
// Start the session
session_start();

// Check if user is logged in
if(!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Account Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(120deg, #e0eafc, #cfdef3);
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 420px;
            margin: 60px auto 0 auto;
            padding: 36px 32px 28px 32px;
            border-radius: 16px;
            box-shadow: 0 6px 32px rgba(0,0,0,0.10);
            text-align: center;
        }
        h1 {
            color: #3b82f6;
            font-size: 2.2rem;
            margin-bottom: 8px;
        }
        .welcome {
            color: #222;
            font-size: 1.1rem;
            margin-bottom: 24px;
        }
        .credentials {
            background: #f6f8fa;
            border-radius: 10px;
            padding: 18px 0 10px 0;
            margin-bottom: 18px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        }
        .credentials ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .credentials li {
            padding: 7px 0;
            border-bottom: 1px solid #e5e7eb;
            font-size: 1rem;
        }
        .credentials li:last-child {
            border-bottom: none;
        }
        label {
            font-weight: 700;
            color: #374151;
            margin-right: 8px;
        }
        .logout {
            margin-top: 16px;
        }
        .logout a {
            background: linear-gradient(90deg, #f43f5e, #f59e42);
            color: #fff;
            padding: 10px 32px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: 1px;
            box-shadow: 0 2px 8px rgba(244,63,94,0.08);
            transition: background 0.2s;
        }
        .logout a:hover {
            background: linear-gradient(90deg, #f43f5e, #f59e42 80%);
            opacity: 0.92;
        }
        @media (max-width: 480px) {
            .container { padding: 18px 4vw 14px 4vw; }
            h1 { font-size: 1.3rem; }
            .credentials li { font-size: 0.98rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Home Page</h1>
        <p>Hello, <strong><?php echo htmlspecialchars($_SESSION['first_name']); ?></strong>! Here are your credentials:</p>
        <ul>
            <li><label>First Name:</label> <?php echo htmlspecialchars($_SESSION['first_name'] ?? ''); ?></li>
            <li><label>Last Name:</label> <?php echo htmlspecialchars($_SESSION['last_name'] ?? ''); ?></li>
            <li><label>Phone:</label> <?php echo htmlspecialchars($_SESSION['phone'] ?? ''); ?></li>
            <li><label>Address:</label> <?php echo htmlspecialchars($_SESSION['address'] ?? ''); ?></li>
            <li><label>Username:</label> <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></li>
        </ul>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>