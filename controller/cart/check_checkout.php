<?php
require_once 'src/DB_Actions/Orders.php';
require_once 'src/DB_Actions/Order_Product.php';
require_once 'controller/validations.php';

$db = new DataBase();
$conn = $db->getConnection();
$order = new Order($conn);
$op = new Order_Product($conn);
$validate = new Validation();
if($_SERVER['REQUEST_METHOD']=="POST")
{
 $name = $validate->sanitize($_POST['name']);
 $country = $validate->sanitize($_POST['country']);
 $address = $validate->sanitize($_POST['address']);
 $city = $validate->sanitize($_POST['city']);
 $phone = $validate->sanitize($_POST['phone']);

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
    $errors['name'] = "Name must be smaller than 20 characters";
 }
 //country validation
 if($validate->check_empty($country))
 {
    $errors['country'] = "country is required";
 }
//address validation
if($validate->check_empty($address))
{
   $errors['address'] = "address is required";
}
elseif($validate->minlen($address,15))
{
   $errors['address'] = "address must be longer than 15 characters";
}
elseif($validate->maxlen($address,300))
{
   $errors['address'] = "address must be smaller than 300 characters";
}
//city validation
if($validate->check_empty($city))
{
   $errors['city'] = "city is required";
}
elseif($validate->minlen($city,3))
{
   $errors['city'] = "city must be longer than 3 characters";
}
elseif($validate->maxlen($city,20))
{
   $errors['city'] = "city must be smaller than 20 characters";
}
//phone validation
if($validate->check_empty($phone))
{
   $errors['phone'] = "phone is required";
}
elseif($validate->minlen($phone,3))
{
   $errors['phone'] = "phone must be longer than 4 characters";
}
elseif($validate->maxlen($phone,20))
{
   $errors['phone'] = "phone must be smaller than 15 characters";
}
}
if(!empty($errors))
{
    $_SESSION['errors'] = $errors;
 
    redirect("checkout");
}
else
{
    $order->name = $name;
    $order->country = $country;
    $order->address = $address;
    $order->city = $city;
    $order->phone = $phone;
    $order->user_id = $_SESSION['auth']['id'];
    $order->total_price = $_SESSION['total'];
    $res = $order->create();
    unset($_SESSION['total']);
    $_SESSION['order_id'] = mysqli_insert_id($conn);
    if($res)
    {
       
        $products = explode(",",$_POST["products"]);
        $_SESSION['product'] = [];
        foreach($products as $product)
        {
          $_SESSION['product'][] = $product;
        }
        redirect("save-order");
    }

}