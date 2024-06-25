<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'projekt';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Nie można połączyć się z serwerem MySQL: ' . mysqli_error());
}

?>
