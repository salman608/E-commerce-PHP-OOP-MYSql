<?php include 'inc/header.php'; ?>
<?php 
  $cmrlogin = Session::get("cmrLogin");
  if($cmrlogin == false){
  	header("Location: login.php");
  }
?>

<?php 
  if(isset($_GET['confirm'])){
    $orderId = $_GET['confirm'];
    $price   = $_GET['price'];
    $date    = $_GET['date'];

    $shiftcon = $ct->shiftConfirm($cmrId, $price, $date);
  }
?>
<style>
  .notfound h2{font-size: 30px; line-height: 130px; text-align: center;}
  .tblone{width: 1020px; margin: 0 auto; border: 3px solid #ddd;}
  .tblone tr td{text-align: justify;}
  .tblone tr th{text-align: justify;}
</style>
 <div class="main">
    <div class="content">
    	 <div class="section group">
    	 	<div class="notfound">
    	 	   <h2><span>Your Ordered Details</span></h2>	
           <?php 
             if(isset($shiftcon)){
              echo $shiftcon;
             }
           ?>
           <table class="tblone">
             <tr>
               <th>SL</th>
               <th>Product</th>
               <th>Image</th>
               <th>Quantity</th>
               <th>Price</th>
               <th>Date</th>
               <th>Status</th>
               <th>Action</th>
             </tr>

             <?php 
               $cmrId = Session::get("cmrId");
               $allcart = $ct->getAllOrderedPro($cmrId);
               if($allcart){
                 $i = 0;
                 while($cart = $allcart->fetch_assoc()){
                   $i++;
             ?>
             
             <tr>
               <td><?php echo $i; ?></td>
               <td><?php echo $cart['productName']; ?></td>
               <td><img style="height: 40px;  width: 60px;" src="admin/<?php echo $cart['image']; ?>" alt="" /></td>
               <td><?php echo $cart['quantity']; ?></td>
               <td><?php echo $cart['price']; ?></td>
               <td><?php echo $fm->formatdate($cart['date']); ?></td>
               <td>
                <?php
                  if($cart['status'] == '0'){ ?>
                       <a href="">Pending</a>
                 <?php }elseif($cart['status'] == '1'){ ?>
                      <a href="?confirm=<?php echo $cart['cmrId']; ?>&price=<?php echo $cart['price']; ?>&date=<?php echo $cart['date']; ?> ?>">Shifted</a>
                   <?php } else { ?>
                      <a href="">Confirmed</a>
                 <?php } ?> 
               </td>
               <?php 
                if($cart['status'] == '2'){ ?>
                   <td>Remove</td>
                <?php } else{?>
                  <td>N/A</td>
                <?php } ?>
             </tr>
               <?php } } ?>
           </table>
    	 	</div>
    	 </div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>