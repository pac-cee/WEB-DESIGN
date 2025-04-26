<?php
require_once __DIR__ . '/../controllers/auth.php';
require_role(ROLE_ORGANIZER);
require_once __DIR__ . '/../config/db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $date = $_POST['date'] ?? '';
    $location = trim($_POST['location'] ?? '');
    $seats = intval($_POST['seats'] ?? 0);
    $desc = $_POST['description'] ?? '';
    $image = $_FILES['image'] ?? null;
    $org_id = $_SESSION['user_id'];
    if ($title && $date && $location && $seats > 0 && $desc && $image && $image['tmp_name']) {
        $img_name = uniqid('event_') . '_' . basename($image['name']);
        $img_path = '../assets/images/' . $img_name;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            $db = new Database();
            $conn = $db->getConnection();
            $stmt = $conn->prepare("INSERT INTO events (organizer_id, title, description, image, location, date, seats_total, seats_available, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
            $stmt->bind_param("isssssii", $org_id, $title, $desc, $img_name, $location, $date, $seats, $seats);
            if ($stmt->execute()) {
                $msg = "<span style='color:green'><i class='fas fa-check-circle'></i> Event created! Awaiting admin approval.</span>";
            } else {
                $msg = "<span style='color:red'><i class='fas fa-exclamation-circle'></i> Error: " . htmlspecialchars($stmt->error) . "</span>";
            }
            $stmt->close();
        } else {
            $msg = "<span style='color:red'><i class='fas fa-exclamation-circle'></i> Image upload failed.</span>";
        }
    } else {
        $msg = "<span style='color:red'><i class='fas fa-exclamation-circle'></i> Please fill all fields and upload an image.</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event - Eventify</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.7/quill.snow.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f8cff;
            --dashboard-bg: #f4f8ff;
            --dashboard-card: #fff;
            --dashboard-text: #232946;
            --dashboard-shadow: 0 8px 32px #4f8cff22;
        }
        [data-theme="dark"] {
            --primary: #60aaff;
            --dashboard-bg: #181f2a;
            --dashboard-card: #232946;
            --dashboard-text: #f1f5fa;
            --dashboard-shadow: 0 8px 32px #23294633;
        }
        body {
            background: var(--dashboard-bg);
            color: var(--dashboard-text);
            transition: background 0.3s, color 0.3s;
        }
        .create-event-card {
            max-width: 520px;
            margin: 3.5em auto;
            background: var(--dashboard-card);
            border-radius: 22px;
            box-shadow: var(--dashboard-shadow);
            padding: 2.5em 2em 2em 2em;
            position: relative;
            backdrop-filter: blur(12px) saturate(160%);
            animation: fadeInUp 0.7s cubic-bezier(.65,.05,.36,1);
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(60px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .create-event-card h1 {
            text-align: center;
            color: var(--primary);
            font-size: 2.1em;
            font-weight: 700;
            margin-bottom: 1.5em;
            letter-spacing: 1px;
        }
        .create-event-card form {
            display: flex;
            flex-direction: column;
            gap: 1.25em;
        }
        .form-group {
            position: relative;
            margin-bottom: 0.2em;
        }
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="number"],
        .form-group textarea {
            width: 100%;
            padding: 1.1em 1em 1.1em 2.7em;
            border: 1.5px solid #d1d5db;
            border-radius: 10px;
            font-size: 1.08em;
            background: rgba(255,255,255,0.93);
            color: var(--dashboard-text);
            outline: none;
            transition: border 0.22s, box-shadow 0.22s;
            box-shadow: 0 2px 8px #4f8cff0a;
            resize: none;
        }
        [data-theme="dark"] .form-group input,
        [data-theme="dark"] .form-group textarea {
            background: #232946;
            color: #f1f5fa;
            border-color: #334155;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            border: 1.5px solid var(--primary);
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
        .form-group textarea:focus + label,
        .form-group textarea:not(:placeholder-shown) + label {
            top: -0.85em;
            left: 1.2em;
            font-size: 0.92em;
            color: var(--primary);
            background: var(--dashboard-card);
            padding: 0 0.3em;
            border-radius: 6px;
        }
        .form-group .input-icon {
            position: absolute;
            left: 0.9em;
            top: 1.15em;
            color: var(--primary);
            font-size: 1.13em;
            pointer-events: none;
            opacity: 0.85;
        }
        .form-group input[type="file"] {
            padding: 1.1em 1em;
            border-radius: 10px;
            background: rgba(255,255,255,0.93);
            color: var(--dashboard-text);
            border: 1.5px solid #d1d5db;
            font-size: 1.05em;
        }
        [data-theme="dark"] .form-group input[type="file"] {
            background: #232946;
            color: #f1f5fa;
            border-color: #334155;
        }
        .create-event-card button[type="submit"] {
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
        .create-event-card button[type="submit"]:hover, .create-event-card button[type="submit"]:focus {
            background: linear-gradient(90deg, #6cb8ff 0%, #4f8cff 100%);
            box-shadow: 0 6px 32px #4f8cff33;
            transform: translateY(-2px) scale(1.03);
        }
        @media (max-width: 600px) {
            .create-event-card {
                padding: 1.2em 0.4em 1.3em 0.4em;
                max-width: 98vw;
            }
        }
    </style>
</head>
<body>
    <main class="create-event-card">
        <h1>Create Event</h1>
        <?php if (!empty($msg)) echo '<div style="margin-bottom:1em">'.$msg.'</div>'; ?>
        <form method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <span class="input-icon"><i class="fas fa-heading"></i></span>
                <input type="text" name="title" id="title" required placeholder=" ">
                <label for="title">Title</label>
            </div>
            <div class="form-group">
                <span class="input-icon"><i class="fas fa-calendar"></i></span>
                <input type="date" name="date" id="date" required placeholder=" ">
                <label for="date">Date</label>
            </div>
            <div class="form-group">
                <span class="input-icon"><i class="fas fa-location-dot"></i></span>
                <input type="text" name="location" id="location" required placeholder=" ">
                <label for="location">Location</label>
            </div>
            <div class="form-group">
                <span class="input-icon"><i class="fas fa-chair"></i></span>
                <input type="number" name="seats" id="seats" min="1" required placeholder=" ">
                <label for="seats">Total Seats</label>
            </div>
            <div class="form-group">
                <span class="input-icon"><i class="fas fa-image"></i></span>
                <input type="file" name="image" id="image" accept="image/*">
                <label for="image">Event Image</label>
            </div>
            <div class="form-group">
                <span class="input-icon"><i class="fas fa-align-left"></i></span>
                <textarea name="description" id="description" rows="4" required placeholder=" "></textarea>
                <label for="description">Description</label>
            </div>
            <button type="submit">Create Event</button>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <script>
      flatpickr('#dateInput', {enableTime:true, dateFormat:'Y-m-d H:i'});
      var quill = new Quill('#quillEditor', {theme:'snow'});
      function syncDesc() {
        document.getElementById('descInput').value = quill.root.innerHTML;
      }
      function previewImg(e) {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(ev) {
            document.getElementById('imgPreview').innerHTML = `<img src='${ev.target.result}' style='max-width:180px;border-radius:8px;box-shadow:0 2px 8px #4f8cff22;'>`;
          };
          reader.readAsDataURL(file);
        }
      }
    </script>
</body>
</html>
