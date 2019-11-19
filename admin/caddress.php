<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Customer.php'; ?>
<?php
   if(!isset($_GET['cmrId']) || $_GET['cmrId'] == NULL){
       echo "<script>window.location = 'inbox.php';</script>";
   }else{
       $id = $_GET['cmrId'];
   }
   $cmr = new Customer();
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
     echo "<script>window.location = 'inbox.php';</script>";
   }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Cumtomer Address</h2>
               <div class="block copyblock"> 
                 <?php
                   $cadd = $cmr->getCmrById($id);
                   if($cadd){
                    while($res = $cadd->fetch_assoc()){
                 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td><label for="">Address</label></td>
                            <td>
                                
                                <input type="text" readonly="" value="<?php echo  $res['address']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">City</label></td>
                            <td>
                                
                                <input type="text" readonly="" value="<?php echo  $res['city']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Zip</label></td>
                            <td>
                                <input type="text" readonly="" value="<?php echo  $res['zip']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Phone</label></td>
                            <td>
                                <input type="text" readonly="" value="<?php echo  $res['phone']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Email</label></td>
                            <td>
                                <input type="text" readonly="" value="<?php echo  $res['email']; ?>" class="medium" />
                            </td>
                        </tr>
						            <tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
                 <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>