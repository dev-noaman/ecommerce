<?php require_once Root_Path . 'inc/header.php';?>
<?php require_once Root_Path . 'inc/nav.php';?>
<?php require_once 'src/DB_Actions/Cart.php';?>
<?php 
$db = new DataBase();
$conn = $db->getConnection();
$cart = new Cart($conn);
$sale = 0;
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['coupon_code']))
{
    if($_POST['coupon_code'] == "EraaSoft")
    {
        $sale = 20 / 100;
        $_POST['coupon_code'] = "saled";
    }
}

 ?>


    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href=<?php echo url("index");?>>home</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <?php $cart_res = $cart->readAll();?>
    <?php if(mysqli_num_rows($cart_res) == 0):?>
    <span class="text-success" style="font-size: 40px; font-weight: bold; display: block; text-align: center; line-height: 1.5; padding: 10px;">
    <div class="text-center">
       Cart Is Empty
       
    </div>
  </span>
  <?php die();?>
<?php else:?>
    <!--breadcrumbs area end-->

    <!--shopping cart area start -->
    <div class="shopping_cart_area mt-60">
        <div class="container">  
            
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <?php if(isset($_SESSION['cart_status']) && $_SESSION['cart_status'] == "deleted"):?>
                                    <span class="text-danger" style="font-size: 40px; font-weight: bold; display: block; text-align: center; line-height: 1.5; padding: 10px;">
                                      <div class="text-center">
                                         Product Deleted
                                      </div>
                                    </span>
                                <?php endif;?>
                                <table>
                            <thead>
                                <tr>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product_remove">Remove</th>
                                </tr>
                            </thead>
                            <?php $total = 0;?>
                            <tbody>
                                <?php while($cart_row = mysqli_fetch_assoc($cart_res)):?>
                                <tr>
                                    <td class="product_thumb"> <img src=<?php echo Base_Url . "public/images/products/" . $cart_row['image'];?> alt=""></td>
                                    <td class="product_name"><?php echo $cart_row['products'];?></td>
                                    <td class="product-price">$<?php echo $cart_row['price'];?></td>
									<td class="product_remove"><a href=<?php echo url("cart-remove&id=").$cart_row['id'];?>><i class="ion-android-close"></i></a></td>
                                </tr>
                                <?php $total += $cart_row['price'];?>
                                <?php endwhile;?>

                              

                            </tbody>
                        </table>   
                            </div>  
                                 
                        </div>
                    </div>
                </div>
                <!--coupon code area start-->
                <?php if(!isset($_POST['coupon_code'])):?>
                <div class="coupon_area">
                    <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="coupon_code left">
                       <h3>Coupon</h3>
                       <div class="coupon_inner">
                         <p>Enter your coupon code if you have one.</p>
                         <form method="post" action="<?php echo url('cart'); ?>"> <!-- POST request to cart page -->
                           <input name="coupon_code" placeholder="Coupon code" type="text" required>
                           <button type="submit">Apply coupon</button>
                         </form>
                    </div>
                </div>
                <?php endif;?>
</div>

                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>Cart Totals</h3>
                                <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Subtotal</p>
                                    <?php $total = sum_price("cart");?>
                                    <p class="cart_amount">$<?php echo $total*=(1-$sale);?></p>
                                </div>
                                <div class="cart_subtotal ">
                                    <p>Shipping</p>
                                    <p class="cart_amount"><span>Flat Rate:</span> $30</p>
                                </div>
                                <a href="#">Calculate shipping</a>

                                <div class="cart_subtotal">
                                    <p>Total</p>
                                    <p class="cart_amount">$<?php echo $total + 30;?></p>
                                    <?php $_SESSION['total'] = $total;?>
                                </div>
                                <div class="checkout_btn">
                                    <a href=<?php echo url("checkout");?>>Proceed to Checkout</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area end-->
            </form> 
        </div>     
    </div>
    <!--shopping cart area end -->
        <?php unset($_SESSION['cart_status']);?>
<?php endif;?>
    <!--footer area start-->
    <?php require_once Root_Path . 'inc/footer.php';?>
