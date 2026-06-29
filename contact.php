<?php
require 'db.php';

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $service  = trim($_POST['service'] ?? '');
    $comments = trim($_POST['comments'] ?? '');

    if ($name && $email && $phone && $service) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, service, comments) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $phone, $service, $comments);
        if ($stmt->execute()) {
            $success = "Thank you! Your message has been sent.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact — Narefree</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body id="contactid">

<nav class="navbar">
    <a href="index.html" class="logo">
        <div class="logo-text">Nare<span>free</span></div>
    </a>
    <ul class="nav-links">
        <li><a href="service.html">Services</a></li>
        <li><a href="project.html">Projects</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="login.php">Owner Login</a></li>
    </ul>
</nav>

<section class="contact container py-4">
    <h3>Get in touch</h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="contact.php" method="POST">
        <div class="mb-3 mt-3">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone Number:</label>
            <input type="text" class="form-control" name="phone" placeholder="Enter your phone number" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Service of Interest:</label>
            <select class="form-control" name="service" required>
                <option value="">-- Select a service --</option>
                <option>Solar Installation</option>
                <option>Solar Maintenance</option>
                <option>Battery Backup</option>
                <option>Consultation</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Comments:</label>
            <textarea class="form-control" rows="5" name="comments"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</section>
<br>
<footer class="site-footer">
  <div class="footer-container">
    <!-- Company Info Column -->
    <div class="footer-column company-info">
      <h3 class="footer-logo">Electromechanical<span>Solutions</span></h3>
      <p>Providing precision engineering and innovative electromechanical solutions since 1985. We empower industries through excellence and reliability.</p>
      <div class="social-links">
       <a href="https://x.com"><ion-icon name="logo-x"></ion-icon></a>
        <a href="https://instagram.com/narefree"><ion-icon name="logo-instagram"></ion-icon></a>
        <a href="https://facebook.com"><ion-icon name="logo-facebook"></ion-icon></a>
        <a href="https://titok.com"><ion-icon name="logo-tiktok"></ion-icon></a>
      </div>
    </div>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>


</body>
</html>
