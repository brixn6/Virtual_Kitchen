<?php
$servername = "localhost";
$username = "u-240202378";
$password = "zS5RlFFCnmxgMca";
$dbname = "u_240202378_virtual_kitchen";

$connect = new mysqli($servername, $username, $password, $dbname);

if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
?>
