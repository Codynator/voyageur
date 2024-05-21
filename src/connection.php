<?php
function connect() {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'voyageur';
    
    return new mysqli($servername, $username, $password, $dbname);
}
