<?php 
session_start();
if (!empty($_REQUEST['email']) && !empty($_REQUEST['password'])) {
    // 
    require_once('classes.php');
    $user = User::login($_REQUEST['email'],md5($_REQUEST['password']) );
    if (!empty($user)) {
         // serialize user object to store in session cant store object serialize it to string to store in session
        $_SESSION['user'] = serialize($user);
        if ($user->role == 'admin') {
            header('Location: frontend/admin/home.php');
            
        } else if ($user->role == 'subscriber') {
            header('Location: frontend/subscriber/home.php');
        }
    } else {
        $_SESSION['error'] = "Invalid email or password";
        header('Location: login.php');
        
    }
}else{
    $_SESSION['error'] = "Please fill all fields";
    header('Location: login.php');
    
}
?>