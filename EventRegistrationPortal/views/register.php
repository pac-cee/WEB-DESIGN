<?php
require_once __DIR__ . '/../controllers/auth.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'attendee';
    $msg = '';
    if ($name && $email && $password && in_array($role, [ROLE_ORGANIZER, ROLE_ATTENDEE])) {
        $db = new Database();
        $conn = $db->getConnection();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hash, $role);
        if ($stmt->execute()) {
            $msg = "<span style='color:green'><i class='fas fa-check-circle'></i> Registration successful! Please <a href='../views/login.php'>login</a>.</span>";
        } else {
            $msg = "<span style='color:red'><i class='fas fa-exclamation-circle'></i> Registration failed: " . htmlspecialchars($stmt->error) . "</span>";
        }
        $stmt->close();
    } else {
        $msg = "<span style='color:red'><i class='fas fa-exclamation-circle'></i> Please fill all fields correctly.</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Eventify</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <style>
body {
  min-height: 100vh;
  background: linear-gradient(135deg, #e0e7ff 0%, #f4f8ff 100%);
  display: flex;
  align-items: center;
  justify-content: center;
}
.register-glass {
  max-width: 440px;
  margin: 3.5em auto;
  background: rgba(255,255,255,0.75);
  border-radius: 22px;
  box-shadow: 0 8px 40px #4f8cff22, 0 1.5px 8px #eebbc322;
  padding: 2.5em 2em 2em 2em;
  position: relative;
  backdrop-filter: blur(12px) saturate(160%);
  animation: fadeInUp 0.7s cubic-bezier(.65,.05,.36,1);
}
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(60px); }
  to { opacity: 1; transform: translateY(0); }
}
.register-glass h1 {
  text-align: center;
  color: #4f8cff;
  font-size: 2.2em;
  font-weight: 700;
  margin-bottom: 1.5em;
  letter-spacing: 1px;
}
.register-glass form {
  display: flex;
  flex-direction: column;
  gap: 1.3em;
}
.form-group {
  position: relative;
  margin-bottom: 0.2em;
}
.form-group input, .form-group select {
  width: 100%;
  padding: 1.1em 1em 1.1em 2.7em;
  border: 1.5px solid #d1d5db;
  border-radius: 10px;
  font-size: 1.08em;
  background: rgba(255,255,255,0.93);
  color: #232946;
  outline: none;
  transition: border 0.22s, box-shadow 0.22s;
  box-shadow: 0 2px 8px #4f8cff0a;
}
.form-group input:focus, .form-group select:focus {
  border: 1.5px solid #4f8cff;
  box-shadow: 0 4px 16px #4f8cff18;
}
.form-group label {
  position: absolute;
  left: 2.7em;
  top: 1.13em;
  font-size: 1em;
  color: #888;
  pointer-events: none;
  transition: 0.2s;
  background: transparent;
}
.form-group input:focus + label,
.form-group input:not(:placeholder-shown) + label,
.form-group select:focus + label,
.form-group select:not([value=""]) + label {
  top: -0.85em;
  left: 1.2em;
  font-size: 0.92em;
  color: #4f8cff;
  background: #fff;
  padding: 0 0.3em;
  border-radius: 6px;
}
.form-group .input-icon {
  position: absolute;
  left: 0.9em;
  top: 1.15em;
  color: #4f8cff;
  font-size: 1.13em;
  pointer-events: none;
  opacity: 0.85;
}
.form-group select {
  padding-left: 2.7em;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url('data:image/svg+xml;utf8,<svg fill="%234f8cff" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
  background-repeat: no-repeat;
  background-position: right 1em center;
  background-size: 1.2em;
}
.register-glass button[type="submit"] {
  background: linear-gradient(90deg, #4f8cff 0%, #6cb8ff 100%);
  color: #fff;
  font-weight: 700;
  font-size: 1.13em;
  padding: 1em 0;
  border: none;
  border-radius: 10px;
  margin-top: 0.5em;
  box-shadow: 0 2px 16px #4f8cff22;
  cursor: pointer;
  transition: background 0.18s, box-shadow 0.18s, transform 0.18s;
}
.register-glass button[type="submit"]:hover, .register-glass button[type="submit"]:focus {
  background: linear-gradient(90deg, #6cb8ff 0%, #4f8cff 100%);
  box-shadow: 0 6px 32px #4f8cff33;
  transform: translateY(-2px) scale(1.03);
}
.register-glass .register-footer {
  margin-top: 1.7em;
  text-align: center;
  font-size: 1.04em;
  color: #232946b0;
}
.register-glass .register-footer a {
  color: #7c3aed;
  text-decoration: underline;
  font-weight: 600;
  transition: color 0.18s;
}
.register-glass .register-footer a:hover {
  color: #4f8cff;
}
@media (max-width: 600px) {
  .register-glass {
    padding: 1.2em 0.4em 1.3em 0.4em;
    max-width: 98vw;
  }
}
</style>
<main class="register-glass">
    <h1>Register</h1>
    <?php if (!empty($msg)) echo '<div style="margin-bottom:1em">'.$msg.'</div>'; ?>
    <form method="post" autocomplete="off">
        <div class="form-group">
            <span class="input-icon"><i class="fas fa-user"></i></span>
            <input type="text" name="name" id="name" required placeholder=" ">
            <label for="name">Name</label>
        </div>
        <div class="form-group">
            <span class="input-icon"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email" id="email" required placeholder=" ">
            <label for="email">Email</label>
        </div>
        <div class="form-group">
            <span class="input-icon"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" id="password" required placeholder=" ">
            <label for="password">Password</label>
        </div>
        <div class="form-group">
            <span class="input-icon"><i class="fas fa-user-tag"></i></span>
            <select name="role" id="role" required>
                <option value="" disabled selected hidden>Select Role</option>
                <option value="organizer">Organizer</option>
                <option value="attendee">Attendee</option>
            </select>
            <label for="role">Role</label>
        </div>
        <button type="submit">Register</button>
    </form>
    <div class="register-footer">
        Already have an account? <a href="login.php">Login</a>
    </div>
</main>
</body>
</html>
