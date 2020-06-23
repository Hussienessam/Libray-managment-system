<?php 
	session_start();
	unset($_COOKIE['name']);
    unset($_COOKIE['role']);
    unset($_SESSION['name']);
    unset($_SESSION['role']);
    unset($_SESSION['email']);
    header("location: ../Home (Admin)/HomeAdmin.php");
    exit();
 ?>