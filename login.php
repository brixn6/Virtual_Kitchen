<?php
session_start();
include 'db.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = mysqli_real_escape_string($connect, $_POST['username_or_email']);
    $password = $_POST['password'];

    
    $query = "SELECT * FROM users WHERE username = '$input' OR email = '$input'";
    $result = mysqli_query($connect, $query);

    
    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['uid'];
            
            
            $redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
            header("Location: $redirectUrl");
            exit();
        } else {
            
            $_SESSION['login_error'] = "Incorrect password.";
        }
    } else {
        
        $_SESSION['login_error'] = "User not found.";
    }

    
    $redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    header("Location: $redirectUrl");
    exit();
}
?>
