<?php

require_once 'validations.php';
require_once 'src/DB_Actions/Users.php';
$db = new DataBase();
$conn = $db->getConnection();
$user = new Users($conn);
$validate = new Validation();
if($_SERVER['REQUEST_METHOD']=="POST")
{
 $name = $validate->sanitize($_POST['name']);
 $email = $validate->sanitize($_POST['email']);
 $password = $validate->sanitize($_POST['password']);
 //name validation
 if($validate->check_empty($name))
 {
    $errors['name'] = "Name is required";
 }
 elseif($validate->minlen($name,3))
 {
    $errors['name'] = "Name must be longer than 3 characters";
 }
 elseif($validate->maxlen($name,20))
 {
    $errors['name'] = "Name must be smaller that 20 characters";
 }
 //email validation
 if($validate->check_empty($email))
 {
    $errors["email"] = "Email is required";
 }
 elseif($validate->minlen($email,6))
 {
    $errors['email'] = "Email must be longer than 6 characters";
 }
 elseif($validate->maxlen($email,40))
 {
    $errors['email'] = "Email must be smaller that 40 characters";
 }
 $res = $user->check($email);
 if(mysqli_num_rows($res)>=1)
 {
    $errors['email'] = "Email already exists";
 }
 //password validation
 if($validate->check_empty($password))
 {
    $errors['password'] = "Password is required";
 }
 elseif($validate->minlen($password,5))
 {
    $errors['password'] = "Password must be longer than 5 characters";
 }
 elseif($validate->maxlen($password,20))
 {
    $errors['password'] = "Password must be smaller that 20 characters";
 }
 //checkbox validation
 if(!isset($_POST['checkbox']))
 {
    $errors['checkbox'] = "You must confirm you are not a robot";
 }
 if(!empty($errors))
 {
    $_SESSION['errors'] = $errors;
 }
 else{
    $user->name = $name;
    $user->email = $email;
    $user->password = $password;
    $user_res = $user->create();
    if($user_res)
    {
        $_SESSION['auth']=[
            "name"=>$name,
            "email"=>$email
        ];
        $_SESSION['register'] = "Registred Successfully";
    }
 }
 redirect("register");
}


