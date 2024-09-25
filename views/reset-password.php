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
                                    <h2>Reset password</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis consectetur similique deleniti pariatur enim cumque eum</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                
                                <div class="account-content">
                                     <span class="text-success" style="font-size: 25px; font-weight: bold; display: block; text-align: center; line-height: 1.5; padding: 10px;">
                                         <div class="text-center">
                                             <?php if(isset ($_SESSION['reset']) && $_SESSION['reset'] == "success"):?>
                                                Password Updated successfully
                                            <?php endif;?>
                                         </div>
                                     </span>
                                    <form action="<?php echo url("check-reset-password");?>" method="post">
                                        <div class="single-acc-field">
                                            <label for="email">Password</label>
                                            <input type="password" id="password"name = "password" placeholder="Enter New Password">
                                            <span class="text-danger"><?php echo $_SESSION['errors']['password'] ?? ''; ?></span>
                                        </div>
                                        <div class="single-acc-field">
                                            <button type="submit">Confirm Password</button>
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
    <?php unset($_SESSION['reset']);?>
    <!--footer area start-->
    <?php require_once Root_Path . 'inc/footer.php';?>
    <!--footer area end-->