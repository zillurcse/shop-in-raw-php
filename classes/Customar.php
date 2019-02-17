<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpars/Format.php");
?>
<?php 
/**
 * 
 */
class Customar
{
	
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function customarRegistration($data)
	{
		$name 	  = mysqli_real_escape_string($this->db->link, $data['name']);
		$address  = mysqli_real_escape_string($this->db->link, $data['address']);
		$city     = mysqli_real_escape_string($this->db->link, $data['city']);
		$country  = mysqli_real_escape_string($this->db->link, $data['country']);
		$zip      = mysqli_real_escape_string($this->db->link, $data['zip']);
		$phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email    = mysqli_real_escape_string($this->db->link, $data['email']);
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

			if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $password == "") {

				$msg = "<span><h4 style='color:red'>Fields must not be empty !</h4></span>";
				return $msg;
			}
			$mailquery = "SELECT * FROM `tbl_customar` WHERE `email` = '$email' LIMIT 1";
			$mailchk   = $this->db->select($mailquery);
			if ($mailchk != false) {
				$msg = "<span class='error'><h3 style='color:red' >Email already Exist !</h3></span>";
				return $msg;
			}
			else{
				$query = "INSERT INTO `tbl_customar`(`name`,`address`,`city`,`country`,`zip`,`phone`,`email`,`password`) VALUE('$name','$address','$city','$country','$zip','$phone','$email','$password')";

				$productinsert = $this->db->insert($query);
				if ($productinsert) {
					$msg = "<div class='alert alert-success'><strong>Success!</strong>Customar Data Register Sussfully.
							</div>";
					return $msg;
				}else{
					$msg = "<div class='alert alert-danger'><strong>Error!</strong>Customar Not Register.
							</div>";
					return $msg;
				}
			}
		}

		public function customarLogin($data)
		{
			$email    = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if (empty($email)|| empty($password)) {
				$msg = "<span class='error'><h4 style='color:red' >Email or Password must not be empty !</h></span>";
				return $msg;
			}
			$query = "SELECT * FROM `tbl_customar` WHERE `email`='$email' AND `password`='$password'";
			$result   = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set("custlogin", true);
				Session::set("cmrId", $value['id']);
				Session::set("cmrName", $value['name']);

				echo "<script>window.location = 'cart.php';</script>";
			}
			else{
				$msg = "<span class='error'><h4 style='color:red' >Email or Password not matched !</h4></span>";
				return $msg;
			}
		}

		public function getcustomarData($id)
		{
		$query = "SELECT * FROM `tbl_customar` WHERE id  = '$id'";
		$result = $this->db->select($query);
		return $result;
		}

		public function customarUpdate($data,$cmrId)
		{
			$name 	  = mysqli_real_escape_string($this->db->link, $data['name']);
			$address  = mysqli_real_escape_string($this->db->link, $data['address']);
			$city     = mysqli_real_escape_string($this->db->link, $data['city']);
			$country  = mysqli_real_escape_string($this->db->link, $data['country']);
			$zip      = mysqli_real_escape_string($this->db->link, $data['zip']);
			$phone    = mysqli_real_escape_string($this->db->link, $data['phone']);
			$email    = mysqli_real_escape_string($this->db->link, $data['email']);
		

			if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "") {

				$msg = "<div class='alert alert-danger'><strong>Error!</strong>Fields must not be empty !
						</div>";
				return $msg;
			} else{

				$query = "UPDATE `tbl_customar` 
						  SET 
						  name     = '$name',
						  address  = '$address',
						  city     = '$city',
						  country  = '$country',
						  zip      = '$zip',
						  phone    = '$phone',
						  email    = '$email'
						  WHERE id = '$cmrId'";
				$update_row = $this->db->update($query);
				if ($update_row) {
					$msg = "<div class='alert alert-success'><strong>Success!</strong>Customar Data Update Sussfully.
							</div>";
					return $msg;
				}else{
					$msg = "<div class='alert alert-danger'><strong>Error!</strong>Customar Data Not Update !
							</div>";
					return $msg;

				}
			}
		}






}


?>