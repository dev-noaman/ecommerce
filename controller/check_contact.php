<?php

require_once 'validations.php';
require_once 'src/DB_Actions/Users.php';
require_once 'src/DB_Actions/Contact.php';
$db = new DataBase();
$conn = $db->getConnection();
$user = new Users($conn);
$validate = new Validation();
if($_SERVER['REQUEST_METHOD']=="POST")
{
 $name = $validate->sanitize($_POST['name']);
 $email = $validate->sanitize($_POST['email']);
 $message = $validate->sanitize($_POST['message']);
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

 $res = $user->check($email);
 if(mysqli_num_rows($res)==0)
 {
    $errors['email'] = "Email does not exists";
 }
//message validate
if($validate->check_empty($message))
{
   $errors["message"] = "Message is required";
}
elseif($validate->minlen($message,6))
{
   $errors['message'] = "Message must be longer than 6 characters";
}
elseif($validate->maxlen($message,500))
{
   $errors['message'] = "Message must be smaller that 500 characters";
}

if(!isset($_SESSION['auth']))
{
    $errors['message'] = "You must login first ";


}
if(!empty($errors))
{
    $_SESSION['errors'] = $errors;
}
else{
$contact = new Contact($conn);
$contact->name = $name;
$contact->email = $email;
$contact->message = $message;
$contact->user_id = $_SESSION['auth']['id'];
$res = $contact->create();
if($res)
{
    $_SESSION['contact'] = "success";
}
}
redirect("contact");

}