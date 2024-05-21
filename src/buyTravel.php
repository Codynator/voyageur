<?php
include('./connection.php');
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$conn = connect();
$conn->set_charset('utf8');

if (!isset($_SESSION['user_id']) || !isset($_GET['travel_id'])) {
    $conn->close();
    header('Location: ./main.php');
    exit;
}

if (isset($_POST['btn'])) {
    $numberOfAdults = intval($_POST['adults']);
    $numberOfChildren = intval($_POST['children']);

    if ($numberOfAdults > 0) {
        $travelId = $_GET['travel_id'];
        $pricesQuery = "SELECT base_price, ticket, dis_ticket FROM prices WHERE travel_id = $travelId";
        $pricesResult = $conn->query($pricesQuery)->fetch_assoc();

        $price = $pricesResult['base_price'] + $pricesResult['ticket'] * $numberOfAdults + $pricesResult['dis_ticket'] * $numberOfChildren;

        $newOrderQuery = $conn->prepare('INSERT INTO orders (user_id, travel_id, order_price, ammount_of_adults, ammount_of_children) VALUES (?, ?, ?, ?, ?)');
        $newOrderQuery->bind_param('iidii', $_SESSION['user_id'], $travelId, $price, $numberOfAdults, $numberOfChildren);
        $newOrderQuery->execute();

        $conn->close();
        header('Location: ./profile.php');
        exit;
    }
}

$conn->close();
header('Location: ./main.php');
exit;
