<?php 
session_start();

$_SESSION = [];
session_unset();
session_destroy();

header("Location: ../user/tampilan2.php");



?>