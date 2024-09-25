<?php require_once Root_Path . 'inc/header.php';?>
<?php require_once Root_Path . 'inc/nav.php';?>
<?php require_once Root_Path.'src/DB_Actions/Products.php';?>

<?php $product = new Product($conn);?>

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index-2.html">home</a></li>
                            <li>Product details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->
    <?php
    //id recognize from url or choose a random product
    if(isset($_GET['id'])){$id = $_GET['id'];}
    else{ $id = rand(1,6);}
    ?>
    <?php if(isset($_SESSION['cart']) && $_SESSION['cart'] == "added"):?>
         <span class="text-success" style="font-size: 40px; font-weight: bold; display: block; text-align: center; line-height: 1.5; padding: 10px;">
             <div class="text-center">
                 Product Added
             </div> 
         </span>
    <?php endif;?>
    <!--product details start-->
    <div class="product_details mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                   <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="#">
                                <img id="zoom1" src="assets/img/product/details-1.jpg" data-zoom-image="assets/img/product/details-1.jpg" alt="big-1">
                            </a>
                        </div>
                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                <li>
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/product/details-2.jpg" data-zoom-image="assets/img/product/details-2.jpg">
                                        <img src="assets/img/product/details-2.jpg" alt="zo-th-1"/>
                                    </a>

                                </li>
                                <li >
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/product/details-3.jpg" data-zoom-image="assets/img/product/details-3.jpg">
                                        <img src="assets/img/product/details-3.jpg" alt="zo-th-1"/>
                                    </a>

                                </li>
                                <li >
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/product/details-4.jpg" data-zoom-image="assets/img/product/details-4.jpg">
                                        <img src="assets/img/product/details-4.jpg" alt="zo-th-1"/>
                                    </a>

                                </li>
                                <li >
                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="assets/img/product/details-1.jpg" data-zoom-image="assets/img/product/details-1.jpg">
                                        <img src="assets/img/product/details-1.jpg" alt="zo-th-1"/>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            
                <?php $prod_res = $product->read($id)?>
                <?php $prod_row = mysqli_fetch_assoc($prod_res)?>
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                           
                            <h1><?php echo $prod_row['name'];?></h1>
                            <div class=" product_ratting">
                                <ul>
                                <?php echo str_repeat('<i class="text-warning fa fa-star"></i>',$prod_row['rating']);?>
                                    <?php echo str_repeat('<i class="text-muted fa fa-star"></i>',5-$prod_row['rating']);?>
                                    <li class="review"><a href="#"> <?php echo $prod_row['review'];?> reviews </a></li>
                                </ul>
                                
                            </div>
                            <div class="price_box">
                                <span class="current_price">$<?php echo $prod_row['price_after_sale'];?></span>
                                <span class="old_price">$<?php echo $prod_row['price'];?></span>
                                
                            </div>
                            <div class="product_desc">
                                <ul>
                                    <li>In Stock</li>
                                    <li>Free delivery available*</li>
                                    <li>Sale 30% Off Use Code : 'Drophut'</li>
                                </ul>
                                <p><?php echo $prod_row['description'];?></p>
                            </div>
							<div class="product_timing">
                                <div data-countdown="2025/12/15"></div>
                            </div>

                            <div class="product_variant quantity">
                            <button class="button" onclick="window.location.href='<?php echo url('add-to-cart&id=').$prod_row['id'];?>';">Add to Cart</button>
                            </div>
                        
                            <div class=" product_d_action">
                               <ul>
                                   <li><a href="#" title="Add to wishlist">+ Add to Wishlist</a></li>
                               </ul>
                            </div>
                           
                            
                        </form>
                        <div class="priduct_social">
                            <ul>
                                <li><a class="facebook" href="https://www.facebook.com/" title="facebook"><i class="fa fa-facebook"></i> Like</a></li>           
                                <li><a class="twitter" href="https://www.twitter.com/" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>           
                                <li><a class="pinterest" href="https://www.pinterest.com/" title="pinterest"><i class="fa fa-pinterest"></i> save</a></li>           
                                <li><a class="google-plus" href="https://www.google.com/" title="google +"><i class="fa fa-google-plus"></i> share</a></li>        
                                <li><a class="linkedin" href="https://www.linkedin.com/" title="linkedin"><i class="fa fa-linkedin"></i> linked</a></li>        
                            </ul>      
                        </div>

                    </div>
                </div>
            
            </div>
        </div>    
    </div>
    <!--product details end-->
    
    <!--product info start-->
    <div class="product_d_info mb-60">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">   
                        <div class="product_info_button">    
                            <ul class="nav" role="tablist">
                                <li >
                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>
                                </li>
                                <li>
                                     <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Specification</a>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" >
                                <div class="product_info_content">
                                    <p><?php echo $prod_row['description'];?></p>
                                </div>    
                            </div>
                            <div class="tab-pane fade" id="sheet" role="tabpanel" >
                                <div class="product_d_table">
                                   <form action="#">
                                        <table>
                                            <tbody>
                                                
                                                <tr>
                                                    <td class="first_child">Styles</td>
                                                    <td><?php echo $prod_row['styles'];?></td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Properties</td>
                                                    <td><?php echo $prod_row['properties'];?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                  
                            </div>

                            
                        </div>
                    </div>     
                </div>
            </div>
        </div>    
    </div>  
    <!--product info end-->

<?php unset($_SESSION['cart']);?>
    <!--footer area start-->
    <?php require_once Root_Path . 'inc/footer.php';?>
    <!--footer area end-->

