<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../lib/Database.php');
  include_once ($filepath.'/../helpers/Format.php');
?>
<?php
  /**
   * Product Class
   */
  class Product
  {
  	private $db;
 	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function productInsert($data, $file)
	{
		$productName = $this->fm->validate($data['productName']);
		$catId       = $this->fm->validate($data['catId']);
		$brandId     = $this->fm->validate($data['brandId']);
		$body        = $this->fm->validate($data['body']);
		$price       = $this->fm->validate($data['price']);
		$type        = $this->fm->validate($data['type']);

		$productName = mysqli_real_escape_string($this->db->link, $productName);
		$catId       = mysqli_real_escape_string($this->db->link, $catId);
		$brandId     = mysqli_real_escape_string($this->db->link, $brandId);
		$body        = mysqli_real_escape_string($this->db->link, $body);
		$price       = mysqli_real_escape_string($this->db->link, $price);
		$type        = mysqli_real_escape_string($this->db->link, $type);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "upload/".$unique_image;

		if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $file_name == "" || $type == ""){
		       echo "<span class='error'>Field must not be empty !</span>";
		  }elseif ($file_size >1048567) {
		       echo "<span class='error'>Image Size should be less then 1MB!
		       </span>";
		  }elseif (in_array($file_ext, $permited) === false) {
		       echo "<span class='error'>You can upload only:-"
		       .implode(', ', $permited)."</span>";
		  }else{
		      move_uploaded_file($file_temp, $uploaded_image);
		      $query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type) 
		      VALUES('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type')";
		      $inserted_rows = $this->db->insert($query);
		      if ($inserted_rows) {
		           echo "<span class='success'>Post Added Successfully.
		           </span>";
		      }else {
		           echo "<span class='error'>Post Not Added !</span>";
		      }
		}
	}

	public function getAllProduct()
	{
		$query = "SELECT p.*,c.catName,b.brandName
                  FROM tbl_product as p,tbl_category as c,tbl_brand as b
                  WHERE p.catId = c.catId AND p.brandId = b.brandId
                  ORDER BY p.productId DESC";
		// $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
		//           FROM tbl_product
		//           INNER JOIN tbl_category
		//           ON tbl_product.catId = tbl_category.catId
		//           INNER JOIN tbl_brand
		//           ON tbl_product.brandId = tbl_brand.brandId
		//           ORDER BY tbl_product.productId DESC";
		$allproduct = $this->db->select($query);
		return $allproduct;
	}

	public function getProById($id)
	{
		$query  = "SELECT * FROM tbl_product WHERE productId='$id'";
  		$getpro = $this->db->select($query);
  		return $getpro;
	}

	public function getProByCat($catId)
	{
		$catId  = mysqli_real_escape_string($this->db->link, $catId);
		$query  = "SELECT * FROM tbl_product WHERE catId='$catId' ORDER BY productId DESC";
  		$getpro = $this->db->select($query);
  		return $getpro;
	}

	public function productUpdate($data, $file, $id)
	{
		$productName = $this->fm->validate($data['productName']);
		$catId       = $this->fm->validate($data['catId']);
		$brandId     = $this->fm->validate($data['brandId']);
		$body        = $this->fm->validate($data['body']);
		$price       = $this->fm->validate($data['price']);
		$type        = $this->fm->validate($data['type']);

		$productName = mysqli_real_escape_string($this->db->link, $productName);
		$catId       = mysqli_real_escape_string($this->db->link, $catId);
		$brandId     = mysqli_real_escape_string($this->db->link, $brandId);
		$body        = mysqli_real_escape_string($this->db->link, $body);
		$price       = mysqli_real_escape_string($this->db->link, $price);
		$type        = mysqli_real_escape_string($this->db->link, $type);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "upload/".$unique_image;

		if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == ""){
		       echo "<span class='error'>Field must not be empty !</span>";
		  }else{
             if(!empty($file_name)){
                if($file_size >1048567){
                     echo "<span class='error'>Image Size should be less then 1MB!
                     </span>";
                }elseif(in_array($file_ext, $permited) === false) {
                     echo "<span class='error'>You can upload only:-"
                     .implode(', ', $permited)."</span>";
                }else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product
                              SET
                              productName = '$productName',
                              catId       = '$catId',
                              brandId     = '$brandId',
                              body        = '$body',
                              price       = '$price',
                              image       = '$uploaded_image',
                              type        = '$type'
                              WHERE productId = '$id'";
                    $updated_rows = $this->db->update($query);
                    if($updated_rows) {
                         echo "<span class='success'>Post Updated Successfully.
                         </span>";
                    }else{
                         echo "<span class='error'>Post Not Updated !</span>";
                    }
                }    
             }else{
                  $query = "UPDATE tbl_product
                            SET
                            productName = '$productName',
                            catId       = '$catId',
                            brandId     = '$brandId',
                            body        = '$body',
                            price       = '$price',
                            type        = '$type'
                            WHERE productId = '$id'";
                  $updated_rows = $this->db->update($query);
                  if($updated_rows) {
                       echo "<span class='success'>Post Updated Successfully.
                       </span>";
                  }else{
                       echo "<span class='error'>Post Not Updated !</span>";
                  }  
             }
		  }
	}

	public function delProById($id)
	{
		$query  = "SELECT * FROM tbl_product WHERE productId='$id'";
		$getpro = $this->db->select($query);
		if($getpro){
			while($delimg = $getpro->fetch_assoc()){
				$dellink = $delimg['image'];
				unlink($dellink);
			}
		}

		$delquery  = "DELETE FROM tbl_product WHERE productId='$id'";
		$delpro = $this->db->delete($delquery); 
		if($delpro){
			$msg = "<span class='success'>Product Deleted Successfully!</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Product Not Deleted!</span>";
			return $msg;
		}
	}

	public function getfpd()
	{
		$query  = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
		$getpro = $this->db->select($query);
		return $getpro;

	}
	public function getnpd()
	{
		$query   = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
		$getnpro = $this->db->select($query);
		return $getnpro;
	}

	public function getProDetails($id)
	{
		$query  ="SELECT p.*, c.catName, b.brandName
		          FROM tbl_product as p, tbl_category as c, tbl_brand as b
		          WHERE p.productId = '$id' AND p.catId = c.catId AND p.brandId = b.brandId";
		$getpro = $this->db->select($query);
		return $getpro;
	}

	public function latesFromIphone()
	{
		$query   = "SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productId DESC LIMIT 1";
		$getnpro = $this->db->select($query);
		return $getnpro;
	}

	public function latesFromXiaomi()
	{
		$query   = "SELECT * FROM tbl_product WHERE brandId='6' ORDER BY productId DESC LIMIT 1";
		$getnpro = $this->db->select($query);
		return $getnpro;
	}

	public function latesFromSamsung()
	{
		$query   = "SELECT * FROM tbl_product WHERE brandId='2' ORDER BY productId DESC LIMIT 1";
		$getnpro = $this->db->select($query);
		return $getnpro;
	}

	public function latesFromDell()
	{
		$query   = "SELECT * FROM tbl_product WHERE brandId='8' ORDER BY productId DESC LIMIT 1";
		$getnpro = $this->db->select($query);
		return $getnpro;
	}
	public function insertCompareData($cmrId, $cmprid)
	{
		$cmrId        = $this->fm->validate($cmrId);
		$productId    = $this->fm->validate($cmprid);

		$cmrId     = mysqli_real_escape_string($this->db->link, $cmrId);
		$productId = mysqli_real_escape_string($this->db->link, $productId);

		$cquery  = "SELECT * FROM tbl_compare WHERE cmrId='$cmrId' AND productId='$productId'";
		$chkdata = $this->db->select($cquery);
		if($chkdata){
			$msg = "<span class='error'>Already Added To Compare !</span>";
			return $msg;
		}

		$query   = "SELECT * FROM tbl_product WHERE productId='$productId'";
		$cart = $this->db->select($query)->fetch_assoc();
		if($cart){
			
				$productId   = $cart['productId'];
				$productName = $cart['productName'];
				$price       = $cart['price']; 
				$image       = $cart['image'];

				$query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) 
				VALUES('$cmrId', '$productId', '$productName', '$price', '$image')";
				$inserted_rows = $this->db->insert($query);
				if($inserted_rows){
					$msg = "<span class='success'>Product Added To Compare !</span>";
					return $msg;
				}else{
					$msg = "<span class='error'>Product Not Added To Compare!</span>";
					return $msg;
				}
	
		}

	 }

	 public function getComparedData($customerId)
	 {
	 	$query  = "SELECT * FROM tbl_compare WHERE cmrId='$customerId' ORDER BY id DESC";
	 	$result = $this->db->select($query);
	 	return $result;
	 }
	 public function delComparedData($cmrId)
	 {
	 	$query  = "DELETE FROM tbl_compare WHERE cmrId='$cmrId'";
	 	$delpro = $this->db->delete($query); 
	 }

     public function insertWishlistData($cmrId, $id)
     {
     	$cmrId     = $this->fm->validate($cmrId);
     	$productId = $this->fm->validate($id);

     	$cmrId     = mysqli_real_escape_string($this->db->link, $cmrId);
     	$productId = mysqli_real_escape_string($this->db->link, $productId);

     	$cquery  = "SELECT * FROM tbl_wlist WHERE cmrId='$cmrId' AND productId='$productId'";
     	$chkdata = $this->db->select($cquery);
     	if($chkdata){
     		$msg = "<span class='error'>Already Added To Wishlist !</span>";
     		return $msg;
     	}

     	$query   = "SELECT * FROM tbl_product WHERE productId='$productId'";
     	$cart = $this->db->select($query)->fetch_assoc();
     	if($cart){
     		
     			$productId   = $cart['productId'];
     			$productName = $cart['productName'];
     			$price       = $cart['price']; 
     			$image       = $cart['image'];

     			$query = "INSERT INTO tbl_wlist(cmrId, productId, productName, price, image) 
     			VALUES('$cmrId', '$productId', '$productName', '$price', '$image')";
     			$inserted_rows = $this->db->insert($query);
     			if($inserted_rows){
     				$msg = "<span class='success'>Product Added To Wishlist !</span>";
     				return $msg;
     			}else{
     				$msg = "<span class='error'>Product Not Added To Wishlist!</span>";
     				return $msg;
     			}
     	
     	}

     }
     public function getWishlistData($customerId)
     {
     	$query  = "SELECT * FROM tbl_wlist WHERE cmrId='$customerId' ORDER BY id DESC";
     	$result = $this->db->select($query);
     	return $result;
     }
     public function delWishlistdData($cmrId, $productId)
     {
     	$query = "DELETE FROM tbl_wlist WHERE cmrId='$cmrId' AND productId='$productId'";
     	$delwl = $this->db->delete($query);
     	if($delwl){
     		$msg = "<span class='success'>Product Removed From Wishlist !</span>";
     		return $msg;
     	}else{
     		$msg = "<span class='error'>Product Not Removed From Wishlist !</span>";
     		return $msg;
     	}
     }
  }
 ?>