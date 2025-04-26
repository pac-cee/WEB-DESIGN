<?php
require_once __DIR__ . '/../controllers/auth.php';
require_role(ROLE_ADMIN);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Eventify</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js/dist/Chart.min.css">
</head>
<body>
<header class="dashboard-header" style="background:rgba(255,255,255,0.18);backdrop-filter:blur(12px) saturate(180%);border-radius:18px 18px 0 0;box-shadow:0 8px 32px #4f8cff22;padding:2em 2em 1em 2em;margin-bottom:1.5em;animation:fadeInDown 0.7s cubic-bezier(.65,.05,.36,1);">
    <h1 style="color:var(--primary,#4f8cff);font-size:2.3em;margin-bottom:0.3em;">Admin Dashboard</h1>
    <p style="color:#232946b3;font-size:1.07em;">Welcome, <span style="font-weight:600;">Admin</span>. Manage users, approve events, and view analytics below.</p>
</header>
<nav aria-label="Admin dashboard navigation">
    <a href="dashboard_admin.php" class="active" aria-current="page"><i class="fas fa-chart-pie"></i> <span class="visually-hidden">Current: </span>Dashboard</a>
    <a href="manage_users.php"><i class="fas fa-users-cog"></i> Manage Users</a>
    <a href="approve_events.php"><i class="fas fa-check-circle"></i> Approve Events</a>
    <a href="../controllers/auth.php?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>
</nav>
<main>

    <section>
        <canvas id="analyticsChart" width="600" height="300"></canvas>
    </section>
    <section>
        <h2>Recent Events & Users</h2>
        <!-- Table for quick stats -->
        <div id="quickStats"></div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../assets/js/admin_dashboard.js"></script>
</body>
</html>
