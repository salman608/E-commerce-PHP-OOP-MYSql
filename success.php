<?php include 'inc/header.php'; ?>
<?php 
  $cmrlogin = Session::get("cmrLogin");
  if($cmrlogin == false){
  	header("Location: login.php");
  }
?>
<style>
  .psuccess{width: 500px; min-height: 200px; text-align: center; border: 3px solid #ddd; margin: 0 auto; padding: 50px;}
  .psuccess h2{border-bottom: 1px solid #ddd; margin-bottom: 40px; padding-bottom: 10px;}
  .psuccess p{font-size: 18px; line-height: 25px; text-align: left;}
</style>
 <div class="main">
    <div class="content">
    	 <div class="section group"> 
    	 	<div class="psuccess">
    	 	   <h2>Success</h2>
           <?php 
             $cmrId  = Session::get('cmrId');
             $amount = $ct->payableAmount($cmrId);
             if($amount){
              $sum=0;
              while ($am = $amount->fetch_assoc()) {
                $price = $am['price'];
                $sum = $sum+$price;
              }
             }
           ?>
           <p style="color: red;">Total Payable(Including Vat) : 
             <?php 
               $vat   = $sum*0.1;
               $total = $sum+$vat;
               echo $total;
             ?> Taka
           </p>
           <p>Thanks for purchase. Your order is successfull. We will contact with you as soon as possible with delivery details. Here is your order details... <a href="orderdetails.php">Visit here</a></p>
    	 	</div>
    	 </div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>