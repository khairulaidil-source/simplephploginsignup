<?php
include "db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['csrf_token'],$_POST['csrf_token'])) {
    header("Location: ../index.php",TRUE,301);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stored_password = $user['password'];
        if (password_verify($password, $stored_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: ../dashboard.php",TRUE,301);
        } else {
            header("Location: ../index.php",TRUE,301);
        }
    } else {
        header("Location: ../index.php",TRUE,301);
    }

    $stmt->close();
}

?>