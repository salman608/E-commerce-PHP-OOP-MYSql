<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include_once '../helpers/Format.php'; ?>
<?php 
  $pd = new Product(); 
  $fm = new Format();
?>
<?php
   if(isset($_GET['delpro'])){
      $id = $_GET['delpro'];
      $delpro = $pd->delProById($id);
   }  
 ?>
<div class="grid_10">
    <div class="box round first grid">
    	<?php
    	  if(isset($delpro)){
    	  	echo $delpro;
    	  } 
    	 ?>
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				  $getproduct = $pd->getAllProduct();
				  if($getproduct){
				  	$i=0;
				  	while($product = $getproduct->fetch_assoc()){
				  	$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $product['productName']; ?></td>
					<td><?php echo $product['catName']; ?></td>
					<td><?php echo $product['brandName']; ?></td>
					<td><?php echo $fm->shortentext($product['body'], 50); ?></td>
					<td><?php echo $product['price']; ?> Taka</td>
					<td><img src="<?php echo $product['image']; ?>" alt="Image" height="40px" width="60px"></td>
					<td><?php 
					    if($product['type'] == '0'){
					    	echo "Featured";
					    }elseif($product['type'] == '1'){
					    	echo "Non-Featured";
					    }
					?></td>
					<td><a href="productedit.php?proid=<?php echo $product['productId']; ?>">Edit</a> || <a onclick="return confirm('Are You Sure To Delete!');" href="?delpro=<?php echo $product['productId']; ?>">Delete</a></td>
				</tr>
			    <?php } } ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
