<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpars/Format.php");
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
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);

			if (empty($brandName)) {
				$msg = "<span class='error'>Brand field must not be empty !</span>";
				return $msg;
			}
			else{
				$query = "INSERT INTO `brand_information`(`brandName`) VALUE('$brandName')";
				$brandInsert = $this->db->insert($query);
				if ($brandInsert) {
					$msg = "<span class='success'>Brand Insert Sussfully.</span>";
					return $msg;
				}else{
					$msg = "<span class='error'>Brand Not Insert.</span>";
					return $msg;
				}
			}
		}

		public function getAllBrand()
		{
			$query = " SELECT * FROM `brand_information` ORDER BY `brandId` DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getBrandById($id)
		{
			$query = " SELECT * FROM `brand_information` WHERE brandId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function brandUpdate($brandName, $id)
		{
			$brandName = $this->fm->validation($brandName);
			//$brandId = $this->fm->validation($brandId);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$brandId = mysqli_real_escape_string($this->db->link, $brandId);
			if (empty($brandName)) {
				$msg = "<span class='error'>Brand field must not be empty !</span>";
				return $msg;
			}
			else{
				$query = "UPDATE `brand_information` SET brandName = '$brandName'WHERE brandId = '$id'";
				$update_row = $this->db->update($query);
				if ($update_row) {
					$msg = "<span class='success'>Brand Name Update Sussfully.</span>";
					return $msg;
				}else{
					$msg = "<span class='error'>Brand Name Not Update !</span>";
					return $msg;
				}
			}
		}

		public function delBrandById($id)
		{
			$query = "DELETE FROM `brand_information` WHERE brandId = '$id'";
			$delete_row = $this->db->delete($query);
			if ($delete_row) {
				$msg = "<span class='success'>Delete Sussfully.</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Delete Not !</span>";
				return $msg;
			}
		}












	}

	?>