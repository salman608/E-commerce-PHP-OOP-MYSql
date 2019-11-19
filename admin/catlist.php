<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php
   $cat = new Category();
   if(isset($_GET['delid'])){
      $id = $_GET['delid'];
      $delcat = $cat->delCatById($id);
   }  
 ?>
        <div class="grid_10">
            <div class="box round first grid">
            	<?php
            	  if(isset($delcat)){
            	  	echo $delcat;
            	  } 
            	 ?>
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						  $catlist = $cat->catList();
						  if($catlist){
						  	$i=0;
						  	while($allcat = $catlist->fetch_assoc()){
						  		$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $allcat['catName']; ?></td>
							<td><a href="catedit.php?catid=<?php echo $allcat['catId']; ?>">Edit</a> || <a onclick="return confirm('Are You Sure To Delete!');" href="?delid=<?php echo $allcat['catId']; ?>">Delete</a></td>
						</tr>
					    <?php } } else{ ?>
					    	<p>No Category Available</p>
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

