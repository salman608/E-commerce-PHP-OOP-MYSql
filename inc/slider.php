	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<?php 
					  $latestiphone = $pd->latesFromIphone();
					  if($latestiphone){
					  	while ($iphone = $latestiphone->fetch_assoc()) {
					?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $iphone['productId']; ?>"> <img src="admin/<?php echo $iphone['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $fm->shortentext($iphone['body'], 50); ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $iphone['productId']; ?>">Add to cart</a></span></div>
				   </div>
				   <?php } } ?>
			   </div>			
				<div class="listview_1_of_2 images_1_of_2">
					<?php 
					  $latestsamsung = $pd->latesFromSamsung();
					  if($latestsamsung){
					  	while ($samsung = $latestsamsung->fetch_assoc()) {
					?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $samsung['productId']; ?>"> <img src="admin/<?php echo $samsung['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Samsung</h2>
						<p><?php echo $fm->shortentext($samsung['body'], 50); ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $samsung['productId']; ?>">Add to cart</a></span></div>
				   </div>
				   <?php } } ?>
			   </div>		
			</div>
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<?php 
					  $latestxiaomi = $pd->latesFromXiaomi();
					  if($latestxiaomi){
					  	while ($xiaomi = $latestxiaomi->fetch_assoc()) {
					?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $xiaomi['productId']; ?>"> <img src="admin/<?php echo $xiaomi['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Xiaomi</h2>
						<p><?php echo $fm->shortentext($xiaomi['body'], 50); ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $xiaomi['productId']; ?>">Add to cart</a></span></div>
				   </div>
				   <?php } } ?>
			   </div>			
				<div class="listview_1_of_2 images_1_of_2">
					<?php 
					  $latestdell = $pd->latesFromDell();
					  if($latestdell){
					  	while ($dell = $latestdell->fetch_assoc()) {
					?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $dell['productId']; ?>"> <img src="admin/<?php echo $dell['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Dell</h2>
						<p><?php echo $fm->shortentext($dell['body'], 50); ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $dell['productId']; ?>">Add to cart</a></span></div>
				   </div>
				   <?php } } ?>
			   </div>		
			</div>
			
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>