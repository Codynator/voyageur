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
        <h2>
            <button title='Go back' id='goBack-btn'>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="var(--text)" d="M13.5 21H6v-4h7.5c1.93 0 3.5-1.57 3.5-3.5S15.43 10 13.5 10H11v4L4 8l7-6v4h2.5c4.14 0 7.5 3.36 7.5 7.5S17.64 21 13.5 21"/></svg>
            </button>
            <?= $travelResult['title']; ?>
        </h2>
        <p class="status-par">Status: <?= empty($travelResult['status']) ? "standard" : '<b>' . $travelResult['status'] . '</b>'; ?></p>
        <div class="description-div"><?= $travelResult['description']; ?></div>
        <div class="summary-div">
            <h3>Summary</h3>
            <ul>
                <li>Country: <b><?= $travelResult['country']; ?></b></li>
                <li>Town: <b><?= $travelResult['town']; ?></b></li>
                <li>Length: <b><?= $travelResult['length']; ?> days</b></li>
                <li>Type of transport: <b><?= $travelResult['type']; ?></b></li>
                <?php if(!empty($travelResult['airport_name'])) : ?>
                    <li>Airport: <b><?= $travelResult['airport_name']; ?></b></li>
                <?php endif; ?>
            </ul>
        </div>
    </main>

    <script src="./scripts/themeChanger.js"></script>
    <script src='./scripts/goBack.js'></script>
</body>

</html>