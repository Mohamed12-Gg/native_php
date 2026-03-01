<?php
session_start();
require_once('../../classes.php');
$user = unserialize($_SESSION['user']);
if (!empty($_FILES['profile_image'])) {
    $image = "../images/users/" . $_FILES['profile_image']['name'];
    move_uploaded_file($_FILES['profile_image']['tmp_name'], $image);
    $user->update_profile_image($user->id, $image);
    $user->image = $image;
    $_SESSION['user'] = serialize($user); 
    header("location:profile.php?msg=Profile_image_updated_successfully");
} else {
    header("location:profile.php?msg=Please_select_an_image");
}
?>