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
            <!-- <progress value="25" max="100"></progress> -->
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
            <h2>Where would like to go?</h2>

            <div class="header-container">
                <div class="button-container">
                    <button>Select destination</button>
                    <div class="button-menu"></div>
                </div>
                <div class="button-container">
                    <button>From where and how</button>
                    <div class="button-menu"></div>
                </div>
                <div class="button-container">
                    <button>For how long</button>
                    <div class="button-menu"></div>
                </div>
                <div class="button-container">
                    <button>For how many people</button>
                    <div class="button-menu"></div>
                </div>

                <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="submit" value="Search" name="search-btn">

                    <input type="text" name="trevel-length" hidden>
                    <input type="text" name="ammount-of-adults" hidden>
                    <input type="text" name="ammount-of-children" hidden>
                    <input type="text" name="destination" hidden>
                    <input type="text" name="airport" hidden>
                </form>
            </div>
        </div>
    </header>

    <main>

    </main>

    <script src="./scripts/themeChanger.js"></script>
    <script src="./scripts/searchEngine.js"></script>
</body>

</html>