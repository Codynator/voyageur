<?php
include('./connection.php');
session_start();

$conn = connect();
$conn->set_charset('utf8');


if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $searchQuery = 'SELECT * FROM generalView WHERE status LIKE "' . $status . '"';
    $searchResult = $conn->query($searchQuery);
} else if (isset($_GET['search-btn'])) {
    $countries = [];
    $airports = [];
    $transports = [];
    $length = [];

    $searchQuery = 'SELECT * FROM generalView ';
    $filters = [];

    if (isset($_GET['destination'])) {
        $countries = $_GET['destination'];
        array_push($filters, ' country IN(' . join(',', $countries) . ')');
    }
    if (isset($_GET['transport'])) {
        $transport = $_GET['transport'];
        array_push($filters, ' type IN(' . join(',', $transport) . ')');
    }
    if (isset($_GET['airport'])) {
        $airports = $_GET['airport'];
        array_push($filters, ' airport_name IN(' . join(',', $airports) . ')');
    }
    if (isset($_GET['length'])) {
        $length = $_GET['length'];
        array_push($filters, " length IN(" . join(",", $length) . ")");
    }

    if (!empty($filters)) {
        $searchQuery .= 'WHERE ' . join(' AND', $filters);
    }
    $searchResult = $conn->query($searchQuery);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers</title>
    <link rel="stylesheet" href="./styles/mainStyle.css">
    <link rel="stylesheet" href="./styles/navStyle.css">
    <link rel="stylesheet" href="./styles/offersStyle.css">
    <link rel="stylesheet" href="./styles/footerStyle.css">
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
                    <?php if(isset($_SESSION['user_id'])) : ?>
                        <a href="./profile.php">Profile</a>
                    <?php else : ?>
                        <a href="./login.php">Log in</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="card-container">
            <?php if ($searchResult->num_rows > 0) : ?>
                <?php while ($cardInfo = $searchResult->fetch_assoc()) : ?>

                    <div class='card'>
                        <a href='./travel.php?title=<?= $cardInfo['title']; ?>'>
                            <h3><?= $cardInfo['title'] ?></h3>
                            <ul>
                                <li>Destination: <span><?= $cardInfo['town'] . ', ' . $cardInfo['country']; ?></span></li>
                                <li>For: <span><?= $cardInfo['length']; ?> days</span></li>
                                <li>Type of transport: <span><?= $cardInfo['type']; ?></span></li>
                            </ul>
                        </a>
                    </div>

                <?php endwhile; ?>
            <?php else : ?>
                <div>
                    <h3>No search results!</h3>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <h3>Voyager &copy 2024</h3>
        <p>Website made by Nataniel Krzempek as a school project.<br><br>The coincidences of the names of the travels, their descriptions as well as other data are coincidental.</p>
    </footer>

    <script src="./scripts/themeChanger.js"></script>
</body>

</html>