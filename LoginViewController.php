<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if (!isset($_SESSION['email'])) {
    $user=$_SESSION['email'];
    header('Location: goal.php');
    exit();
}
echo 'You have successfully logged as '.$user
?>