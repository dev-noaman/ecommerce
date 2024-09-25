<?php if(!isset($_SESSION['auth']))
{
    redirect("login");
}?>

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
                            <li>Tracking</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <?php $user_id = $_SESSION['auth']['id'];?>
        <?php $sql = "SELECT `order`.* FROM `order` INNER JOIN `users` on `order`.`user_id` = `users`.`id` WHERE `order`.`user_id`='$user_id'";?>
        <?php $orders = mysqli_query($conn,$sql);?>
        <?php if(mysqli_num_rows($orders)==0):?>
        
            <span class="text-success" style="font-size: 40px; font-weight: bold; display: block; text-align: center; line-height: 1.5; padding: 10px;">
                                      <div class="text-center">
                                         No orders to show
                                         
                                      </div>
                                    </span>
                                    <?php die();?>
        <?php else:?>
    <span class="text-success" style="font-size: 40px; font-weight: bold; display: block; text-align: center; line-height: 1.5; padding: 10px;">
                                      <div class="text-center">
                                         Your orders
                                      </div>
                                    </span>
    <!--breadcrumbs area end-->

    
    <!--error section area start-->
    <div class="container py-5">
    <div class = "row py-5">
    <div class = "col-12">
        
        <table class = "table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Total Price</th>
                    <th>Created At</th>
                    
                  

                </tr>

            </thead>
            <tbody>
                <?php $i = 1;while($order = mysqli_fetch_assoc($orders)):?>
                <tr>
              

                    <td><?php echo $i++;?></td>
                    <td><?php echo $order['user_id'];?></td>
                    <td><?php echo $order['total_price'];?>$</td>
                    <td><?php echo $order['created_at'];?></td>
                   

                
                </tr>
                <?php endwhile;?>
                
            </tbody>


        </table>

</div>     
</div>
    <!--error section area end--> 
        <?php endif;?>

    <!--footer area start-->
    <?php require_once Root_Path . 'inc/footer.php';?>
    <!--footer area end-->

