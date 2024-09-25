<?php require_once Root_Path . 'inc/header.php';?>
<?php require_once Root_Path . 'inc/nav.php';?>
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index-2.html">home</a></li>
                            <li>Forget password</li>
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
                                    <h2>Forgot password?</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis consectetur similique deleniti pariatur enim cumque eum</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="account-content">
                                    <form action="<?php echo url("check-reset");?>" method="post">
                                        <div class="single-acc-field">
                                            <label for="email">Email</label>
                                            <input type="email" id="email"name = "email" placeholder="Enter your Email">
                                            <span class="text-danger"><?php echo $_SESSION['errors']['email'] ?? ''; ?></span>
                                        </div>
                                        <div class="single-acc-field">
                                            <button type="submit">Reset Password</button>
                                        </div>
                                        <a href=<?php echo url("login");?>>Login now</a>
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <?php unset($_SESSION['errors']);?>
    <!--footer area start-->
    <?php require_once Root_Path . 'inc/footer.php';?>
    <!--footer area end-->
