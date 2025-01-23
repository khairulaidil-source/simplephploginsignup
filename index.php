<?php
session_start();
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php",TRUE,301);
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>FindJOB | Login</title>
    </head>
    <body>
        <h1>FindJOB</h1>
        <h3>Login</h3>
        <form method="POST" action="process/loginprocess.php">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <label>Username : </label>
            <input id="username" name="username" placeholder="Username" type="text" required>
            <br>
            <label>Password : </label>
            <input id="password" name="password" placeholder="Password" type="password" required>
            <br>
            <button type="submit">Login</button>
            <a href="signup.php"><button type="button">Signup</button></a>
        </form>
    </body>
</html>