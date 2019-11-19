 <?php include 'inc/header.php'; ?>
<?php 
	if(isset($_GET['proid'])){
		$id = $_GET['proid'];
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $quantity  = $_POST['quantity'];
        $addtocart = $ct->addToCart($quantity, $id);
	}
?>
<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
  	$productId  = $_POST['productId']; 
    $insertCom = $pd->insertCompareData($cmrId, $productId);
  }
?>
<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])){
    $insertWisl = $pd->insertWishlistData($cmrId, $id);
  }
?>
<style>
	.comwish{width: 100px; float: left; margin-right: 52px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php 
    		  $getpro = $pd->getProDetails($id);
    		  if($getpro){
    		  	while($pdetail = $getpro->fetch_assoc()){
    		?>
			<div class="cont-desc span_1_of_2">				
				<div class="grid images_3_of_2">
					<img src="admin/<?php echo $pdetail['image']; ?>" alt="Product Image" />
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $pdetail['productName']; ?></h2>
					<p><?php echo $fm->shortentext($pdetail['body'], 80); ?></p>					
					<div class="price">
						<p>Price: <span><?php echo $pdetail['price']; ?></span> Taka</p>
						<p>Category: <span><?php echo $pdetail['catName']; ?></span></p>
						<p>Brand:<span><?php echo $pdetail['brandName']; ?></span></p>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<input type="number" class="buyfield" name="quantity" value="1"/>
							<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						</form>				
					</div>
					<br>
					<span style="color: red; font-size: 18px;">
						<?php
						  if(isset($addtocart)){
						  	echo $addtocart;
						  } 
						?>
						<?php
						  if(isset($insertCom)){
						  	echo $insertCom;
						  } 
						?>
						<?php
						  if(isset($insertWisl)){
						  	echo $insertWisl;
						  } 
						?>
					</span>
					<?php 
					  $cmrlogin = Session::get("cmrLogin");
					  if($cmrlogin == true){
					?>
					<div class="add-cart">
						<div class="comwish">
							<form action="" method="post">
								<input type="hidden" class="buyfield" name="productId" value="<?php echo $pdetail['productId']; ?>"/>
								<input type="submit" class="buysubmit" name="compare" value="Add To Compare"/>
							</form>	
						</div>	
						<div class="comwish">
							<form action="" method="post">
								
								<input type="submit" class="buysubmit" name="wlist" value="Add To Wishlist"/>
							</form>	
						</div>	
					</div>
					
					<?php } ?>
					
					<br>
				</div>
				<div class="product-desc">
					<h2>Product Details</h2>
					<p><?php echo $pdetail['body']; ?></p>
		         </div>
				
	        </div>
	        <?php } } ?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					<?php 
					  $allcat = $cat->catList();
					  if($allcat){
					  	while($cat = $allcat->fetch_assoc()){
					?>
				      <li><a href="productbycat.php?catId=<?php echo $cat['catId']; ?>"><?php echo $cat['catName']; ?></a></li>
				    <?php } } ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
  <?php include 'inc/footer.php'; ?>