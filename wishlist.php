<?php include 'inc/header.php'; ?>
<?php 
  $cmrlogin = Session::get("cmrLogin");
  if($cmrlogin == false){
  	header("Location: login.php");
  }
?>

<?php 
  if(isset($_GET['delwlistid'])){
  	$delwlistid = $_GET['delwlistid'];
  	$delwlist   = $pd->delWishlistdData($cmrId, $delwlistid);
  }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Wishlist</h2>
			    	<?php 
                       if(isset($delwlist)){
                       	echo $delwlist;
                       }
			    	?>
			    	
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
							  $getWl = $pd->getWishlistData($customerId);
							  if($getWl){
							  	$i = 0;
							  	while($cart = $getWl->fetch_assoc()){
							  		$i++;
							?>
							
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $cart['productName']; ?></td>
								<td><img style="height: 60px;  width: 80px;" src="admin/<?php echo $cart['image']; ?>" alt="" /></td>
								<td>Tk. <?php echo $cart['price']; ?></td>
								<td><a href="details.php?proid=<?php echo $cart['productId']; ?>">Buy Now</a> || <a href="?delwlistid=<?php echo $cart['productId']; ?>">Remove</a></td>
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