<?php
include("./connection.php");


function testInput($value) {
    return htmlspecialchars(stripslashes(trim($value)));
}


session_start();

$conn = connect();
$conn->set_charset('utf8');
$errorMsg = "";

if (!empty($_SESSION['user_id'])) {
    header('Location: ./profile.php');
}

if (isset($_POST['registerBtn'])) {
    $firstName = testInput($_POST['firstName']);
    $lastName = testInput($_POST['lastName']);
    $email = testInput($_POST['email']);
    $password = testInput($_POST['firstPassword']);
    $repeatedPassword = testInput($_POST['repeatedPassword']);
    
    if (empty($firstName)) {
        $errorMsg = "input your first name";
    } else if (empty($lastName)) {
        $errorMsg = 'input your last name';
    } else if (empty($email)) {
        $errorMsg = 'input your email adress';
    } else if (empty($password)) {
        $errorMsg = 'input password';
    } else if (empty($repeatedPassword)) {
        $errorMsg = 'repeat the password';
    } else if (!preg_match('/^[a-zA-Z\'-]+$/', $firstName)) {
        $errorMsg = "invalid first name";
    } else if (!preg_match('/^[a-zA-Z\'-]+$/', $lastName)) {
        $errorMsg = "invalid last name";
    } else if (!preg_match('/^(?=.*\d).{8,}$/', $password)) {
        $errorMsg = "password must be at least<br> 8 characters long and<br> contain at least one digit";
    } else if ($password !== $repeatedPassword) {
        $errorMsg = "passwords are different";
    }

    if (empty($errorMsg)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, creation_date) VALUES (?, ?, ?, ?, CURDATE())");
        $stmt->bind_param('ssss', $firstName, $lastName, $email, $hashedPassword);
        $stmt->execute();
    
        $userId = $conn->insert_id;

        if (isset($userId)) {
            $_SESSION['user_id'] = $userId;
            header('Location: ./profile.php');
            exit;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./styles/mainStyle.css">
    <link rel="stylesheet" href="./styles/navStyle.css">
    <link rel="stylesheet" href="./styles/registerStyle.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/favicon.ico">
</head>
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
            </div>
        </div>
    </div>
</nav>

<main>
    <div class="register-container">
        <h2>Create new account</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
            <input type="text" name="firstName" placeholder="Enter your first name" value="<?= isset($firstName) ? $firstName : '' ?>"><br>
            <input type="text" name="lastName" placeholder="Enter your last name" value="<?= isset($lastName) ? $lastName : '' ?>"><br>
            <input type="email" name="email" placeholder="Enter your email" value="<?= isset($email) ? $email : '' ?>"><br>
            <input type="password" name="firstPassword" placeholder="Enter password"><br>
            <input type="password" name="repeatedPassword" placeholder="Repeat password"><br>
            <?php if(!empty($errorMsg)) : ?>
                <p class="error-par"><?= $errorMsg; ?></p>
            <?php endif; ?>
            <input type="submit" value="Register" name="registerBtn">
        </form>
        <p><a href="./login.php">Already have an account?</a></p>
    </div>
</main>

<script src="./scripts/themeChanger.js"></script>
</body>

</html>