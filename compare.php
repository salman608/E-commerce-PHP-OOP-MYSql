<?php include 'inc/header.php'; ?>
<?php 
  $cmrlogin = Session::get("cmrLogin");
  if($cmrlogin == false){
  	header("Location: login.php");
  }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare</h2>
			    	
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Price</th>
								<th>Action</th>
							</tr>

							<?php 
							  $customerId = Session::get("cmrId");
							  $getPd = $pd->getComparedData($customerId);
							  if($getPd){
							  	$i = 0;
							  	while($cart = $getPd->fetch_assoc()){
							  		$i++;
							?>
							
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $cart['productName']; ?></td>
								<td><img style="height: 90px;  width: 100px;" src="admin/<?php echo $cart['image']; ?>" alt="" /></td>
								<td>Tk. <?php echo $cart['price']; ?></td>
								<td><a href="details.php?proid=<?php echo $cart['productId']; ?>">View</a></td>
							</tr>
						    <?php } } ?>
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%; text-align: center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>