<?php
session_start();
$errors = [];
if (empty($_REQUEST["name"]))
    $errors["name"] = "Name is required";
if (empty($_REQUEST["email"]))
    $errors["email"] = "Email is required";
if (empty($_REQUEST["password"]))
    $errors["password"] = "Password is required";
else if ($_REQUEST["password"] != $_REQUEST["confirmpassword"])
    $errors["confirmpassword"] = "Passwords do not match";


$name = htmlspecialchars(trim($_REQUEST["name"]));
$email = filter_var(trim($_REQUEST["email"]), FILTER_SANITIZE_EMAIL);
$password = htmlspecialchars(trim($_REQUEST["password"]));
$phone = htmlspecialchars(trim($_REQUEST["phone"]));


if (!empty($_REQUEST["email"]) && !$email)
    $errors["email"] = "Invalid email";


if (empty($errors)) {
    require_once("classes.php");
    try {
        $result = Subscriber::register($name,$email,md5($password),$phone);
         header("location:registar.php?msg=success");
       
    } catch (\Throwable $th) {
        header("location:registar.php?msg=error");
    }
   
}
else {
    $_SESSION["errors"] = $errors;
    header("Location: registar.php");
}
?>