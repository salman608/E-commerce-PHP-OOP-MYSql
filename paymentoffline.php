<?php include 'inc/header.php'; ?>
<?php 
  $cmrlogin = Session::get("cmrLogin");
  if($cmrlogin == false){
  	header("Location: login.php");
  }
?>
<?php 
  if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
      $cmrId = Session::get("cmrId");
      $addtoorder = $ct->addToOrder($cmrId);
      $delcart = $ct->delCustomerCart();
      header("Location: success.php");
  }
?>
<style>
  .division{width: 50%; float: left;}
  .tblone{width: 720px; margin: 0 auto; border: 3px solid #ddd;}
  .tblone tr td{text-align: justify;}
  .tblone tr th{text-align: justify;}
  .tbltwo{float:right;text-align:left; width: 70%; border: 2px solid #ddd; margin-right: 14px; margin-top: 12px;}
  .tbltwo tr td{text-align: justify;}
  .ordernow{ padding-bottom: 30px; }
  .ordernow a{width: 200px; margin: 20px auto 0; text-align: center; padding: 5px; font-size: 30px; display: block; background: #ff0000; color: #fff; border-radius: 5px;}
</style>
 <div class="main">
    <div class="content">
    	 <div class="section group">
    	 	 <div class="division">
            <table class="tblone">
              <tr>
                <th>SL</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
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
                <td><?php echo $i; ?></td>
                <td><?php echo $cart['productName']; ?></td>
                <td><?php echo $cart['price']; ?></td>
                <td><?php echo $cart['quantity']; ?></td>
                <td><?php 
                  $total = $cart['price'] * $cart['quantity'];
                  echo $total; ?> 
                </td>
              </tr>
              <?php 
                $Qty = $Qty + $cart['quantity'];
                $sum = $sum + $total;
              ?>
                <?php } } ?>
            </table>
            <table class="tbltwo">
              <tr>
                <td>Sub Total</td>
                <td>:</td>
                <td>TK. <?php echo $sum; ?></td>
              </tr>
              <tr>
                <td>VAT</td>
                <td>:</td>
                <td>10% (Tk. <?php echo $vat = $sum * 0.1; ?>)</td>
              </tr>
              <tr>
                <td>Grand Total</td>
                <td>:</td>
                <td>TK. 
                  <?php 
                    $vat = $sum * 0.1;
                    echo $gt = $sum + $vat;
                    ?> 
                 </td>
              </tr>
              <tr>
                <td>Quantity</td>
                <td>:</td>
                <td><?php echo $Qty; ?></td>
              </tr>
             </table> 
         </div>
         <div class="division">
          <?php 
            $customerId   = Session::get("cmrId");
            $customerData = $cmr->customerData($customerId);
            if($customerData){
             while($cdata = $customerData->fetch_assoc()){
          ?>
          <table class="tblone">
              <tr>
                <td colspan="3"><h2>Your Profile Details</h2></td>
              </tr>
              <tr>
                <td width="20%;">Name</td>
                <td width="5%;">:</td>
                <td><?php echo $cdata['name']; ?></td>
              </tr>
              <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $cdata['address']; ?></td>
              </tr>
              <tr>
                <td>City</td>
                <td>:</td>
                <td><?php echo $cdata['city']; ?></td>
              </tr>
              <tr>
                <td>Country</td>
                <td>:</td>
                <td><?php echo $cdata['country']; ?></td>
              </tr>
              <tr>
                <td>Zip</td>
                <td>:</td>
                <td><?php echo $cdata['zip']; ?></td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>:</td>
                <td><?php echo $cdata['phone']; ?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $cdata['email']; ?></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td><a style="color: green;" href="editprofile.php">Update Details</a></td>
              </tr>
           </table>
           <?php } } ?>
         </div>
    	 </div>
    </div>
    <div class="ordernow"><a href="?orderid=order">Order</a></div>
 </div>
<?php include 'inc/footer.php'; ?>