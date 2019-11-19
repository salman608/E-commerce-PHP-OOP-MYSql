<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../lib/Database.php');
  include_once ($filepath.'/../helpers/Format.php');
?>
<?php
 /**
  * Customer Class
  */
 class Customer
 { 
 	private $db;
 	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function customerRegistration($data)
	{
		$name    = $this->fm->validate($data['name']);
		$address = $this->fm->validate($data['address']);
		$city    = $this->fm->validate($data['city']);
		$country = $this->fm->validate($data['country']);
		$zip     = $this->fm->validate($data['zip']);
		$phone   = $this->fm->validate($data['phone']);
		$email   = $this->fm->validate($data['email']);
		$pass    = $this->fm->validate($data['pass']);

		$name    = mysqli_real_escape_string($this->db->link, $name);
		$address = mysqli_real_escape_string($this->db->link, $address);
		$city    = mysqli_real_escape_string($this->db->link, $city);
		$country = mysqli_real_escape_string($this->db->link, $country);
		$zip     = mysqli_real_escape_string($this->db->link, $zip);
		$phone   = mysqli_real_escape_string($this->db->link, $phone);
		$email   = mysqli_real_escape_string($this->db->link, $email);
		$pass    = mysqli_real_escape_string($this->db->link, md5($pass));

		if($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $pass == ""){
		       $msg = "<span class='error'>Field must not be empty !</span>";
		       return $msg;
		  }
		  $chkquery = "SELECT * FROM tbl_customer WHERE email='$email'";
		  $chkemail = $this->db->select($chkquery);
		  if($chkemail){
              $msg = "<span class='error'>Email already Exist!</span>";
              return $msg;
		  }else{
		      $query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, pass) 
		      VALUES('$name', '$address', '$city', '$country', '$zip', '$phone', '$email', '$pass')";
		      $inserted_rows = $this->db->insert($query);
		      if ($inserted_rows) {
		           echo "<span class='success'>Customer Registered Successfully.
		           </span>";
		      }else {
		           echo "<span class='error'>Customer Not Registered !</span>";
		      }
		}
	}

	public function customerLogin($data)
	{
		$email   = $this->fm->validate($data['email']);
		$pass    = $this->fm->validate($data['pass']);

		$email   = mysqli_real_escape_string($this->db->link, $email);
		$pass    = mysqli_real_escape_string($this->db->link, md5($pass));
		if(empty($email) || empty($pass)){
			$msg = "<span class='error'>Field must not be empty !</span>";
			return $msg;
		}

		$query  = "SELECT * FROM tbl_customer WHERE email='$email' AND pass='$pass'";
		$chkcmr = $this->db->select($query);
		if($chkcmr){
			$cmr = $chkcmr->fetch_assoc();
			Session::set("cmrLogin", true);
			Session::set("cmrId", $cmr['id']);
			Session::set("cmrName", $cmr['name']);		
			Session::set("cmrEmail", $cmr['email']);		
            header("Location: cart.php");
		}else{
             $msg = "<span class='error'>Email Or Password  not matched !</span>";
             return $msg;
		}
	}

	public function customerData($customerId)
	{
		$query  = "SELECT * FROM tbl_customer WHERE id='$customerId'";
  		$getcmr = $this->db->select($query);
  		return $getcmr;
	}

	public function customerUpdate($data, $cmrId, $cmrEmail)
	{
		$name    = $this->fm->validate($data['name']);
		$address = $this->fm->validate($data['address']);
		$city    = $this->fm->validate($data['city']);
		$country = $this->fm->validate($data['country']);
		$zip     = $this->fm->validate($data['zip']);
		$phone   = $this->fm->validate($data['phone']);
		$email   = $this->fm->validate($data['email']);

		$name    = mysqli_real_escape_string($this->db->link, $name);
		$address = mysqli_real_escape_string($this->db->link, $address);
		$city    = mysqli_real_escape_string($this->db->link, $city);
		$country = mysqli_real_escape_string($this->db->link, $country);
		$zip     = mysqli_real_escape_string($this->db->link, $zip);
		$phone   = mysqli_real_escape_string($this->db->link, $phone);
		$email   = mysqli_real_escape_string($this->db->link, $email);

		if($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == ""){
		       $msg = "<span class='error'>Field must not be empty !</span>";
		       return $msg;
		  }
		  $chkquery = "SELECT * FROM tbl_customer WHERE email='$email'";
		  $chkemail = $this->db->select($chkquery);
		  if($chkemail){
		  	  $ddemail = $chkemail->fetch_assoc();
		  	  if($ddemail['email'] == $cmrEmail){
                  $query = "UPDATE tbl_customer
                            SET 
                            name    = '$name',
                            address = '$address',
                            city    = '$city',
                            country = '$country',
                            zip     = '$zip',
                            phone   = '$phone', 
                            email   = '$email'
                            WHERE id='$cmrId'";
                  $updated_rows = $this->db->update($query);
                  if ($updated_rows){
                       $msg = "<span class='success'>Profile Updated Successfully !</span>";
                       return $msg;
                  }else{
                       $msg = "<span class='error'>Profile Not Updated !</span>";
                       return $msg;
                  }
		  	  }else{
		  	  	$msg = "<span class='error'>Email already Exist!</span>";
                return $msg;
		  	  }
              
		  }else{
		  	  $query = "UPDATE tbl_customer
		  	            SET 
		  	            name    = '$name',
		  	            address = '$address',
		  	            city    = '$city',
		  	            country = '$country',
		  	            zip     = '$zip',
		  	            phone   = '$phone', 
		  	            email   = '$email'
		  	            WHERE id='$cmrId'";
		  	  $updated_rows = $this->db->update($query);
		  	  if ($updated_rows){
		  	  	   Session::set("cmrEmail", $email);
		  	       $msg = "<span class='success'>Profile Updated Successfully !</span>";
		  	       return $msg;
		  	  }else {
		  	       $msg = "<span class='error'>Profile Not Updated !</span>";
		  	       return $msg;
		  	  }
		  }
	}
	public function getCmrById($id)
	{
		$query = "SELECT * FROM tbl_customer WHERE id='$id'";
		$custadd = $this->db->select($query);
		return $custadd;
	}
 }
 ?>