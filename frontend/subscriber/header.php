<?php
session_start();
require_once('../../classes.php');
// Unseralize user object from session to use it in the page
if (empty($user = unserialize($_SESSION['user']))) {
    header("Location: ../../login.php?msg=Please_login_first");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Subscriber Dashboard</title>

    <!-- Add Google Fonts for a modern, premium look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="../../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg glass-navbar fixed-top navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">PremiumDash</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">Home</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../handle_logout.php" class="btn btn-outline-custom">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>