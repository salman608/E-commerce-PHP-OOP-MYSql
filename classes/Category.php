<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../lib/Database.php');
  include_once ($filepath.'/../helpers/Format.php');
?>
<?php
  /**
   * Category Class
   */
  class Category
  {
  	private $db;
    private $fm;

  	public function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  	}

  	public function catInsert($catName)
  	{
  		$catName = $this->fm->validate($catName);
    	$catName = mysqli_real_escape_string($this->db->link, $catName);

    	if(empty($catName)){
    		$msg = "<span class='error'>Category must not be empty!</span>";
    		return $msg;
    	}else{
    		$query  = "INSERT INTO tbl_category(catName) VALUES('$catName')";
    		$result = $this->db->insert($query);
    		if($result){
    			$msg = "<span class='success'>Category Inserted Successfully!</span>";
    			return $msg;
    		}else{
    			$msg = "<span class='error'>Category Not Inserted!</span>";
    			return $msg;
    		}
    	}
  	}
  	public function catList()
  	{
  		$query  = "SELECT * FROM tbl_category ORDER BY catId DESC";
  		$getcat = $this->db->select($query);
  		return $getcat;
  	}

  	public function getCatById($id)
  	{
  		$query  = "SELECT * FROM tbl_category WHERE catId='$id'";
  		$getcat = $this->db->select($query);
  		return $getcat;
  	}

	public function catUpdate($catName, $id)
	{
		$catName = $this->fm->validate($catName);
  	    $catName = mysqli_real_escape_string($this->db->link, $catName);

  	if(empty($catName)){
  		$msg = "<span class='error'>Category must not be empty!</span>";
  		return $msg;
  	}else{
  		$query  = "UPDATE tbl_category
                   SET
                   catName = '$catName'
                   WHERE catId='$id'
  		           ";
  		$result = $this->db->update($query);
  		if($result){
  			$msg = "<span class='success'>Category Updated Successfully!</span>";
  			return $msg;
  		}else{
  			$msg = "<span class='error'>Category Not Updated!</span>";
  			return $msg;
  		}
  	}
	}

	public function delCatById($id)
	{
		$query  = "DELETE FROM tbl_category WHERE catId='$id'";
		$delcat = $this->db->delete($query);
		if($delcat){
			$msg = "<span class='success'>Category Deleted Successfully!</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Category Not Deleted!</span>";
			return $msg;
		}
	}
  }
 ?>