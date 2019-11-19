<?php include 'inc/header.php'; ?>
<?php 
  $cmrlogin = Session::get("cmrLogin");
  if($cmrlogin == false){
  	header("Location: login.php");
  }
?>
<style>
  .tblone{width: 700px; margin: 0 auto; border: 3px solid #ddd;}
  .tblone tr td{text-align: justify;}
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
<?php include 'inc/footer.php'; ?>