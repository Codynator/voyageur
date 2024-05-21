<?php
include('./connection.php');
session_start();

$conn = connect();
$conn->set_charset('utf8');

if (isset($_GET['remove'])) {
    $removeQuery = 'DELETE f FROM favorites AS f INNER JOIN travels AS t ON f.id_travel = t.id WHERE t.title LIKE "' . $_GET['remove'] .
        '" AND f.id_user = ' . $_SESSION['user_id'];

    $conn->query($removeQuery);

} elseif (isset($_GET['add'])) {
    $travelIdQuery = 'SELECT id FROM travels WHERE title LIKE "' . $_GET['add'] . '"';
    $travelId = $conn->query($travelIdQuery)->fetch_assoc()['id'];

    $addQuery = 'INSERT INTO favorites (id_user, id_travel) VALUES (' . $_SESSION['user_id'] . ", $travelId)";
    $conn->query($addQuery);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite system</title>
</head>
<body>
    <script>
        window.history.back();
    </script>
</body>
</html>
