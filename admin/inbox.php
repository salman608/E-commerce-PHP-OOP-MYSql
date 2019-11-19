<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../classes/Cart.php');
  include_once ($filepath.'/../helpers/Format.php');
  $ct = new Cart();
  $fm = new Format();
?>
<?php 
  if(isset($_GET['sftconfirm'])){
  	$cmrId = $_GET['sftconfirm'];
  	$price = $_GET['price'];
  	$date  = $_GET['date'];

  	$shiftpro = $ct->shiftProduct($cmrId, $price, $date);
  }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                  if(isset($shiftpro)){
                  	echo $shiftpro;
                  } 
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Order Time</th>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						  $adordered = $ct->adOrdered();
						  if($adordered){
						  	while ($ordered = $adordered->fetch_assoc()){
						?>
						<tr class="odd gradeX">
							<td><?php echo $ordered['id']; ?></td>
							<td><?php echo $fm->formatdate($ordered['date']); ?></td>
							<td><?php echo $ordered['productName']; ?></td>
							<td><?php echo $ordered['quantity']; ?></td>
							<td>Tk. <?php echo $ordered['price']; ?></td>
							<td><a href="caddress.php?cmrId=<?php echo $ordered['cmrId']; ?>">View</a></td>
							<?php 
							  if($ordered['status'] == '0'){ ?>
                                 <td><a href="?sftconfirm=<?php echo $ordered['cmrId']; ?>&price=<?php echo $ordered['price']; ?>&date=<?php echo $ordered['date']; ?>">Shifted?</a></td>
							 <?php }elseif($ordered['status'] == '1'){ ?>
							 	  <td>Pending</td>
							  <?php }elseif($ordered['status'] == '2'){ ?>
						  		  <td><a href="?did=<?php echo $ordered['cmrId']; ?>&price=<?php echo $ordered['price']; ?>&date=<?php echo $ordered['date']; ?>">Remove?</a></td>
						  	 <?php } ?>
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
