<?php
require_once __DIR__ . '/../controllers/auth.php';
require_role(ROLE_ORGANIZER);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Dashboard - Eventify</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.7/quill.snow.css">
</head>
<body>
<header class="dashboard-header" style="background:rgba(255,255,255,0.18);backdrop-filter:blur(12px) saturate(180%);border-radius:18px 18px 0 0;box-shadow:0 8px 32px #4f8cff22;padding:2em 2em 1em 2em;margin-bottom:1.5em;animation:fadeInDown 0.7s cubic-bezier(.65,.05,.36,1);">
    <h1 style="color:var(--primary,#4f8cff);font-size:2.3em;margin-bottom:0.3em;">Organizer Dashboard</h1>
    <p style="color:#232946b3;font-size:1.07em;">Welcome, <span style="font-weight:600;">Organizer</span>. Create and manage your events below.</p>
<div style="position:absolute;top:2em;right:2em;z-index:10;">
  <button id="theme-toggle-btn" title="Toggle theme" style="background:rgba(255,255,255,0.7);border:none;border-radius:50%;padding:0.6em 0.7em;box-shadow:0 2px 10px #4f8cff22;cursor:pointer;font-size:1.23em;outline:none;transition:background 0.18s;">
    <i class="fas fa-circle-half-stroke"></i>
  </button>
  <div id="theme-menu" style="display:none;position:absolute;right:0;top:2.7em;background:rgba(255,255,255,0.98);border-radius:12px;box-shadow:0 4px 24px #23294622;padding:0.6em 0.5em;min-width:140px;">
    <div class="theme-option" data-theme="light" style="padding:0.5em 1em;cursor:pointer;display:flex;align-items:center;"><i class="fas fa-sun" style="margin-right:0.7em;color:#fbbf24"></i> Light</div>
    <div class="theme-option" data-theme="dark" style="padding:0.5em 1em;cursor:pointer;display:flex;align-items:center;"><i class="fas fa-moon" style="margin-right:0.7em;color:#6366f1"></i> Dark</div>
    <div class="theme-option" data-theme="system" style="padding:0.5em 1em;cursor:pointer;display:flex;align-items:center;"><i class="fas fa-desktop" style="margin-right:0.7em;color:#38bdf8"></i> System</div>
  </div>
</div>
</header>
<nav aria-label="Organizer dashboard navigation">
    <a href="dashboard_organizer.php" class="active" aria-current="page"><i class="fas fa-calendar-alt"></i> <span class="visually-hidden">Current: </span>Dashboard</a>
    <a href="../views/create_event.php"><i class="fas fa-plus-circle"></i> Create Event</a>
    <a href="../views/manage_events.php"><i class="fas fa-edit"></i> Manage Events</a>
    <a href="../controllers/auth.php?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a>
</nav>
<main>

    <section>
        <h2>Upcoming Events</h2>
        <div id="organizerEvents"></div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
<script src="../assets/js/organizer_dashboard.js"></script>
<script src="../assets/js/theme_toggle.js"></script>
<script>
// Show/hide theme menu
const btn = document.getElementById('theme-toggle-btn');
const menu = document.getElementById('theme-menu');
btn.addEventListener('click', e => { menu.style.display = menu.style.display === 'block' ? 'none' : 'block'; e.stopPropagation(); });
document.addEventListener('click', () => { menu.style.display = 'none'; });
</script>
<style>
:root {
  --primary: #4f8cff;
  --dashboard-bg: #f4f8ff;
  --dashboard-card: #fff;
  --dashboard-nav: linear-gradient(90deg,#4f8cff 0%,#263159 100%);
  --dashboard-nav-btn: #fff;
  --dashboard-nav-btn-active: linear-gradient(90deg,#fbbf24 0%,#4f8cff 100%);
  --dashboard-text: #232946;
  --dashboard-header-bg: rgba(255,255,255,0.18);
  --dashboard-shadow: 0 8px 32px #4f8cff22;
}
[data-theme="dark"] {
  --primary: #60aaff;
  --dashboard-bg: #181f2a;
  --dashboard-card: #232946;
  --dashboard-nav: linear-gradient(90deg,#263159 0%,#232946 100%);
  --dashboard-nav-btn: #232946;
  --dashboard-nav-btn-active: linear-gradient(90deg,#6366f1 0%,#60aaff 100%);
  --dashboard-text: #f1f5fa;
  --dashboard-header-bg: rgba(35,41,70,0.22);
  --dashboard-shadow: 0 8px 32px #23294633;
}
body {
  background: var(--dashboard-bg);
  color: var(--dashboard-text);
  transition: background 0.3s, color 0.3s;
}
.dashboard-header {
  background: var(--dashboard-header-bg)!important;
  color: var(--dashboard-text)!important;
  box-shadow: var(--dashboard-shadow)!important;
}
nav[aria-label] {
  background: var(--dashboard-nav)!important;
  border-radius: 12px;
  padding: 0.8em 1em;
  margin: 0 0 2.2em 0;
  display: flex;
  gap: 1em;
  align-items: center;
  box-shadow: 0 4px 20px #4f8cff0d;
}
nav[aria-label] a {
  background: var(--dashboard-nav-btn);
  color: var(--dashboard-text);
  border-radius: 8px;
  padding: 0.7em 1.5em;
  font-weight: 600;
  font-size: 1.08em;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 0.7em;
  transition: background 0.18s, color 0.18s, box-shadow 0.18s;
  box-shadow: 0 2px 10px #4f8cff11;
}
nav[aria-label] a.active, nav[aria-label] a[aria-current="page"] {
  background: var(--dashboard-nav-btn-active);
  color: #fff;
  box-shadow: 0 4px 18px #4f8cff22;
  position: relative;
}
nav[aria-label] a:hover {
  filter: brightness(1.07);
  background: var(--primary);
  color: #fff;
}
main section {
  background: var(--dashboard-card);
  border-radius: 18px;
  box-shadow: var(--dashboard-shadow);
  padding: 2em 1.5em;
  margin: 2em auto 0 auto;
  max-width: 800px;
  transition: background 0.3s, color 0.3s;
}
h2 {
  color: var(--primary);
  margin-bottom: 1.1em;
}
.theme-option.active {
  background: #e0e7ff;
  border-radius: 8px;
  font-weight: 600;
  color: var(--primary)!important;
}
[data-theme="dark"] .theme-option.active {
  background: #23294622;
}
#theme-menu {
  min-width: 140px;
  z-index: 1000;
}
#theme-menu .theme-option:hover {
  background: #e0e7ff55;
  color: var(--primary)!important;
}
[data-theme="dark"] #theme-menu .theme-option:hover {
  background: #23294644;
}
</style>
</body>
</html>
