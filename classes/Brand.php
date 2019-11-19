<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../lib/Database.php');
  include_once ($filepath.'/../helpers/Format.php');
?>
<?php
 /**
  * Brand Class
  */
 class Brand
 {
 	private $db;
 	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function brandInsert($brandName)
	{
		$brandName = $this->fm->validate($brandName);
  	    $brandName = mysqli_real_escape_string($this->db->link, $brandName);

	  	if(empty($brandName)){
	  		$msg = "<span class='error'>Brand must not be empty!</span>";
	  		return $msg;
	  	}else{
	  		$query  = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
	  		$result = $this->db->insert($query);
	  		if($result){
	  			$msg = "<span class='success'>Brand Inserted Successfully!</span>";
	  			return $msg;
	  		}else{
	  			$msg = "<span class='error'>Brand Not Inserted!</span>";
	  			return $msg;
	  		}
	  	}
	}

	public function brandList()
	{
		$query  = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
		$getbrand = $this->db->select($query);
		return $getbrand;
	}

	public function getBrandById($id)
	{
		$query    = "SELECT * FROM tbl_brand WHERE brandId='$id'";
		$getbrand = $this->db->select($query);
		return $getbrand;
	}

	public function brandUpdate($brandName, $id)
	{
		$brandName = $this->fm->validate($brandName);
  	    $brandName = mysqli_real_escape_string($this->db->link, $brandName);

	  	if(empty($brandName)){
	  		$msg = "<span class='error'>Brand must not be empty!</span>";
	  		return $msg;
	  	}else{
	  		$query  = "UPDATE tbl_brand
	                   SET
	                   brandName = '$brandName'
	                   WHERE brandId='$id'
	  		           ";
	  		$result = $this->db->update($query);
	  		if($result){
	  			$msg = "<span class='success'>Brand Updated Successfully!</span>";
	  			return $msg;
	  		}else{
	  			$msg = "<span class='error'>Brand Not Updated!</span>";
	  			return $msg;
	  		}
	  	}
	}

	public function delBrandById($id)
	{
		$query  = "DELETE FROM tbl_brand WHERE brandId='$id'";
		$delbrand = $this->db->delete($query);
		if($delbrand){
			$msg = "<span class='success'>Brand Deleted Successfully!</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Brand Not Deleted!</span>";
			return $msg;
		}
	}
 }
?>