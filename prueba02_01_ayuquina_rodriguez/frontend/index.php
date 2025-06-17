<?php
session_start();

if (isset($_SESSION['token'])) {
    header('Location: routes/profile.php');
} else {
    header('Location: routes/login.php');
}
exit;
