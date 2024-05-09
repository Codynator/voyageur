<?php
include("./connection.php");


session_start();
$conn = connect();
$conn->set_charset('utf8');
// unset($_SESSION['user_id']);

if (!isset($_SESSION['user_id'])) {
    header('Location: main.php');
    exit;
}

$user = "";
$result = $conn->query('SELECT * FROM users WHERE id = ' . $_SESSION['user_id']);
$user = $result->fetch_assoc();
var_dump($user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/mainStyle.css">
    <link rel="stylesheet" href="./styles/navStyle.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/favicon.ico">
</head>

<body>
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
        <div class="profile-container">
            <div class='profile-header'>
                <h2>Welcome <?= $user['first_name']; ?>!</h2>
            </div>
            <div class="profile-data">
                <h3>Your data:</h3>
                <ul>
                    <li>First name: <b><?= $user['first_name']; ?></b></li>
                    <li>Last name: <b><?= $user['last_name']; ?></b></li>
                    <li>Email: <b><?= $user['email']; ?></b></li>
                    <li>Account creation date: <b><?= $user['creation_date']; ?></b></li>
                </ul>
            </div>
            <div class="profile-favorites"></div>
            <div class="profile-bought-travels"></div>
        </div>
    </main>

    <script src="./scripts/themeChanger.js"></script>
</body>

</html>