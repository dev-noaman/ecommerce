<?php require_once Root_Path.'inc/header.php';?>
<?php require_once Root_Path.'inc/nav.php';?>
<?php require_once Root_Path.'src/DB_Actions/slider.php';?>
<?php require_once Root_Path.'src/DB_Actions/Products.php';?>
<?php require_once Root_Path.'src/DB_Actions/Blogs.php';?>
<?php require_once Root_Path.'src/DB_Actions/Users_Opinion.php';?>
<?php
$product_db = new DataBase();
$conn = $product_db->getConnection();
$product = new Product($conn);
$slider = new Slider($conn);
$blog = new Blog($conn);
$opinion = new Users_Opinion($conn);
?>

    <!--slider area start-->
    <section class="slider_section d-flex align-items-center" data-bgimg="assets/img/slider/slider3.jpg">
        <div class="slider_area owl-carousel">
        <?php $slider_res = $slider->readAll();
                    while($slider_row = mysqli_fetch_assoc($slider_res)):?>
            <div class="single_slider d-flex align-items-center">
           
                <div class="container">
                   
                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <div class="slider_content">
                                <h1><?php echo $slider_row['title'];?></h1>
                                <h2><?php echo $slider_row['description'];?></h2>
                                <p><?php echo $slider_row['link'];?></p>
                                <a class="button" href=<?php echo url("product-details");?>>Buy now</a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="slider_content">
                                <img src=<?php echo Base_Url . "public/images/slider/" . $slider_row['image'];?> alt="">
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <?php endwhile;?>
        </div>
    </section>
    <!--slider area end-->

    <!--Tranding product-->
    <section class="pt-60 pb-30 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section-title">
                    <h2>Trending Products</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php $product_res = $product->readAll();?>
            <?php $i=0;?>
            <?php while($product_row = mysqli_fetch_assoc($product_res)):?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="single-tranding">
                    <a href=<?php echo url("product-details&id=") . $product_row['id'];?>>
                        <div class="tranding-pro-img">
                            <img src=<?php echo Base_Url . "public/images/products/" . $product_row['image'];?> alt="">
                        </div>
                        <div class="tranding-pro-title">
                            <h3><?php echo $product_row['name'];?></h3>
                            <h4><?php echo $product_row['subtitle'];?></h4>
                        </div>
                        <div class="tranding-pro-price">
                            <div class="price_box">
                                <span class="current_price">$<?php echo $product_row['price_after_sale'];?></span>
                                <span class="old_price">$<?php echo $product_row['price'];?></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php $i++;?>
            <?php if($i==3){break;}?>
            <?php endwhile;?>
        </div>
    </div>
</section><!--Trending product-->
<!--Tranding product-->

    <!--Features area-->
    <section class="features-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section-title">
                        <h2>Awesome Features</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="single-features">
                        <img src="assets/img/icon/1.png" alt="">
                        <h3>Impressive Distance</h3>
                        <p>consectetur adipisicing elit. Ut praesentium earum, blanditiis, voluptatem repellendus rerum voluptatibus dignissimos</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="single-features">
                        <img src="assets/img/icon/2.png" alt="">
                        <h3>100% self safe</h3>
                        <p>consectetur adipisicing elit. Ut praesentium earum, blanditiis, voluptatem repellendus rerum voluptatibus dignissimos</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="single-features">
                        <img src="assets/img/icon/3.png" alt="">
                        <h3>Awesome Support</h3>
                        <p>consectetur adipisicing elit. Ut praesentium earum, blanditiis, voluptatem repellendus rerum voluptatibus dignissimos</p>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                    <a href="#"><img src="assets/img/product/2.png" alt=""></a>
                </div>
            </div>
        </div>
    </section><!--Features area-->

    <!--Features area-->
    <section class="gray-bg pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 order-lg-1 order-md-1 order-sm-1">
                    <div class="pro-details-feature">
                        <img src="assets/img/product/1.png" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 order-lg-2 order-md-2 order-sm-2">
                    <div class="pro-details-feature">
                        <h3>Long Lasting</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                        <ul>
                            <li>It is a long established fact that</li>
                            <li>Many desktop publishing</li>
                            <li>Various versions have evolved over the years, sometimes by accident</li>
                            <li>There are many variations of passages</li>
                            <li>If you are going to use a</li>
                            <li>Alteration in some form, by injected</li>
                        </ul>
                        <a href=<?php echo url("product-details");?>>$70 Buy now</a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 order-lg-3 order-md-4 order-sm-4 order-4">
                    <div class="pro-details-feature">
                        <h3>Impressive Distance</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                        <ul>
                            <li>It is a long established fact that</li>
                            <li>Many desktop publishing</li>
                            <li>Various versions have evolved over the years, sometimes by accident</li>
                            <li>There are many variations of passages</li>
                            <li>If you are going to use a</li>
                            <li>Alteration in some form, by injected</li>
                        </ul>
                        <a href=<?php echo url("product-details");?>>$70 Buy now</a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 order-lg-4 order-md-3 order-sm-3 order-3">
                    <div class="pro-details-feature">
                        <img src="assets/img/product/1.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section><!--Features area-->

    
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
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                        <form action="#">
                            <?php $id = rand(1,3);?>
                            <?php $single_product = $product->read($id);?>
                            <?php $row_single_product = mysqli_fetch_assoc($single_product);?>    
                            <h1><a href="<?php echo url("product-details&id=").$row_single_product['id']; ?>">
                            <?php echo $row_single_product['name']; ?>
                            </a></h1>

                            <a href=<?php echo url("product-details&id=").$product_row['id'];?>>
                            <div class=" product_ratting">
                                <ul>
                                    <?php echo str_repeat('<i class="text-warning fa fa-star"></i>',$row_single_product['rating']);?>
                                    <?php echo str_repeat('<i class="text-muted fa fa-star"></i>',5-$row_single_product['rating']);?>
                                    <li class="review"><a href="#"> <?php echo $row_single_product['review'];?> reviews </a></li>
                                </ul>
                                
                            </div>
                            <div class="price_box">
                                <span class="current_price">$<?php echo $row_single_product['price_after_sale'];?></span>
                                <span class="old_price">$<?php echo $row_single_product['price'];?></span>                                
                            </div>
                            <div class="product_desc">
                                <ul>
                                    <li>In Stock</li>
                                    <li>Free delivery available*</li>
                                    <li>Sale 30% Off Use Code : 'Drophut'</li>
                                </ul>
                                <p><?php echo $row_single_product['description'];?></p>
                            </div>
                            <div class="product_timing">
                                <div data-countdown="2025/6/28"></div>
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




    
    <!--Other product-->
    <section class="pt-60 pb-30">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section-title">
                        <h2>Other collections</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
            <?php $product_res = $product->readAll();?>
            <?php $i=0;?>
            <?php while($product_row = mysqli_fetch_assoc($product_res)):?>
                <?php if($i<3){$i++;continue;}?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="single-tranding">
                    <a href=<?php echo url("product-details&id=").$product_row['id'];?>>
                        <div class="tranding-pro-img">
                            <img src=<?php echo Base_Url . "public/images/products/" . $product_row['image'];?> alt="">
                        </div>
                        <div class="tranding-pro-title">
                            <h3><?php echo $product_row['name'];?></h3>
                            <h4><?php echo $product_row['subtitle'];?></h4>
                        </div>
                        <div class="tranding-pro-price">
                            <div class="price_box">
                                <span class="current_price">$<?php echo $product_row['price_after_sale'];?></span>
                                <span class="old_price">$<?php echo $product_row['price'];?></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <?php endwhile;?>
        </div>
    </div>
        </div>
    </section><!--Other product-->

    <!--Testimonials-->
    <section class="pb-60 pt-60 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="testimonial_are">
                        <div class="testimonial_active owl-carousel">   
                          <?php $opinion_res = $opinion->readAll();?>
                          <?php while($opinion_row = mysqli_fetch_assoc($opinion_res)):?>
                            <article class="single_testimonial">
                                <figure>
                                    <div class="testimonial_thumb">
                                        <a href="#"><img src=<?php echo Base_Url . "public/images/users/" . $opinion_row['image'];?> alt=""></a>
                                    </div>
                                    <figcaption class="testimonial_content">
                                        <p><?php echo $opinion_row['opinion'];?></p>
                                        <h3><a href="#"><?php echo $opinion_row['name'];?></a><span> - <?php echo $opinion_row['position'];?></span></h3>
                                    </figcaption>
                                    
                                </figure>
                            </article> 
                            <?php endwhile;?>
                         
                           
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Testimonials-->

    <!--Blog-->
    <section class="pt-60">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section-title">
                        <h2>Blog Posts</h2>
                    </div>
                </div>
            </div>
            <div class="row blog_wrapper">
                <?php $blog_res = $blog->readAll();?>
                <?php $i = 0;?>
                <?php while($blog_row = mysqli_fetch_assoc($blog_res)):?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                    <article class="single_blog mb-60">
                        <figure>
                            <div class="blog_thumb">
                                <a href=<?php echo url("blog-details&id=") . $blog_row['id'];?>><img src=<?php echo Base_Url . "public/images/blogs/" . $blog_row['image'];?> alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <h3><a href="blog-details.html"><?php echo $blog_row['title'];?></a></h3>
                                <div class="blog_meta">                                        
                                    <span class="author">Posted by : <?php echo $blog_row['author_name'];?></a> / </span>
                                    <span class="post_date"><?php echo $blog_row['created_at'];?></a></span>
                                </div>
                                <div class="blog_desc">
                                    <p><?php echo $blog_row['special_content'];?></p>
                                </div>
                                <footer class="readmore_button">
                                    <a href=<?php echo url("blog-details&id=") . $blog_row['id'];?>>read more</a>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>
                </div> 
                <?php if($i==2){break;}?>
                <?php $i++;?>  
                <?php endwhile;?>

            </div>
        </div>
    </section><!--/Blog-->

    <!--shipping area start-->
    <section class="shipping_area">
        <div class="container">
            <div class=" row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping1.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>Free Shipping</h2>
                            <p>Free shipping on all US order</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping2.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>Support 24/7</h2>
                            <p>Contact us 24 hours a day</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping3.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>100% Money Back</h2>
                            <p>You have 30 days to Return</p>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="assets/img/about/shipping4.png" alt="">
                        </div>
                        <div class="shipping_content">
                            <h2>Payment Secure</h2>
                            <p>We ensure secure payment</p>
                        </div>
                    </div>
                </div>                          
            </div>
        </div>
    </section>
    <!--shipping area end-->
	
	
    <!--footer area start-->
    <?php require_once Root_Path.'inc/footer.php';?>
