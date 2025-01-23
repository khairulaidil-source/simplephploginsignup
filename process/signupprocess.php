<?php
include "db.php";

session_start();
if($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['csrf_token'],$_POST['csrf_token'])) {
    header("Location: ../index.php",TRUE,301);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']),PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username,password) VALUES (?,?)");
    $stmt->bind_param("ss",$username,$password);

    if ($stmt->execute()) {
        header("Location: ../index.php",TRUE,301);
    } else {
        header("Location: ../index.php",TRUE,301);
    }

    $stmt->close();
}
?>