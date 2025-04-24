<div id="header" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #f1f1f1;">
    <div id="logo" style="font-size: 24px; font-family: Arial, Helvetica, sans-serif; color: rgb(148, 187, 116);">
    <a href="index.php" style="text-decoration: none; color: rgb(148, 187, 116); font-family: Arial, Helvetica, sans-serif; font-size: 24px;">
        Virtual Kitchen
    </a>
    </div>
    <div style="position: absolute; top: 10px; right: 10px;">
        <?php if (isset($_SESSION['username'])): ?>
            <span>Welcome, <?php echo $_SESSION['username']; ?>!</span>
            <form action="logout.php" method="post" style="display:inline;">
                <input type="submit" value="Logout">
            </form>
        <?php else: ?>
            <form action="login.php" method="post" style="display: inline;">
                <input type="text" name="username_or_email" placeholder="Email or Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
       		<form action="register.php" method="get" style="display: inline;">
    		<input type="submit" value="Register" class="register-btn">
			</form>
        <?php endif; ?>
    </div>
</div>
<hr style="border: 1px solid rgb(148, 187, 116);">

<head>
<link rel="icon" href="images/favicon.ico" type="image/ico">
</head>
