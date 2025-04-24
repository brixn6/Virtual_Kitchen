<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $check = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Username already taken.";
    } else {
        $insert = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
        if (mysqli_query($connect, $insert)) {
            $success = "Registered successfully. <a href='index.php'>Login</a>";
        } else {
            $error = "Error: " . mysqli_error($connect);
        }
    }
}
?>


<div class="form-container">
<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f5f5f5;">
    <div style="background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; min-width: 500px;">
<h2>Register</h2>
<form method="post" action="register.php">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="submit" value="Register">
</form>
<div>
<div>
<div>
<button onclick="history.back()" class="styled-button">Back</button>
<?php if (!empty($error)): ?>
    <div style="text-align: center; color: red; margin-top: 20px;">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div style="text-align: center; color: green; margin-top: 20px;">
        <?php echo $success; ?>
    </div>
<?php endif; ?>


<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Virtual Kitchen</title>
    <link rel="icon" href="images/favicon.ico?v=2" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" />
    <script defer src="js/basic.js"></script>