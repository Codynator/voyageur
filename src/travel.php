<?php
include("./connection.php");
session_start();

$conn = connect();
$conn->set_charset('utf8');

if (isset($_GET['title'])) {
    $title = $_GET['title'];
    $travelQuery = "SELECT * FROM generalView WHERE title = '$title'";
    $travelResult = $conn->query($travelQuery);
    $travelResult = $travelResult->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel</title>
    <link rel="stylesheet" href="./styles/mainStyle.css">
    <link rel="stylesheet" href="./styles/navStyle.css">
    <link rel="stylesheet" href="./styles/travelStyle.css">
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
                    <a href="./main.php">Log in</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <h2><?= $travelResult['title']; ?></h2>
        <p class="status-par">Status: <?= empty($travelResult['status']) ? "standard" : $travelResult['status']; ?></p>
        <div class="description-div"><?= $travelResult['description']; ?></div>
    </main>

    <script src="./scripts/themeChanger.js"></script>
</body>

</html>