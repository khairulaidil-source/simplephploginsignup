<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['csrf_token'],$_POST['csrf_token'])) {
    header("Location: ../index.php",TRUE,301);
    exit;
}
session_destroy();
header("Location: ../index.php",TRUE,301);
exit;
?>