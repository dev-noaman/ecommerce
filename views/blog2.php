<?php require_once Root_Path . 'inc/header.php';?>
<?php require_once Root_Path . 'inc/nav.php';?>
<?php require_once Root_Path . 'src/DB_Actions/Blogs.php';?>
<?php require_once Root_Path . 'src/DB_Functions.php';?>
<?php
 $db = new DataBase();
 $conn = $db->getConnection();
$blog = new Blog($conn);
?>

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index-2.html">home</a></li>
                            <li>All blog</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->
	
	
	<!--blog body area start-->
    <div class="blog_details mt-60">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-9">
                    <div class="blog_wrapper">
                        <div class="section-title">
                            <h2>All Blog</h2>
                        </div>
                        <div class="row">
                            <?php $blog_res = $blog->readAll();?>
                            <?php $i = 0;?>
                            <?php while ($blog_row = mysqli_fetch_assoc($blog_res)):?>
                                <?php
                            if($i<4){$i++;continue;}?>
                            <div class="col-lg-6 col-md-6">
                                <article class="single_blog mb-60">
                                    <figure>
                                        <div class="blog_thumb">
                                            <a href=<?php echo url("blog-details&id=").$blog_row['id'];?>><img src=<?php echo Base_Url . "public/images/blogs/" . $blog_row['image'];?> alt=""></a>
                                        </div>
                                        <figcaption class="blog_content">
                                            <h3><a href=<?php echo url("blog-details&id=").$blog_row['id'];?>><?php echo $blog_row['title'];?></a></h3>
                                            <div class="blog_meta">                                        
                                                <span class="author">Posted by : <?php echo $blog_row['author_name'];?></a> / </span>
                                                <span class="post_date">On : <?php echo $blog_row['created_at'];?></a></span>
                                            </div>
                                            <div class="blog_desc">
                                                <p><?php echo $blog_row['special_content'];?> </p>
                                            </div>
                                            <footer class="readmore_button">
                                                <a href=<?php echo url("blog-details&id=").$blog_row['id'];?>>read more</a>
                                            </footer>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                            
                           <?php endwhile;?>
                           
                            
                        </div>
                    </div>
                </div> 
                <div class="col-lg-3 col-md-12">
                    <div class="blog_sidebar_widget">
                        <div class="widget_list widget_search">
                            <h3>Search</h3>
                            <form action="#">
                                <input placeholder="Search..." type="text">
                                <button type="submit">search</button>
                            </form>
                        </div>
                        <div class="widget_list widget_post">
                            <h3>Recent Posts</h3>
                            <?php $recent_res = select_limit("blogs","DESC","3");?>
                            <?php while($recent_row = mysqli_fetch_assoc($recent_res)):?>
                            <div class="post_wrapper">
                                <div class="post_thumb">
                                    <a href=<?php echo url("blog-details&id=") . $recent_row['id'];?>><img src=<?php echo Base_Url . "public/images/blogs/" .  $recent_row['image'];?> alt=""></a>
                                </div>
                                <div class="post_info">
                                    <h3><a href=<?php echo url("blog-details&id=") . $recent_row['id'];?>><?php echo $recent_row['title'];?></a></h3>
                                    <span><?php echo $recent_row['created_at'];?> </span>
                                </div>
                            </div>
                            <?php endwhile;?>
                          
                             
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--blog section area end-->
	
	    
    <!--blog pagination area start-->
    <div class="blog_pagination">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pagination">
                        <ul>
                            <li class="current">2</li>
                            <li><a href=<?php echo url("blog");?>>1</a></li>
                            <li class=<?php echo url("blog");?>><a href=<?php echo url("blog");?>>previous</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--blog pagination area end-->
	
	
    <!--footer area start-->
    <?php require_once Root_Path . 'inc/footer.php';?>