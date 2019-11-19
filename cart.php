<?php include 'inc/header.php'; ?>
<?php 
  if(isset($_GET['delpro'])){
  	$id = $_GET['delpro'];
  	$delfcart = $ct->delFromCart($id);
  }
?>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cartId     = $_POST['cartId'];
        $quantity   = $_POST['quantity'];
        if($quantity <=0){

        	$delfcart = $ct->delFromCart($cartId);
        }else{
        	$updatecart = $ct->updateCart($quantity, $cartId);
        }
        
	}
?>

<?php 
  if(!isset($_GET['id'])){
  	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
  }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php 
			    	  if(isset($updatecart)){
			    	  	echo $updatecart;
			    	  }
			    	  if(isset($delfcart)){
			    	  	echo $delfcart;
			    	  }
			    	?>
			    	   	<?php
			    	   		$cartcheck = $ct->getAllCartPro();
			    	   		if($cartcheck){
			    	    ?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="20%">Product Name</th>
								<th width="20%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

							<?php 
							  $allcart = $ct->getAllCartPro();
							  if($allcart){
							  	$i = 0;
							  	$sum = 0;
							  	$Qty = 0;
							  	while($cart = $allcart->fetch_assoc()){
							  		$i++;
							?>
							
							<tr>
								<td>01</td>
								<td><?php echo $cart['productName']; ?></td>
								<td><img style="height: 40px;  width: 60px;" src="admin/<?php echo $cart['image']; ?>" alt="" /></td>
								<td><?php echo $cart['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $cart['cartId']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $cart['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php 
								  $total = $cart['price'] * $cart['quantity'];
								  echo $total; ?>	
								</td>
								<td><a onclick="return confirm('Are to Sure To Remove From Cart!');" href="?delpro=<?php echo $cart['cartId']; ?>">X</a></td>
							</tr>
							<?php 
							  $Qty = $Qty + $cart['quantity'];
							  $sum = $sum + $total;
							?>
						    <?php } } ?>
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>TK. <?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>TK. 
									<?php 
									  $vat = $sum * 0.1;
									  echo $gt = $sum + $vat;
									  Session::set("Qty", $Qty);
									  Session::set("gt", $gt);
								    ?> 
							   </td>
							</tr>
					   </table>
					  <?php } else{
					  	echo "Cart is empty! Please Add Products To Cart!";
					  } ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>