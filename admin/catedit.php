<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php
   if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
       echo "<script>window.location = 'catlist.php';</script>";
   }else{
       $id = $_GET['catid'];
   }
   $cat = new Category();
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $catName    = $_POST['catName'];
    $catupdate  = $cat->catUpdate($catName, $id);
   }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php
                 if(isset($catupdate)){
                    echo $catupdate;
                 }
                 ?>
                 <?php
                   $singlecat = $cat->getCatById($id);
                   if($singlecat){
                    while($res = $singlecat->fetch_assoc()){
                 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo  $res['catName']; ?>" class="medium" />
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