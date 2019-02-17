<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpars/Format.php");

?>
<?php 
/**
 * 
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
		$quantity    = $this->fm->validation($quantity);
		$quantity    = mysqli_real_escape_string($this->db->link, $quantity);
		$productId   = mysqli_real_escape_string($this->db->link, $id);
		$sId	     = session_id();

		$selectquery = "SELECT * FROM product_add_info WHERE productId='$productId'";
		$result      = $this->db->select($selectquery)->fetch_assoc();
		$productName = $result['productName'];
		$price 		 = $result['price'];
		$image		 = $result['image'];

		$Chkquery = "SELECT * FROM cart_info WHERE productId='$productId' AND sId = '$sId'";
		$getPro      = $this->db->select($Chkquery);
		if ($getPro) {
			$msg = "Product Already Added";
			return $msg;
		}else{


			$query  = "INSERT INTO `cart_info`(`sId`,`productId`,`productName`,`price`,`quantity`,`image`) VALUE('$sId','$productId','$productName','$price','$quantity','$image')";

			$productinsert = $this->db->insert($query);
			if ($productinsert) {
				echo "<script>
				location='cart.php';
				</script>";
			}else{ 
				echo "<script>
				location='404.php';
				</script>";
			}
		}
	}

	public function getCartProduct()
	{
		$sId	= session_id();
		$query = " SELECT * FROM `cart_info` WHERE sId  = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function updateToCartQuantity($cartId, $quantity)
	{
		$cartId = mysqli_real_escape_string($this->db->link, $cartId);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);

		$query = "UPDATE `cart_info` SET quantity = '$quantity'WHERE cartId = '$cartId'";
		$update_row = $this->db->update($query);
		if ($update_row) {
			echo "<script>
				location='cart.php';
				</script>";
		}else{
			$msg = "<span class='error'>Quantity Not Update !</span>";
			return $msg;
		}
	}

	public function delProductByCart($delId)
	{
		$delId = mysqli_real_escape_string($this->db->link, $delId);
		$query = "DELETE FROM `cart_info` WHERE cartId = '$delId'";
		$delete_data = $this->db->delete($query);
		if ($delete_data) {
			echo "<script>
			location='cart.php';
			</script>";
		}else{ 
			$msg = "<span class='error'>Product Not Delete !</span>";
			return $msg;
		}
	}

	public function checkCartTable()
	{
		$sId	= session_id();
		$query = " SELECT * FROM `cart_info` WHERE sId  = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function delCustomarCart()
	{
		$sId    = session_id();
		$query  = "DELETE FROM cart_info WHERE sId = '$sId'";
		$result =$this->db->delete($query);
		return $result;
	}

	public function orderProduct($cmrId)
	{
		$sId	= session_id();
		$query = " SELECT * FROM `cart_info` WHERE sId  = '$sId'";
		$getPro = $this->db->select($query);
		if ($getPro) {
			while ($result = $getPro->fetch_assoc()) {
				$productId = $result['productId'];
				$productName = $result['productName'];
				$quantity = $result['quantity'];
				$price = $result['price'] * $quantity;
				$image = $result['image'];

				$query  = "INSERT INTO `tbl_order`(`cmrId`,`productId`,`productName`,`quantity`,`price`,`image`) VALUE('$cmrId','$productId','$productName','$quantity','$price','$image')";

			    $productinsert = $this->db->insert($query);
			} }
		}

		public function payableAmmount($cmrId)
		{
			$query = " SELECT price FROM `tbl_order` WHERE cmrId  = '$cmrId' AND date = now()";
			$result = $this->db->select($query);
			return $result;
		}

		public function getOrderProduct($cmrId)
		{
			$query = " SELECT * FROM `tbl_order` WHERE cmrId  = '$cmrId' ORDER BY date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function checkOrder($cmrId)
		{
		$query = " SELECT * FROM `tbl_order` WHERE cmrId  = '$cmrId'";
		$result = $this->db->select($query);
		return $result;
		}

		public function getAllOrderProduct()
		{
		$query = " SELECT * FROM `tbl_order` ORDER BY date DESC";
		$result = $this->db->select($query);
		return $result;
		}

		public function ProductShift($id, $date, $price)
		{
			$id    = mysqli_real_escape_string($this->db->link, $id);
			$date  = mysqli_real_escape_string($this->db->link, $date);
			$price = mysqli_real_escape_string($this->db->link, $price);

			$query = "UPDATE `tbl_order` SET status = '1' WHERE cmrId = '$id' AND date='$date' AND price='$price'";
				$update_row = $this->db->update($query);
				if ($update_row) {
					$msg = "<div class='alert alert-success'><strong>Success! </strong>Data Update Sussfully.
							</div>";
					return $msg;
				}else{
					$msg = "<div class='alert alert-danger'><strong>Error! </strong>Data Not Update !
							</div>";
					return $msg;
				}
			}

			public function delProductShift($id, $time, $price)
			{
				$id    = mysqli_real_escape_string($this->db->link, $id);
				$date  = mysqli_real_escape_string($this->db->link, $time);
				$price = mysqli_real_escape_string($this->db->link, $price);

				$query = "DELETE FROM `tbl_order` WHERE cmrId = '$id' AND date='$date' AND price='$price'";
				$delete_row = $this->db->delete($query);
					if ($delete_row) {
						$msg = "<div class='alert alert-success'><strong>Success! </strong>Data Delete Sussfully.
							</div>";
							return $msg;
					}else{
						$msg = "<div class='alert alert-danger'><strong>Error! </strong>Data Not Delete !
							</div>";
						return $msg;
			    }
		    }

		    public function ProductShiftConfirm($id, $time, $price)
		    {
		    	$id    = mysqli_real_escape_string($this->db->link, $id);
				$date  = mysqli_real_escape_string($this->db->link, $time);
				$price = mysqli_real_escape_string($this->db->link, $price);

				$query = "UPDATE `tbl_order` SET status = '2' WHERE cmrId = '$id' AND date='$date' AND price='$price'";
				$update_row = $this->db->update($query);
				if ($update_row) {
					$msg = "<div class='alert alert-success'><strong>Success! </strong>Data Update Sussfully.
							</div>";
					return $msg;
				}else{
					$msg = "<div class='alert alert-danger'><strong>Error! </strong>Data Not Update !
							</div>";
					return $msg;
				}
		    }
	










}


?>