<?php
session_start();

session_destroy();


$redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
header("Location: $redirectUrl");
exit();
?>
