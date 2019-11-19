<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../lib/Database.php');
  include_once ($filepath.'/../helpers/Format.php');
?>
<?php
 /**
  * Cart Class
  */
 class Cart
 { 
 	private $db;
 	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function addToCart($quantity, $id)
	{
		$quantity  = $this->fm->validate($quantity);
		$quantity  = mysqli_real_escape_string($this->db->link, $quantity);
		$productId = mysqli_real_escape_string($this->db->link, $id);
		$sId       = Session_id();

		$query  = "SELECT * FROM tbl_product WHERE productId='$productId'";
		$result = $this->db->select($query)->fetch_assoc();
		
		$productName = $result['productName'];
		$price       = $result['price'];
		$image       = $result['image'];

		$checkquery   = "SELECT * FROM tbl_cart WHERE productId='$productId' AND sId='$sId'";
		$existproduct = $this->db->select($checkquery);
		if($existproduct){
			$msg = "Product Already Added !";
			return $msg;
		}else{
            $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) 
            VALUES('$sId', '$productId', '$productName', '$price', '$quantity', '$image')";
            $inserted_rows = $this->db->insert($query);
            if ($inserted_rows) {
                 header("Location: cart.php");
            }else {
                 header("Location: 404.php");
            }
		}
	}

	public function getAllCartPro()
	{
		$sId    = Session_id();
		$query  = "SELECT * FROM tbl_cart WHERE sId='$sId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function updateCart($quantity, $cartId)
	{
		$cartId   = $this->fm->validate($cartId);
		$quantity = $this->fm->validate($quantity);

		$cartId   = mysqli_real_escape_string($this->db->link, $cartId);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);

		$query = "UPDATE tbl_cart
		          SET
		          quantity = '$quantity'
		          WHERE cartId = '$cartId'";
		$uquan = $this->db->update($query);
		if($uquan){
			header("Location: cart.php");
		}else{
			$msg = "Quantity Not Updated !";
			return $msg;
		}
	}

	public function delFromCart($id)
	{
		$delquery  = "DELETE FROM tbl_cart WHERE cartId='$id'";
		$delcart = $this->db->delete($delquery); 
		if($delcart){
			echo "<script>window.location = 'cart.php';</script>";
		}else{
			$msg = "<span class='error'>Product Not Deleted From Cart!</span>";
			return $msg;
		}
	}
	public function delCustomerCart()
	{
		$sId      = Session_id();
		$delquery = "DELETE FROM tbl_cart WHERE sId='$sId'";
		$delcart  = $this->db->delete($delquery);
	}

	public function addToOrder($cmrId)
	{
		$sId     = Session_id();
		$query   = "SELECT * FROM tbl_cart WHERE sId='$sId'";
		$allcart = $this->db->select($query);
		if($allcart){
			while ($cart = $allcart->fetch_assoc()) {
				$productId   = $cart['productId'];
				$productName = $cart['productName'];
				$quantity    = $cart['quantity'];
				$price       = $cart['price'] * $quantity; 
				$image       = $cart['image'];

				$query = "INSERT INTO tbl_order(cmrId, productId, productName, quantity, price, image) 
				VALUES('$cmrId', '$productId', '$productName', '$quantity', '$price', '$image')";
				$inserted_rows = $this->db->insert($query);

			}
		}
	}

	public function payableAmount($cmrId)
	{
		$query  = "SELECT * FROM tbl_order WHERE cmrId='$cmrId' AND date=now()";
		$result = $this->db->select($query);
		return $result;
	}

	public function getAllOrderedPro($cmrId)
	{
		$query  = "SELECT * FROM tbl_order WHERE cmrId='$cmrId' ORDER BY date DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function getOrdered($cmrId)
	{
		$query  = "SELECT * FROM tbl_order WHERE cmrId='$cmrId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function adOrdered()
	{
		$query  = "SELECT * FROM tbl_order ORDER BY date DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function shiftProduct($cmrId, $price, $date)
	{
		$cmrId   = $this->fm->validate($cmrId);
		$price   = $this->fm->validate($price);
		$date    = $this->fm->validate($date);

		$cmrId   = mysqli_real_escape_string($this->db->link, $cmrId);
		$price   = mysqli_real_escape_string($this->db->link, $price);
		$date    = mysqli_real_escape_string($this->db->link, $date);

		$query = "UPDATE tbl_order
		          SET
		          status = '1'
		          WHERE cmrId = '$cmrId' AND price = '$price' AND date = '$date'";
		$uquan = $this->db->update($query);
		if($uquan){
			$msg = "Status Updated !";
						return $msg;
		}else{
			$msg = "Status Not Updated !";
			return $msg;
		}
	}

	public function shiftConfirm($cmrId, $price, $date)
	{
		$cmrId   = $this->fm->validate($cmrId);
		$price   = $this->fm->validate($price);
		$date    = $this->fm->validate($date);

		$cmrId   = mysqli_real_escape_string($this->db->link, $cmrId);
		$price   = mysqli_real_escape_string($this->db->link, $price);
		$date    = mysqli_real_escape_string($this->db->link, $date);

		$query = "UPDATE tbl_order
		          SET
		          status = '2'
		          WHERE cmrId = '$cmrId' AND price = '$price' AND date = '$date'";
		$uquan = $this->db->update($query);
		if($uquan){
			$msg = "Confirmed Updated !";
			return $msg;
		}else{
			$msg = "Confirmed Not Updated !";
			return $msg;
		}
	}

 }
 ?>