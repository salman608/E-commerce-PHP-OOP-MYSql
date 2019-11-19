<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
   if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
       echo "<script>window.location = 'catlist.php';</script>";
   }else{
       $id = $_GET['brandid'];
   }
   $brand = new Brand();
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $brandName    = $_POST['brandName'];
    $brandupdate  = $brand->brandUpdate($brandName, $id);
   }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 
                <?php
                 if(isset($brandupdate)){
                    echo $brandupdate;
                 }
                 ?>
                 <?php
                   $singlebrand = $brand->getBrandById($id);
                   if($singlebrand){
                    while($res = $singlebrand->fetch_assoc()){
                 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo  $res['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                 <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>