<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpars/Format.php");
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
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);

			if (empty($catName)) {
				$msg = "<span class='error'>Category field must not be empty !</span>";
				return $msg;
			}
			else{
				$query = "INSERT INTO `catagory_information`(`catName`) VALUE('$catName')";
				$catinsert = $this->db->insert($query);
				if ($catinsert) {
					$msg = "<span class='success'>Category Insert Sussfully.</span>";
					return $msg;
				}else{
					$msg = "<span class='error'>Category Not Insert.</span>";
					return $msg;
				}
			}
		}
		public function getAllCat()
		{
			$query = "SELECT * FROM `catagory_information` ORDER BY `catId` DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getCatById($id)
		{
			$query = " SELECT * FROM `catagory_information` WHERE catId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function catUpdate($catName, $id)
		{
			$catName = $this->fm->validation($catName);
			//$catId = $this->fm->validation($catId);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$catId = mysqli_real_escape_string($this->db->link, $catId);
			if (empty($catName)) {
				$msg = "<span class='error'>Category field must not be empty !</span>";
				return $msg;
			}
			else{
				$query = "UPDATE `catagory_information` SET catName = '$catName'WHERE catId = '$id'";
				$update_row = $this->db->update($query);
				if ($update_row) {
					$msg = "<span class='success'>Category Update Sussfully.</span>";
					return $msg;
				}else{
					$msg = "<span class='error'>Category Not Update !</span>";
					return $msg;
				}
			}
		}

		public function delcatById($id)
		{
			$catId = mysqli_real_escape_string($this->db->link, $catId);
			$query = "DELETE FROM `catagory_information` WHERE catId = '$id'";
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