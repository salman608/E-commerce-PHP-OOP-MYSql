<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
   $brand = new Brand();
   if(isset($_GET['delid'])){
      $id = $_GET['delid'];
      $delbrand = $brand->delBrandById($id);
   }  
 ?>
        <div class="grid_10">
            <div class="box round first grid">
            	<?php
            	  if(isset($delbrand)){
            	  	echo $delbrand;
            	  } 
            	 ?>
                <h2>Brand List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						  $brandlist = $brand->brandList();
						  if($brandlist){
						  	$i=0;
						  	while($allbrand = $brandlist->fetch_assoc()){
						  		$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $allbrand['brandName']; ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $allbrand['brandId']; ?>">Edit</a> || <a onclick="return confirm('Are You Sure To Delete!');" href="?delid=<?php echo $allbrand['brandId']; ?>">Delete</a></td>
						</tr>
					    <?php } } else{ ?>
					    	<p>No Brand Available</p>
					    <?php } ?>
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

