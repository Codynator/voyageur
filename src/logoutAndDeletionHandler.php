<?php
include('./connection.php');


session_start();
$conn = connect();
$conn->set_charset('utf8');


if (isset($_POST['btn'])) {
    if ($_POST['btn'] === 'logout') {
        unset($_SESSION['user_id']);

    } else if ($_POST['btn'] === 'delete') {
        $userPassworsQuery = 'SELECT password FROM users WHERE id = ' . $_SESSION['user_id'];
        $password = $conn->query($userPassworsQuery)->fetch_assoc()['password'];
        
        if (password_verify($_POST['deletionPassword'], $password)) {
            $userDeletionQuery = 'DELETE FROM users WHERE id = ' . $_SESSION['user_id'];
            $conn->query($userDeletionQuery);

            $userFavoritesDeletionQuery = 'DELETE FROM favorites WHERE id_user = ' . $_SESSION['user_id'];
            $conn->query($userFavoritesDeletionQuery);
            unset($_SESSION['user_id']);
        } else {
            $errorMsg = 'wrong password';
            header("Location: ./profile.php?errorMsg=$errorMsg");
            exit;
        }
    }

}

header('Location: ./main.php');
exit;