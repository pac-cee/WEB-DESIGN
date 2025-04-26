<?php
require_once __DIR__ . '/../controllers/auth.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($email && $password) {
        if (login($email, $password)) {
            $role = get_user_role();
            if ($role === ROLE_ADMIN) {
                header('Location: ../controllers/dashboard_admin.php');
            } elseif ($role === ROLE_ORGANIZER) {
                header('Location: ../controllers/dashboard_organizer.php');
            } else {
                header('Location: ../controllers/dashboard_attendee.php');
            }
            exit();
        } else {
            $msg = "<span style='color:red'><i class='fas fa-exclamation-circle'></i> Invalid credentials.</span>";
        }
    } else {
        $msg = "<span style='color:red'><i class='fas fa-exclamation-circle'></i> Please fill all fields.</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Eventify</title>
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
.login-glass {
  max-width: 420px;
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
.login-glass h1 {
  text-align: center;
  color: #4f8cff;
  font-size: 2.2em;
  font-weight: 700;
  margin-bottom: 1.5em;
  letter-spacing: 1px;
}
.login-glass form {
  display: flex;
  flex-direction: column;
  gap: 1.3em;
}
.form-group {
  position: relative;
  margin-bottom: 0.2em;
}
.form-group input {
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
.form-group input:focus {
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
.form-group input:not(:placeholder-shown) + label {
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
.login-glass button[type="submit"] {
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
.login-glass button[type="submit"]:hover, .login-glass button[type="submit"]:focus {
  background: linear-gradient(90deg, #6cb8ff 0%, #4f8cff 100%);
  box-shadow: 0 6px 32px #4f8cff33;
  transform: translateY(-2px) scale(1.03);
}
.login-glass .login-footer {
  margin-top: 1.7em;
  text-align: center;
  font-size: 1.04em;
  color: #232946b0;
}
.login-glass .login-footer a {
  color: #7c3aed;
  text-decoration: underline;
  font-weight: 600;
  transition: color 0.18s;
}
.login-glass .login-footer a:hover {
  color: #4f8cff;
}
@media (max-width: 600px) {
  .login-glass {
    padding: 1.2em 0.4em 1.3em 0.4em;
    max-width: 98vw;
  }
}
</style>
<main class="login-glass">
    <h1>Login</h1>
    <?php if (!empty($msg)) echo '<div style="margin-bottom:1em">'.$msg.'</div>'; ?>
    <form method="post" autocomplete="off">
        <div class="form-group">
            <span class="input-icon"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email" id="email" required placeholder=" " autocomplete="username">
            <label for="email">Email</label>
        </div>
        <div class="form-group">
            <span class="input-icon"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" id="password" required placeholder=" " autocomplete="current-password">
            <label for="password">Password</label>
        </div>
        <button type="submit">Login</button>
    </form>
    <div class="login-footer">
        Don’t have an account? <a href="register.php">Register</a>
    </div>
</main>
</body>
</html>
