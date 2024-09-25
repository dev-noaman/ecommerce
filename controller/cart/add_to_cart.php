<?php

require_once 'src/DB_Actions/Cart.php';
if(!isset($_SESSION['auth']))
{
    redirect("login");
}
$db = new DataBase();
$conn = $db->getConnection();
$cart = new Cart($conn);
$id = $_GET['id'];
$products = getrow("products",$id);
$cart->user_id = $_SESSION['auth']['id'];
$cart->product = $products['name'];
$cart->price = $products['price'];
$cart->image = $products['image'];
$res = $cart->create();
if($res)
{
    $_SESSION['cart_status'] = "added";
}
$cart_item = [
    "name"=>$products['name'],
    "price"=>$products['price']
];
//to ensure session is converted to array
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];  // Ensure it's an array
}
array_push($_SESSION['cart'],$cart_item);



redirect("product-details");

