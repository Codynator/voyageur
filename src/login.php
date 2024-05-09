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

if (isset($_POST['loginBtn'])) {
    $firstName = testInput($_POST['firstName']);
    $lastName = testInput($_POST['lastName']);
    $email = testInput($_POST['email']);
    $password = testInput($_POST['firstPassword']);
    
    if (empty($firstName)) {
        $errorMsg = "input your first name";
    } else if (empty($lastName)) {
        $errorMsg = 'input your last name';
    } else if (empty($email)) {
        $errorMsg = 'input your email adress';
    } else if (empty($password)) {
        $errorMsg = 'input password';
    }

    if (empty($errorMsg)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE first_name = ? AND last_name = ? AND email = ?");
        $stmt->bind_param('sss', $firstName, $lastName, $email);
        $stmt->execute();
    
        $result = $stmt->get_result()->fetch_assoc();
        if ($result) {
            if (password_verify($password, $result['password'])) {
                $userId = $result['id'];
            } else {
                $errorMsg = 'incorrect password';
            }
        } else {
            $errorMsg = 'incorrect data';
        }

        if (isset($userId)) {
            $_SESSION['user_id'] = $userId;
            header('Location: ./profile.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
            <input type="text" name="firstName" placeholder="Enter your first name"><br>
            <input type="text" name="lastName" placeholder="Enter your last name"><br>
            <input type="email" name="email" placeholder="Enter your email"><br>
            <input type="password" name="firstPassword" placeholder="Enter password"><br>
            <?php if(!empty($errorMsg)) : ?>
                <p class="error-par"><?= $errorMsg; ?></p>
            <?php endif; ?>
            <input type="submit" value="Login" name="loginBtn">
        </form>
        <p><a href="./register.php">Don't have an account?</a></p>
    </div>
</main>

<script src="./scripts/themeChanger.js"></script>
</body>

</html>