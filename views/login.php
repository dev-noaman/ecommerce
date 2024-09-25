<?php if(isset($_SESSION['auth']))
{
    redirect("index");
}
?>
<?php require_once 'inc/header.php';?>
<?php require_once 'inc/nav.php';?>
    <!--header area end-->

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href=<?php echo url("index");?>>home</a></li>
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <!--breadcrumbs area end-->

	<section class="account">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div class="account-contents" style="background: url('assets/img/about/about1.jpg'); background-size: cover;">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="account-thumb">
                                    <h2>Login now</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis consectetur similique deleniti pariatur enim cumque eum</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="account-content">
                                    <form action="<?php echo url("check-login");?>" method="post">
                                    <?php if(isset($_SESSION['login']) && $_SESSION['login'] == "not found"): ?>
                                      <div class="alert alert-danger">
                                                      WRONG EMAIL OR PASSWORD!
                                      </div>
                                      <?php elseif(isset($_SESSION['login']) && $_SESSION['login'] == "found"):?>
                                      <div class="alert alert-success">
                                      LOGGED IN SUCCESSFULLY
                                     </div>
                                      <?php endif;?>
                                        <div class="single-acc-field">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" placeholder="Enter your Email">
                                        </div>
                                        <div class="single-acc-field">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" placeholder="Enter your password">
                                        </div>
                                        
                                        <div class="single-acc-field">
                                            <button type="submit">Login Account</button>
                                        </div>
                                        <a href=<?php echo url("forget-password");?>>Forget Password?</a>
                                        <a href=<?php echo url("register");?>>Not Account Yet?</a>
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <?php unset($_SESSION['login']);?>
    <?php require_once 'inc/footer.php';?>
   