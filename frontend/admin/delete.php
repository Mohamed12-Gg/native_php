<?php

session_start();
require_once("../../classes.php");
$user = unserialize($_SESSION['user']);
$user->delete($_GET['id']);
header("Location: home.php?msg=User deleted successfully");
?>