<?php
require_once 'src/DB_Actions/Users.php';
$email = $_POST['email'];
$password = $_POST['password'];
$db = new DataBase();
$conn = $db->getConnection();
$sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
if($row)
{
    $name = $row['username'];
    $_SESSION['login'] = "found";
    $_SESSION['auth'] = [
        "id" => $row['id'],
        "name" => $row['username'],
        "email" => $row['email']
    ];
}
else{
    $_SESSION['login'] = "not found";
}
redirect("login");