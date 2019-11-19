<?php include 'inc/header.php'; ?>
<?php 
  $cmrlogin = Session::get("cmrLogin");
  if($cmrlogin == false){
  	header("Location: login.php");
  }
?>
<?php 
  $customerId = Session::get("cmrId");
  $cmrEmail   = Session::get("cmrEmail");
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $cmrupdate = $cmr->customerUpdate($_POST, $customerId, $cmrEmail);
  }
?>
<style>
  .tblone{width: 700px; margin: 0 auto; border: 3px solid #ddd;}
  .tblone tr td{text-align: justify;}
  .tblone input[type="text"]{width: 700px; padding: 5px; font-size: 16px;}
</style>
 <div class="main">
    <div class="content">
    	 <div class="section group">
         <?php 
           $customerId   = Session::get("cmrId");
           $customerData = $cmr->customerData($customerId);
           if($customerData){
            while($cdata = $customerData->fetch_assoc()){
         ?>
         <form action="" method="post">
    	 	  <table class="tblone">
            <?php 
              if(isset($cmrupdate)){
                echo "<tr><td colspan='2'>".$cmrupdate."</td></tr>";
              }
            ?>
             <tr>
               <td colspan="2"><h2>Update Profile Details</h2></td>
             </tr>
             <tr>
               <td width="20%;">Name</td>
               <td><input type="text" name="name" value="<?php echo $cdata['name']; ?>"></td>
             </tr>
             <tr>
               <td>Address</td>
               <td><input type="text" name="address" value="<?php echo $cdata['address']; ?>"></td>
             </tr>
             <tr>
               <td>City</td>
               <td><input type="text" name="city" value="<?php echo $cdata['city']; ?>"></td>
             </tr>
             <tr>
               <td>Country</td>
               <td><input type="text" name="country" value="<?php echo $cdata['country']; ?>"></td>
             </tr>
             <tr>
               <td>Zip</td>
               <td><input type="text" name="zip" value="<?php echo $cdata['zip']; ?>"></td>
             </tr>
             <tr>
               <td>Phone</td>
               <td><input type="text" name="phone" value="<?php echo $cdata['phone']; ?>"></td>
             </tr>
             <tr>
               <td>Email</td>
               <td><input type="text" name="email" value="<?php echo $cdata['email']; ?>"></td>
             </tr>
             <tr>
               <td></td>
               <td><input type="submit" name="submit" value="Save"></td>
             </tr>
          </table>
         </form>
          <?php } } ?>
    	 </div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>