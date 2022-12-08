<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'products';
$conn= mysqli_connect($servername, $username, $password, $dbname);
//$conn= mysqli_connect($, $username, $password, $dbname);
if(!$conn) echo 'connect db failed';
?>