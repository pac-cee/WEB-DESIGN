<?php
require_once __DIR__ . '/../controllers/auth.php';
require_role(ROLE_ATTENDEE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendee Dashboard - Eventify</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
</head>
<body>
<header class="dashboard-header" style="background:rgba(255,255,255,0.18);backdrop-filter:blur(12px) saturate(180%);border-radius:18px 18px 0 0;box-shadow:0 8px 32px #4f8cff22;padding:2em 2em 1em 2em;margin-bottom:1.5em;animation:fadeInDown 0.7s cubic-bezier(.65,.05,.36,1);">
    <h1 style="color:var(--primary,#4f8cff);font-size:2.3em;margin-bottom:0.3em;">Attendee Dashboard</h1>
    <p style="color:#232946b3;font-size:1.07em;">Welcome, <span style="font-weight:600;">Attendee</span>. Browse events and manage your tickets below.</p>
</header>
<nav aria-label="Attendee dashboard navigation">
    <a href="dashboard_attendee.php" class="active" aria-current="page"><i class="fas fa-calendar-check"></i> <span class="visually-hidden">Current: </span>Dashboard</a>
    <a href="browse_events.php"><i class="fas fa-search"></i> Browse Events</a>
    <a href="my_tickets.php"><i class="fas fa-ticket-alt"></i> My Tickets</a>
    <a href="../controllers/auth.php?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>
</nav>
<main>

    <section>
        <h2>Upcoming Registered Events</h2>
        <div id="attendeeEvents"></div>
    </section>
    <section>
        <h2>Event Map</h2>
        <div id="eventMap" style="height: 320px;"></div>
    </section>
</main>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="../assets/js/attendee_dashboard.js"></script>
</body>
</html>
