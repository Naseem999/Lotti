<?php
session_start();
if (isset($_SESSION['admin_username'])) {
    session_unset();
    session_destroy();
    header("Location:../index.php?logout=You are logged out");
    exit();
}
