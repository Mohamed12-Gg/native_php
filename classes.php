<?php

abstract class User
{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $image;
    public $role;
    protected $password;
    public $created_at;
    public $updated_at;


    function __construct($id, $name, $email, $password, $phone, $image, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->image = $image;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function login($email, $password)
    {
        $qury = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        require_once('config.php');
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $result = mysqli_query($cn, $qury);
        if ($arr = mysqli_fetch_assoc($result)) {
            switch ($arr['role']) {
                case 'subscriber':
                    $user = new Subscriber($arr['id'], $arr['name'], $arr['email'], $arr['password'], $arr['phone'], $arr['image'], $arr['created_at'], $arr['updated_at']);
                    break;
                case 'admin':
                    $user = new Admin($arr['id'], $arr['name'], $arr['email'], $arr['password'], $arr['phone'], $arr['image'], $arr['created_at'], $arr['updated_at']);
                    break;
            }
        }

        mysqli_close($cn);
        return $user;
    }
    public static function register($name, $email, $password, $phone) {}
}
class Subscriber extends User
{
    public $role = "subscriber";

    public static function register($name, $email, $password, $phone)
    {
        $qury = "INSERT INTO users (name,email,password,phone) 
        VALUES ('$name','$email','$password','$phone')";
        require_once('config.php');
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $result = mysqli_query($cn, $qury);
        mysqli_close($cn);
        return $result;
    }
    public static function my_post($user_id)
    {
        $qury = "SELECT * FROM posts WHERE user_id = $user_id order by created_at desc";
        require_once('config.php');
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $result = mysqli_query($cn, $qury);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($cn);
        return $data;
    }
    public static function update_profile_image($user_id, $image)
    {
        $qury = "UPDATE users SET image = '$image' WHERE id = '$user_id'";
        require_once('config.php');
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $result = mysqli_query($cn, $qury);
        mysqli_close($cn);
        return $result;
    }


    public static function storePost($title, $content, $image, $user_id)
    {
        $qury = "INSERT INTO posts (title,content,image,user_id) 
        VALUES ('$title','$content','$image','$user_id')";
        require_once('config.php');
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $result = mysqli_query($cn, $qury);
        mysqli_close($cn);
        return $result;
    }
    public static function store_comment($comment, $post_id, $user_id)
    {
        $qury = "INSERT INTO comments (comment,post_id,user_id) 
        VALUES ('$comment','$post_id','$user_id')";
        require_once('config.php');
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $result = mysqli_query($cn, $qury);
        mysqli_close($cn);
        return $result;
    }
    public static function get_post_comments($post_id)
    {
        $qury = "SELECT * FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = $post_id order by comments.created_at desc";
        require_once('config.php');
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $result = mysqli_query($cn, $qury);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($cn);
        return $data;
    }
}
class Admin extends User
{

    public $role = "admin";
    function getAllUsers(){
        $qury = "SELECT * FROM users ORDER BY created_at ";
        require_once('config.php');
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $result = mysqli_query($cn, $qury);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($cn);
        return $data;
    }
    function delete($user_id){
        $qury = "DELETE FROM users WHERE id = $user_id";
        require_once('config.php');
        $cn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $result = mysqli_query($cn, $qury);
        mysqli_close($cn);
        return $result;
    }
}
