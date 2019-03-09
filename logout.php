<?php
session_start();
session_destroy();
unset($_SESSION['logged']);
unset($_SESSION['roll']);
unset($_SESSION['username']);
header("Location:index.php");
?>