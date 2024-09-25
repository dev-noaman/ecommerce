<?php require_once Root_Path . 'inc/header.php';?>
<?php require_once Root_Path . 'inc/nav.php';?>
<?php require_once Root_Path.'src/DB_Actions/Contact.php';?>




    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="index-2.html">home</a></li>
                            <li>Contact</li>
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
				<div class="col-lg-12">
					<div class="account-contents" style="background: url('assets/img/about/about2.jpg'); background-size: cover;">
                        <div class="row">
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                                <div class="account-thumb">
                                    <h2>Contact us</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis consectetur similique deleniti pariatur enim cumque eum</p>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                            
                                <div class="account-content">
                                    <?php if(isset($_SESSION['contact']) && $_SESSION['contact'] == "success"):?>
                                        <span class="text-success" style="font-size: 40px; font-weight: bold; display: block; text-align: center; line-height: 1.5; padding: 10px;">
                                              <div class="text-center">
                                                  Message Sent Successfully
                                              </div>
                                        </span>
                                    <?php endif;?>
                                    <form action="<?php echo url("check-contact");?>" method = "post">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="single-acc-field">
                                                    <label for="name">Name</label>
                                                    <input type="text"name ="name" placeholder="Name" id="name">
                                                    <span class="text-danger"><?php echo $_SESSION['errors']['name']??'';?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="single-acc-field">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" placeholder="Email" id="email">
                                                    <span class="text-danger"><?php echo $_SESSION['errors']['email']??'';?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="single-acc-field">
                                                    <label for="msg">Message</label>
                                                    <textarea name="message" id="msg" rows="4"></textarea>
                                                    <span class="text-danger"><?php echo $_SESSION['errors']['message']??'';?></span>
                                                </div>
                                            </div>
                                        </div>
                         
                                        <div class="single-acc-field">
                                            <button type="submit">Send Message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>
        <?php unset($_SESSION['contact']);
        unset ($_SESSION['errors']);?>
    <!--footer area start-->
    <?php require_once Root_Path . 'inc/footer.php';?>
    <!--footer area end-->
