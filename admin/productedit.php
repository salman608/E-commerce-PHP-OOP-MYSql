<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php 
   if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
    echo "<script>window.location = 'productlist.php';</script>";
   }else{
    $id = $_GET['proid'];
   }
   $pd = new Product();
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
      $updateProduct = $pd->productUpdate($_POST, $_FILES, $id);
   }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block"> 
        <?php 
          if(isset($updateProduct)){
            echo $updateProduct;
          }
        ?>   
        <?php 
          $singelproduct = $pd->getProById($id);
          if($singelproduct){
            while($spro = $singelproduct->fetch_assoc()){
        ?>           
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $spro['productName']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                            <?php 
                               $cat = new Category();
                               $allcat = $cat->catList();
                               if($allcat){
                                while($acat = $allcat->fetch_assoc()){
                             ?>
                            <option
                             <?php if($spro['catId'] == $acat['catId']){ ?>
                                selected = "selected"
                             <?php } ?>
                             value="<?php echo $acat['catId']; ?>"><?php echo $acat['catName']; ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                            <?php 
                               $brand = new Brand();
                               $allbrand = $brand->brandList();
                               if($allbrand){
                                while($abrand = $allbrand->fetch_assoc()){
                             ?>
                            <option
                            <?php if($spro['brandId'] == $abrand['brandId']){ ?>
                               selected = "selected"
                            <?php } ?>
                             value="<?php echo $abrand['brandId'];?>"><?php echo $abrand['brandName'];?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="body" rows="15" cols="106"><?php echo $spro['body']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $spro['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $spro['image']; ?>" alt="Image" height="80px" width="200px"><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php if($spro['type'] == '0'){ ?>
                                <option selected="selected" value="0">Featured</option>
                                <option value="1">Non-Featured</option>
                            <?php }else{ ?>
                                <option value="0">Featured</option>
                                <option selected="selected" value="1">Non-Featured</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
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
<!-- Load TinyMCE -->
<!-- <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script> -->
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


