<?php
include ("./connection.php");


session_start();
$conn = connect();
$conn->set_charset('utf8');

if (!isset($_SESSION['user_id'])) {
    header('Location: main.php');
    exit;
}

$user = "";
$result = $conn->query('SELECT * FROM users WHERE id = ' . $_SESSION['user_id']);
$user = $result->fetch_assoc();

$favoriteTravelsQuery = "SELECT t.title FROM travels AS t INNER JOIN favorites AS f ON t.id = f.id_travel WHERE f.id_user = " . $_SESSION['user_id'];
$favoriteTravelsResult = $conn->query($favoriteTravelsQuery);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your profile</title>
    <link rel="stylesheet" href="./styles/mainStyle.css">
    <link rel="stylesheet" href="./styles/navStyle.css">
    <link rel="stylesheet" href="./styles/profileStyle.css">
    <link rel="stylesheet" href="./styles/footerStyle.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/favicon.ico">
</head>

<body>
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
                            <path fill="var(--text)"
                                d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m0 2a8 8 0 0 1 8 8a8 8 0 0 1-8 8z" />
                        </svg>
                    </button>
                    <a href="./main.php">Contact</a>
                    <a href="./main.php">Favorites</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="background-div"></div>
        <div class="profile-container">
            <div class='profile-header'>
                <h2>Welcome, <?= $user['first_name']; ?>!</h2>
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
            <div class="profile-favorites">
                <h3>Your favorites:</h3>
                <?php if ($favoriteTravelsResult->num_rows > 0): ?>
                    <?php while ($row = $favoriteTravelsResult->fetch_assoc()): ?>
                        <?php if ($row && isset($row['title'])): ?>
                            <a href="./travel.php?title=<?= $row['title']; ?>"><?= $row['title']; ?></a>
                        <?php endif; ?>
                    <?php endwhile; ?>

                <?php else: ?>
                    <p>Nothing has been found</p>
                <?php endif; ?>
            </div>
            <div class="profile-bought-travels">
                <h3>Purchase history</h3>
            </div>
            <div class="profile-btn-container">
                <form action="./logoutAndDeletionHandler.php" method="POST">
                    <button type="submit" name="btn" value="logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5M4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4z" />
                        </svg>
                        Logout
                    </button>
                    <button type="button" id="delete-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                        </svg>
                        Delete account
                    </button>
                    <div class="confirmation-div">
                        <label>Enter password to delete account:<br>
                            <input type="password" name="deletionPassword">
                        </label>
                        <button type="submit" name='btn' value="delete">Confirm</button>
                        <button type="button" id="cancel-btn">Cancel</button>
                        <?php if (isset($_GET['errorMsg'])): ?>
                            <p><?= $_GET['errorMsg']; ?></p>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <h3>Voyager &copy 2024</h3>
        <p>Website made by Nataniel Krzempek as a school project.<br><br>The coincidences of the names of the travels, their descriptions as well as other data are coincidental.</p>
    </footer>

    <script src="./scripts/themeChanger.js"></script>
    <script src="./scripts/accountDeletionWindowHandler.js"></script>
</body>

</html>