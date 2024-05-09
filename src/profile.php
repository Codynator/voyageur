<?php
session_start();
var_dump($_SESSION);
// unset($_SESSION['user_id']);

if (!isset($_SESSION['user_id'])) {
    header('Location: main.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>