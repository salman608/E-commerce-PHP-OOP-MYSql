<?php include 'inc/header.php'; ?>
<?php 
  $cmrlogin = Session::get("cmrLogin");
  if($cmrlogin == true){
  	header("Location: order.php");
  }
?>
<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
  	$cmrlogin = $cmr->customerLogin($_POST);
  }
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
    	 	<?php 
                if(isset($cmrlogin)){
                	echo $cmrlogin;
                }
    	 	?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post">
            	<input name="email" type="text" placeholder="Email">
                <input name="pass" type="password" placeholder="Password">
                <div class="buttons"><div><button name="login" class="grey">Sign In</button></div></div>
            </form>                  
         </div>
                    
    	<div class="register_account">
    		<?php 
    		  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
    		  	$cmrreg = $cmr->customerRegistration($_POST);
    		  }
    		?>
		 	<?php 
	            if(isset($cmrreg)){
	            	echo $cmrreg;
	            }
		 	?>
    		<h3>Register New Account</h3>
    		<form accept="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Zip-Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="E-Mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		    <div>
							<input type="text" name="country" placeholder="Country">
						</div>	 
		    		    <div>
							<input type="text" name="phone" placeholder="Phone">
						</div>      
				  
						<div>
							<input type="text" name="pass" placeholder="Password" >
						</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button name="register" class="grey">Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>
   