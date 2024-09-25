<?php
require_once 'src/DB_Actions/Cart.php';
$db = new DataBase();
$conn = $db->getConnection();
$cart = new Cart($conn);
$id = $_GET['id'];
$res = $cart->delete($id);
if($res)
{
    $_SESSION['cart_status'] = "deleted";
}
redirect("cart");