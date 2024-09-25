<?php
require_once 'src/DB_Actions/Users.php';
$email = $_POST['email'];
$db = new DataBase();
$conn = $db->getConnection();
$user = new Users($conn);
$res = $user->check($email);
if(mysqli_num_rows($res)==0)
{
 $errors['email'] = "Email does not exist";
 $_SESSION['errors'] = $errors;
 redirect("forget-password");
}
else
{
   $_SESSION['email'] = $email;
   redirect("reset-password");
}