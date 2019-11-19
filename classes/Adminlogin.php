<?php
      $filepath = realpath(dirname(__FILE__));
      include_once ($filepath.'/../lib/Session.php');
      Session::checkLogin();
      include_once ($filepath.'/../lib/Database.php');
      include_once ($filepath.'/../helpers/Format.php');
      
?>
<?php
  /**
   * admin login class
   */
  class Adminlogin
  { 
    private $db;
    private $fm;

  	public function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  	}
     
    public function adminLogin($adminUser, $adminPass)
    {
    	$adminUser = $this->fm->validate($adminUser);
    	$adminPass = $this->fm->validate($adminPass);

    	$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
    	$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

    	if(empty($adminUser) || empty($adminPass)){
    		$loginmsg = "Username Or Password must not be empty!";
    	}
    	else{
    		$query = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'";
    		$dbchk = $this->db->select($query);
    		if($dbchk){
    			while($result = $dbchk->fetch_assoc()){
    				Session::set("adminlogin", true);
    				Session::set("adminId", $result['adminId']);
    				Session::set("adminUser", $result['adminUser']);
    				Session::set("adminName", $result['adminName']);
    				header("Location: dashboard.php");
    			}
    		}else{
    			$loginmsg = "Username or Password not matched";
    		}
    	}
    }
  }

 ?>