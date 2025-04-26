<?php
require_once __DIR__ . '/config/db.php';
// Add more includes as needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A modern student management system for managing students, courses, and grades.">
    <link rel="icon" type="image/png" href="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/72x72/1f393.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php" class="active"><i class="fas fa-house"></i> Home</a>
        <a href="add_student.php"><i class="fas fa-user-plus"></i> Add Student</a>
        <a href="view_students.php"><i class="fas fa-users"></i> View Students</a>
    </nav>
    <main>
        <section class="hero">
            <div class="hero-text">
                <h1>Welcome to the Student Management System</h1>
                <p style="font-size:1.2em;">Easily manage students, courses, and grades in one place. Our platform is designed for administrators, teachers, and staff to streamline student data, track academic progress, and improve efficiency.</p>
                <ul style="margin:1em 0 1.5em 1em; padding:0; list-style:none;">
                    <li style="margin-bottom:0.7em;"><i class="fas fa-check-circle" style="color:var(--primary);"></i> Add, edit, and view student records</li>
                    <li style="margin-bottom:0.7em;"><i class="fas fa-check-circle" style="color:var(--primary);"></i> Manage courses and enrollments</li>
                    <li style="margin-bottom:0.7em;"><i class="fas fa-check-circle" style="color:var(--primary);"></i> Track grades and performance</li>
                    <li><i class="fas fa-check-circle" style="color:var(--primary);"></i> Fast, secure, and user-friendly</li>
                </ul>
                <a href="add_student.php" style="background:var(--primary);color:#fff;padding:0.8em 2em;border-radius:8px;font-weight:600;text-decoration:none;box-shadow:0 2px 8px #43b58122;transition:background 0.3s;">Add Student <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="hero-img">
                <img src="https://cdn.pixabay.com/photo/2017/01/31/13/14/graduation-2022442_1280.png" alt="Student Illustration" style="border-radius:12px;box-shadow:0 4px 24px #43b58122;">
            </div>
        </section>
        <section>
            <h2 style="color:var(--primary);font-size:1.4em;margin-bottom:0.7em;">Why Use Our System?</h2>
            <div class="features">
                <div class="feature-card">
                    <i class="fas fa-user-graduate"></i>
                    <h3>Student Management</h3>
                    <p>Keep all student information organized and accessible.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3>Course Tracking</h3>
                    <p>Manage courses, enrollments, and assignments easily.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chart-line"></i>
                    <h3>Performance Insights</h3>
                    <p>Monitor grades and academic progress at a glance.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Secure & Reliable</h3>
                    <p>Your data is protected with modern security standards.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
