<?php
session_start();
session_regenerate_id();
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) {
    header("Location: index.php",TRUE,301);
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>FindJOB | Dashboard</title>
    </head>
    <body>
        <h1>FindJOB</h1>
        <h3>Dashboard | Welcome <?php echo $_SESSION['username'];?></h3>
        <form method="POST" action="process/logoutprocess.php">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
            <button type="submit">Logout</button>
        </form>
    </body>
</html>

