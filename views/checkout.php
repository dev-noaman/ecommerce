<?php require_once 'src/DB_Actions/Cart.php';?>

<?php 
$db = new DataBase();
$conn = $db->getConnection();
$checkout = new Cart($conn);
 $res = $checkout->readAll(); 
 if(mysqli_num_rows($res)==0){redirect("login");}
 ?>

<?php require_once Root_Path . 'inc/header.php';?>
<?php require_once Root_Path . 'inc/nav.php';?>


 
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href=<?php echo url("index");?>>home</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    
    <!--breadcrumbs area end-->

    <!--Checkout page section-->
    <div class="Checkout_section mt-60">
        <div class="container">
         
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                    <form action="<?php echo url('check-checkout'); ?>" method="post">
    <div class="row">
        <!-- Billing Details Section -->
        <div class="col-lg-6 col-md-6" style="padding-right: 20px;">
            <h3>Billing Details</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 mb-20">
                    <label>Name<span>*</span></label>
                    <input type="text" name="name" style="width: 100%;">
                    <span class="text-danger"><?php echo $_SESSION['errors']['name'] ??'';?></span>
                </div>

                <div class="col-lg-12 col-md-12 col-12 mb-20">
                    <label for="country">Country <span>*</span></label>
                    <select class="niceselect_option" name="country" id="country" style="width: 100%;">
                        <option value="2">Egypt</option>
                        <option value="3">Algeria</option>
                        <option value="4">Palestine</option>
                        <option value="5">Sudan</option>
                        <option value="6">Syria</option>
                    </select>
                    <span class="text-danger"><?php echo $_SESSION['errors']['country']??'';?></span>
                </div>

                <div class="col-lg-12 col-md-12 col-12 mb-20">
                    <label>Street Address <span>*</span></label>
                    <input placeholder="House number and street name" type="text" name="address" style="width: 100%;">
                    <span class="text-danger"><?php echo $_SESSION['errors']['address'] ?? '';?></span>
                </div>

                <div class="col-lg-12 col-md-12 col-12 mb-20">
                    <label>Town / City <span>*</span></label>
                    <input type="text" name="city" style="width: 100%;">
                    <span class="text-danger"> <?php echo $_SESSION['errors']['city']??'';?></span>
                </div>

                <div class="col-lg-12 col-md-12 col-12 mb-20">
                    <label>Phone<span>*</span></label>
                    <input type="text" name="phone" style="width: 100%;">
                    <span class="text-danger"><?php echo $_SESSION['errors']['phone']??'';?></span>
                </div>
            </div>
        </div>

        <!-- Order Details Section -->
        <div class="col-lg-6 col-md-6" style="padding-left: 20px;">
            <h3>Your Order</h3>
            <div class="order_table table-responsive">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php while ($row = mysqli_fetch_assoc($res)): ?>
                            <?php $product_names[] = $row['products'];?>
                            <tr>
                                <td><?php echo $row['products']; ?></td>
                                <td>$<?php echo $row['price']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cart Subtotal</th>
                            <td>$<?php echo sum_price('cart'); ?></td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td><strong>$30.00</strong></td>
                        </tr>
                        <tr class="order_total">
                            <th>Order Total</th>
                            <?php $subtotal = $_SESSION['total'] + 30; ?>
                            <td><strong>$<?php echo $subtotal . '.00'; ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <input type="hidden" name="products" value="<?php echo implode(', ', $product_names); ?>">

            <!-- Submit Button -->
            <div class="order_button" style="text-align: center; margin-top: 20px;">
                <button type="submit" style="width: 100%; padding: 10px 0;">Proceed to Buy</button>
            </div>
        </div>
    </div>
</form>
       
                    </div>
                </div> 
            </div> 
        </div>       
    </div>
    <!--Checkout page section end-->
    <?php unset($_SESSION['errors']);?>
    <!--footer area start-->
    <?php require_once Root_Path . 'inc/footer.php';?>
    <!--footer area end-->
