<?php
session_start();

if (!empty($_REQUEST['title']) && !empty($_REQUEST['content'])) {
    require_once('../../classes.php');
    $user = unserialize($_SESSION['user']);



    if ($_FILES['image']['name']) {
        $image = "../images/posts/" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        $image = null;
    }




    Subscriber::storePost($_REQUEST['title'], $_REQUEST['content'], $image, $user->id);
    header("location:profile.php?msg=Post_created_successfully");
} else {
    header("location:profile.php?msg=Please_fill_all_the_fields");
}
