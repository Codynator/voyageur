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

    $travelIdQuery = 'SELECT id FROM travels WHERE title LIKE "' . $title . '"';
    $travelId = $conn->query($travelIdQuery)->fetch_assoc()['id'];

    $pricesQuery = "SELECT base_price, ticket, dis_ticket FROM prices WHERE travel_id = $travelId";
    $pricesResult = $conn->query($pricesQuery)->fetch_assoc();

    if (isset($_SESSION['user_id'])) {
        $favoritesQuery = "SELECT f.id FROM favorites AS f INNER JOIN travels AS t ON f.id_travel = t.id WHERE t.title LIKE \"" . $travelResult['title'] . "\" AND f.id_user = " . $_SESSION['user_id'];
        $favortiesResult = $conn->query($favoritesQuery);
    }
}

$conn->close();
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
    <link rel="stylesheet" href="./styles/footerStyle.css">
    <link rel="stylesheet" href="./styles/dialogStyle.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/favicon.ico">
</head>

<body>
    <dialog>
        <form action="./buyTravel.php?travel_id=<?= $travelId; ?>" method="POST">
            <h3>Please input the number of participants</h3>
            <label>Number of adults (required):<br><input type="number" name="adults" required placeholder="0"></label>
            <br>
            <label>Number of children:<br><input type="number" name="children" placeholder="0"></label>

            <button class="btn-dialog-confirm" name="btn" value="buy">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20.71 4.04c.39-.39.39-1.04 0-1.41L18.37.29C18-.1 17.35-.1 16.96.29L15 2.25L18.75 6m-1 1L14 3.25l-10 10V17h3.75z" />
                </svg>Confirm purchase</button>
            <button class="btn-dialog-close" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2m0 16H5V5h14zM17 8.4L13.4 12l3.6 3.6l-1.4 1.4l-3.6-3.6L8.4 17L7 15.6l3.6-3.6L7 8.4L8.4 7l3.6 3.6L15.6 7z" />
                </svg>Cancel</button>
        </form>
    </dialog>


    <nav>
        <div class="left-nav">
            <a href="./main.php" class="logo"><img src="../public/voyageur_logo.png" alt="">Voyageur</a>
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
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <a href="./profile.php">Profile</a>
                    <?php else : ?>
                        <a href="./login.php">Log in</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="background-div"></div>
    <main>
        <h2>
            <button title='Go back' id='goBack-btn'>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="var(--text)" d="M13.5 21H6v-4h7.5c1.93 0 3.5-1.57 3.5-3.5S15.43 10 13.5 10H11v4L4 8l7-6v4h2.5c4.14 0 7.5 3.36 7.5 7.5S17.64 21 13.5 21" />
                </svg>
            </button>

            <form action="./favorites.php" method="GET">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <?php if ($favortiesResult->num_rows > 0) : ?>
                        <button title='Remove from favorites' id='addFavorite-btn' value="<?= $travelResult['title']; ?>" name='remove'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="var(--text)" d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.27 2 8.5C2 5.41 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.08C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.41 22 8.5c0 3.77-3.4 6.86-8.55 11.53z" />
                            </svg>
                        </button>
                    <?php elseif ($favortiesResult->num_rows === 0) : ?>
                        <button title='Add to favorites' id='addFavorite-btn' value="<?= $travelResult['title']; ?>" name='add'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="var(--text)" d="m12.1 18.55l-.1.1l-.11-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04 1 3.57 2.36h1.86C13.46 6 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05M16.5 3c-1.74 0-3.41.81-4.5 2.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5c0 3.77 3.4 6.86 8.55 11.53L12 21.35l1.45-1.32C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3" />
                            </svg>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
            </form>

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
                <?php if (!empty($travelResult['airport_name'])) : ?>
                    <li>Airport: <b><?= $travelResult['airport_name']; ?></b></li>
                <?php endif; ?>
                <li>Base price: <b><?= $pricesResult['base_price']; ?></b></li>
                <li>Normal ticket: <b><?= $pricesResult['ticket']; ?></b></li>
                <li>Discounted: <b><?= $pricesResult['dis_ticket']; ?></b></li>
            </ul>
        </div>

        <?php if (isset($_SESSION['user_id'])) : ?>
            <button type="button" id="open-form-btn">Buy</button>
        <?php else : ?>
            <p class="reminder-par">In order to buy this travel. you need to log in first.</p>
        <?php endif; ?>
    </main>

    <footer>
        <h3>Voyager &copy 2024</h3>
        <p>Website made by Nataniel Krzempek as a school project.<br><br>The coincidences of the names of the travels, their descriptions as well as other data are coincidental.</p>
    </footer>

    <script src="./scripts/themeChanger.js"></script>
    <script src='./scripts/goBack.js'></script>
    <script src='./scripts/dialogModule.js'></script>
    <script src="./scripts/travelFormHandler.js"></script>
</body>

</html>