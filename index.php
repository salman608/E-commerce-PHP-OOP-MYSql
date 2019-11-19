<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>
	
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		      	<?php 
		      	  $getpro = $pd->getfpd();
		      	  if($getpro){
		      	  	while($fpd = $getpro->fetch_assoc()){
		      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a class="image" href="details.php?proid=<?php echo $fpd['productId']; ?>"><img style="height: 200px;" src="admin/<?php echo $fpd['image']; ?>" alt="Image"> </a>
					 <h2><?php echo $fpd['productName']; ?></h2>
					 <p><?php echo $fm->shortentext($fpd['body'], 80); ?></p>
					 <p><span class="price"><?php echo $fpd['price']; ?> Taka</span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $fpd['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php 
				  $getnpro = $pd->getnpd();
				  if($getnpro){
				  	while($npd = $getnpro->fetch_assoc()){
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a class="image" href="details.php?proid=<?php echo $npd['productId']; ?>"><img style="height: 200px;" src="admin/<?php echo $npd['image']; ?>" alt="Image"> </a>
					 <h2><?php echo $npd['productName']; ?></h2>
					 <p><span class="price"><?php echo $npd['price']; ?> Taka</span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $npd['productId']; ?>" class="details">Details</a></span></div>
				</div>
		      <?php } } ?>
			</div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>