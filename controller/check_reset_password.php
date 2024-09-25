<?php
require_once 'validations.php';
require_once 'src/DB_Actions/Users.php';
$password = $_POST['password'];
$email = $_SESSION['email'];
$validate = new Validation();
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
if(!empty($errors))
{
    $_SESSION['errors'] = $errors;
}
else
{
    $db = new DataBase();
    $conn = $db->getConnection();
    $user = new Users($conn);
    $res = $user->update_password($email,$password);
    if($res)
    {
        $_SESSION['reset'] = "success";
    }
}
redirect("reset-password");

