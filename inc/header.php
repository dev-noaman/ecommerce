<!doctype html>
<html class="no-js" lang="en">
<?php
$config = require_once 'src/config.php';
require_once Root_Path . 'src/DB_Actions/Products.php';
require_once Root_Path . 'src/DB_Actions/Cart.php';
 $db = new DataBase();
 $conn = $db->getConnection();
$product = new Product($conn);
$cart = new Cart($conn);
?>
<!--   03:20:39 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Drophut - Single Product eCommerce Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    
    <!-- CSS 
    ========================= -->
   

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">

</head>

<body>

    <!--header area start-->
    <!--Offcanvas menu area start-->
    <div class="off_canvars_overlay">
            
    </div>
    <div class="Offcanvas_menu">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="canvas_open">
                        <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                    </div>
                    <div class="Offcanvas_menu_wrapper">
                        <div class="canvas_close">
                              <a href="javascript:void(0)"><i class="ion-android-close"></i></a>  
                        </div>
                        <div class="support_info">
                            <p>Any Enquiry: <a href="tel:">+56985475235</a></p>
                        </div>
                        <div class="top_right text-right">
                            <ul>
                               <li><a href="my-account.html"> My Account </a></li> 
                               <li><a href="checkout.html"> Checkout </a></li> 
                            </ul>
                        </div> 
               
                        
                        <div class="middel_right_info">
                            <div class="header_wishlist">
                                <a href="wishlist.html"><img src="assets/img/user.png" alt=""></a>
                            </div>
                            <div class="mini_cart_wrapper">
                                <a href="javascript:void(0)"><img src="assets/img/shopping-bag.png" alt=""></a>
                                <span class="cart_quantity">2</span>
                                <!--mini cart-->
                                 <div class="mini_cart">
                                    <div class="cart_item">
                                       <div class="cart_img">
                                           <a href="#"><img src="assets/img/s-product/product.jpg" alt=""></a>
                                       </div>
                                        <div class="cart_info">
                                            <a href="#">Sit voluptatem rhoncus sem lectus</a>
                                            <p>Qty: 1 X <span> $60.00 </span></p>    
                                        </div>
                                        <div class="cart_remove">
                                            <a href="#"><i class="ion-android-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="cart_item">
                                       <div class="cart_img">
                                           <a href="#"><img src="assets/img/s-product/product2.jpg" alt=""></a>
                                       </div>
                                        <div class="cart_info">
                                            <a href="#">Natus erro at congue massa commodo</a>
                                            <p>Qty: 1 X <span> $60.00 </span></p>   
                                        </div>
                                        <div class="cart_remove">
                                            <a href="#"><i class="ion-android-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="mini_cart_table">
                                        <div class="cart_total">
                                            <span>Sub total:</span>
                                            <span class="price">$138.00</span>
                                        </div>
                                        <div class="cart_total mt-10">
                                            <span>total:</span>
                                            <span class="price">$138.00</span>
                                        </div>
                                    </div>

                                    <div class="mini_cart_footer">
                                       <div class="cart_button">
                                            <a href="cart.html">View cart</a>
                                        </div>
                                        <div class="cart_button">
                                            <a href="checkout.html">Checkout</a>
                                        </div>

                                    </div>

                                </div>
                                <!--mini cart end-->
                            </div>
                        </div>
                        <div id="menu" class="text-left ">
                            <ul class="offcanvas_main_menu">
                                <li class="menu-item-has-children active">
                                    <a href=<?php echo url("index");?>>Home</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="product-details.html">product</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">pages </a>
                                    <ul class="sub-menu">
                                        <li><a href=<?php echo url("about");?>>About Us</a></li>
										<li><a href="contact.html">contact</a></li>
										<li><a href="privacy-policy.html">privacy policy</a></li>
										<li><a href="faq.html">Frequently Questions</a></li>
										<li><a href="login.html">login</a></li>
										<li><a href="register.html">register</a></li>
										<li><a href="forget-password.html">Forget Password</a></li>
										<li><a href="404.html">Error 404</a></li>
										<li><a href="cart.html">cart</a></li>
										<li><a href="tracking.html">tracking</a></li>
										<li><a href="checkout.html">checkout</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">blog</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog.html">blog</a></li>
                                        <li><a href="blog-details.html">blog details</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="login.html">my account</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="contact.html"> Contact Us</a> 
                                </li>
                            </ul>
                        </div>

                        <div class="Offcanvas_footer">
                            <span><a href="#"><i class="fa fa-envelope-o"></i> info@drophunt.com</a></span>
                            <ul>
                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="pinterest"><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Offcanvas menu area end-->
    
    <header>
        <div class="main_header">
            <!--header top start-->
            <div class="header_top">
                <div class="container">  
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="support_info">
                                <p>Email: <a href="mailto:">support@drophunt.com</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="top_right text-right">
                                <ul>
                                   <li><a href="my-account.html">Account</a></li> 
                                   <li><a href="checkout.html">Checkout</a></li> 
                                </ul>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
            <!--header top start-->
            <!--header middel start-->
            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="logo">
                                <a href="index-2.html"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-6">
                            <div class="middel_right">
                            <div class="search_container">
                           <form method = "GET" action="route.php">
                                <div class="search_box">
                                <input type="hidden" name="page" value="index">
                                    <input name = "search_query" placeholder="Search product..." type="text" value="<?php echo isset($_GET['search_query'])?$_GET['search_query'] : '';?>">
                                    <button type="submit">Search</button> 
                                </div>
                            </form>
                            <?php if(isset($_GET['search_query'])):?>
                                <?php 
                                $search_query = mysqli_real_escape_string($conn,$_GET['search_query']);
                                $sql = "SELECT * FROM `products` WHERE `name` LIKE '%$search_query%'";
                                $search_res = mysqli_query($conn,$sql);?>
                                <div class="search_results">
                                   <h3>Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h3>
                                   <?php if (mysqli_num_rows($search_res) > 0): ?>
                         <ul class="result_list">
                            <?php while ($row = mysqli_fetch_assoc($search_res)): ?>
                                <li class="result_item">
                                   <div class="result_thumb">
                                   <img src="<?php echo Base_Url . "public/images/products/" . $row['image']; ?> " alt="" width = "200" height= "150">
                                   </div>
                                   <div class="result_info">
                                      <h4><a href="<?php echo url('product-details&id=' . $row['id']); ?>"><?php echo $row['name']; ?></a></h4>
                                      
                                    </div>
                                </li>
                             <?php endwhile; ?>
                        </ul>
                             <?php else: ?>
                                 <p>No results found for "<?php echo htmlspecialchars($search_query); ?>"</p>
                            <?php endif; ?>
        </div>
                             <?php endif; ?>
                        </div> 
                                <div class="middel_right_info">
                                <?php if (isset($_SESSION['auth']['name'])): ?>
    <div class="user-info d-flex align-items-center justify-content-center">
        <img src="assets/img/user.png" alt="Profile Picture" class="img-fluid rounded-circle" >
        <h4 style="color: white; margin-right: 10px;">
    <?php echo htmlspecialchars($_SESSION['auth']['name']); ?>
        </h4>
        <a href=<?php echo url("logout");?> class="btn btn-danger">Logout</a>
    </div>
<?php else: ?>
    <div class="header_wishlist text-center">
        <a href="<?php echo url('login'); ?>" class="btn btn-primary">
            <img src="assets/img/user.png" alt="User Icon" class="img-fluid" style="width: 30px; height: auto;">
            Login
        </a>
    </div>
<?php endif; ?>    

              <div class="mini_cart_wrapper">
                                        <?php $cart_res = $cart->readAll();?>
                                        <?php $cart_num = mysqli_num_rows($cart_res);?>

                                        <a href="javascript:void(0)"><img src="assets/img/shopping-bag.png" alt=""></a>
                                        <span class="cart_quantity"><?php echo $cart_num;?></span>
                                        <!--mini cart-->
                                         <div class="mini_cart">
                                            <?php while($cart_row = mysqli_fetch_assoc($cart_res)):?>
                                            <div class="cart_item">
                                               <div class="cart_img">
                                                   <img src=<?php echo Base_Url . "public/images/products/" . $cart_row['image'];?> alt=""></a>
                                               </div>
                                                <div class="cart_info">
                                                    <?php echo $cart_row['products'];?></a>
                                                    <p>Qty: 1 X <span> $<?php echo $cart_row['price'];?> </span></p>    
                                                </div>
                                                <div class="cart_remove">
                                                    <a href=<?php echo url("cart-remove&id=").$cart_row['id'];?>><i class="ion-android-close"></i></a>
                                                </div>
                                            </div>
                                            <?php endwhile;?>
                                            
                                          

                                            <div class="mini_cart_footer">
                                               <div class="cart_button">
                                                    <a href=<?php echo url("cart");?>>View cart</a>
                                                </div>
                                                <div class="cart_button">
                                                    <a href=<?php echo url("checkout");?>>Checkout</a>
                                                </div>

                                            </div>

                                        </div>
                                        <!--mini cart end-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>