<?php include 'inc/header.php'; ?>
<?php 
   if(!isset($_GET['catId']) || $_GET['catId'] == NULL){
       echo "<script>window.location = '404.php';</script>";
   }else{
       $catId = $_GET['catId'];
   }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Category</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	   <?php 
	      	     $getprobycat = $pd->getProByCat($catId);
	      	     if($getprobycat){
	      	     	while ($pro = $getprobycat->fetch_assoc()) {
	      	   ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img style="height: 200px;" src="admin/<?php echo $pro['image']; ?>" alt="" /></a>
					 <h2><?php echo $pro['productName']; ?></h2>
					 <p><?php echo $fm->shortentext($pro['body'], 40); ?></p>
					 <p><span class="price">Tk. <?php echo $pro['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $pro['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } else{ ?>
					<br>
					<center><div style="color: red; font-size: 25px;">No Product Is Available From This Category !</div></center>
				<?php } ?>
			</div>

	
	
    </div>
 </div>
<?php include 'inc/footer.php'; ?>