<?php
include('./connection.php');
session_start();

$conn = connect();
mysqli_set_charset($conn, 'utf8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyageur</title>
    <link rel="stylesheet" href="./styles/mainStyle.css">
    <link rel="stylesheet" href="./styles/navStyle.css">
    <link rel="stylesheet" href="./styles/headerStyle.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/favicon.ico">
</head>

<body>
    <nav>
        <div class="left-nav">
            <a href="./main.php" class="logo"><img src="../public/voyageur_logo.png" alt=""></a>
            <a href="./main.php">All Inclusive</a>
            <a href="./main.php">Last Minute</a>
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

    <header>
        <div>
            <h2>Where would <i>You</i> like to go?</h2>

            <div class="header-container">
                <div class="button-container">
                    <button id="btn-destination">Select country
                        <p></p>
                    </button>
                    <div class="button-menu"></div>
                </div>
                <div class="button-container">
                    <button id='btn-transport'>From where and how
                        <p></p>
                    </button>
                    <div class="button-menu"></div>
                </div>
                <div class="button-container">
                    <button id='btn-length'>For how long
                        <p></p>
                    </button>
                    <div class="button-menu"></div>
                </div>
                <div class="button-container">
                    <button class='ammount'>For how many people
                        <p></p>
                    </button>
                    <div class="button-menu"></div>
                </div>

                <div class="selection-container">
                    <div class="destination-container">

                    </div>
                    <div class="from-where-container"></div>
                    <div class="length-container"></div>
                    <div class="ammount-container"></div>
                </div>

                <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="submit" value="Search!" name="search-btn">

                    <div class="dialog-container">

                    
                        <!-- DIALOG DESTINATION -->
                        <dialog id="dialog-destination">
                            <h3>Select the country</h3>

                            <div>
                                <?php
                                $sqlD = 'SELECT DISTINCT(country) FROM destinations';
                                $resultD = $conn->query($sqlD);

                                while ($dest = $resultD->fetch_assoc()) :
                                ?>
                                    <label class='label-container'>
                                        <?= $dest['country']; ?>
                                        <input type='checkbox' name='destination' value='<?= $dest['country']; ?>'>
                                        <span class='checkmark'></span>
                                    </label><br>
                                <?php endwhile; ?>
                            </div>

                            <button class="btn-dialog-confirm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71 4.04c.39-.39.39-1.04 0-1.41L18.37.29C18-.1 17.35-.1 16.96.29L15 2.25L18.75 6m-1 1L14 3.25l-10 10V17h3.75z" />
                                </svg>Confirm</button>
                            <button class="btn-dialog-close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2m0 16H5V5h14zM17 8.4L13.4 12l3.6 3.6l-1.4 1.4l-3.6-3.6L8.4 17L7 15.6l3.6-3.6L7 8.4L8.4 7l3.6 3.6L15.6 7z" />
                                </svg>Cancel</button>
                        </dialog>


                        <!-- DIALOG TRANSPORT AND AIRPORT -->
                        <dialog id="dialog-transport">
                            <h3>Select the transport</h3>

                            <div>
                                <?php
                                $sqlTransport = 'SELECT type FROM types';
                                $resultTransport = $conn->query($sqlTransport);

                                while ($transport = $resultTransport->fetch_assoc()) :
                                ?>
                                    <label class="label-container">
                                        <?= $transport['type']; ?>
                                        <input type="checkbox" name='transport' value='<?= $transport['type'] ?>'>
                                        <span class="checkmark"></span>
                                    </label><br>
                                <?php endwhile; ?>
                            </div>

                            <h3>Select the airport</h3>

                            <div>
                                <?php
                                $sqlAirport = 'SELECT airport_name FROM airports';
                                $resultAirport = $conn->query($sqlAirport);

                                while ($airport = $resultAirport->fetch_assoc()) :
                                ?>
                                    <label class="label-container">
                                        <?= $airport['airport_name']; ?>
                                        <input type="checkbox" name="airport" value='<?= $airport['airport_name']; ?>'>
                                        <span class="checkmark"></span>
                                    </label><br>
                                <?php endwhile; ?>
                            </div>

                            <button class="btn-dialog-confirm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71 4.04c.39-.39.39-1.04 0-1.41L18.37.29C18-.1 17.35-.1 16.96.29L15 2.25L18.75 6m-1 1L14 3.25l-10 10V17h3.75z" />
                                </svg>Confirm</button>
                            <button class="btn-dialog-close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2m0 16H5V5h14zM17 8.4L13.4 12l3.6 3.6l-1.4 1.4l-3.6-3.6L8.4 17L7 15.6l3.6-3.6L7 8.4L8.4 7l3.6 3.6L15.6 7z" />
                                </svg>Cancel</button>
                        </dialog>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <main>

    </main>

    <script src="./scripts/themeChanger.js"></script>
    <script src="./scripts/searchEngine.js"></script>
    <!-- <script src="./scripts/destinationHandler.js"></script> -->
    <script src="./scripts/dialogModule.js"></script>
</body>

</html>

<?php
$conn->close();
?>