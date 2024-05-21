<?php
include("./connection.php");

$conn = connect();
$conn->set_charset('utf8');

$sql = 'SELECT photo FROM images';
$photos = $conn->query($sql);

while ($photo = $photos->fetch_assoc()['photo']) {
    echo '<img src="data:image/jpeg;base64,' . base64_encode( $photo ) . '" />';
}