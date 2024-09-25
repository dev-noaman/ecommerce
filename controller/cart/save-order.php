<?php
require_once 'src/DB_Actions/Orders.php';
require_once 'src/DB_Actions/Order_Product.php';
require_once 'src/DB_Actions/Cart.php';
$db = new DataBase();
$conn = $db->getConnection();
$op = new Order_Product($conn);
$order = new Order($conn);
$cart = new Cart($conn);
$last_id = ($_SESSION['order_id']);
foreach(($_SESSION['product']) as $product)
{
    $op->order_id = $last_id;
    $op->product_name = $product;
    $op->user_id = $_SESSION["auth"]["id"];
    $op->create();
}
$cart->delete_all();
redirect("tracking");