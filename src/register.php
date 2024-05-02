<?php
include("./connection.php");
session_start();

$conn = connect();
$conn->set_charset('utf8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel</title>
    <link rel="stylesheet" href="./styles/mainStyle.css">
    <link rel="stylesheet" href="./styles/navStyle.css">
    <link rel="stylesheet" href="./styles/registerStyle.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/favicon.ico">
</head>
<nav>
    <div class="left-nav">
        <a href="./main.php" class="logo"><img src="../public/voyageur_logo.png" alt=""></a>
        <a href="./offers.php?status=all+inclusive">All Inclusive</a>
        <a href="./offers.php?status=last+minute">Last Minute</a>
    </div>
    <div class="right-nav">
        <div class="menu-container">

            <div class="menu-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                    <path fill="#fefefb" d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z" />
                </svg>
            </div>

            <div class="menu-content">
                <button id="theme-btn" title="Change theme">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <path fill="var(--text)" d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m0 2a8 8 0 0 1 8 8a8 8 0 0 1-8 8z" />
                    </svg>
                </button>
                <a href="./main.php">Contact</a>
                <a href="./main.php">Favorites</a>
            </div>
        </div>
    </div>
</nav>

<main>
    <div class="register-container">
        <h2>Create new account</h2>
        <form action="" method="POST" autocomplete="off">
            <input type="text" name="firstName" placeholder="Enter your first name"><br>
            <input type="text" name="lastName" placeholder="Enter your last name"><br>
            <input type="email" name="email" placeholder="Enter your email"><br>
            <input type="password" name="firstPassword" placeholder="Enter password"><br>
            <input type="password" name="repeatedPassword" placeholder="Repeat password"><br>
            <input type="submit" value="Register">
        </form>
        <p><a href="./login.php">Already have an account?</a></p>
    </div>
</main>

<script src="./scripts/themeChanger.js"></script>
</body>

</html>