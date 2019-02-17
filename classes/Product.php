<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpars/Format.php");

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

		public function productInsert($data, $file){
			//error_reporting(0);
			//$productName = $this->fm->validation($data['$productName']);

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$catId 		 = mysqli_real_escape_string($this->db->link, $data['catId']);
			$brandId  	 = mysqli_real_escape_string($this->db->link, $data['brandId']);
			$body 		 = mysqli_real_escape_string($this->db->link, $data['body']);
			$price 	 	 = mysqli_real_escape_string($this->db->link, $data['price']);
			$type  		 = mysqli_real_escape_string($this->db->link, $data['type']);


			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_temp = $file['image']['tmp_name'];


			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "upload/".$unique_image;

			if ($productName == "" || $catId == "" || $brandId == "" ||$body == "" ||$price == "" ||$type == "" ||$file_name == "") {

				$msg = "<div class='alert alert-danger'><strong>Error!</strong>Fields must not be empty !</div>";
				return $msg;
				
			}
			elseif ($file_size >1048567) {
				echo "<div class='alert alert-danger'><strong>Error!</strong>Image Size should be less then 1MB !</div>";
			}
			elseif (in_array($file_ext, $permited) === false) {
				echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
			}


			else{
				
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO `product_add_info`(`productName`,`catId`,`brandId`,`body`,`price`,`image`,`type`) VALUE('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";

				$productinsert = $this->db->insert($query);
				if ($productinsert) {
					$msg = "<div class='alert alert-success'><strong>Success!</strong>Product Insert Sussfully !</div>";
					return $msg;
				}else{
					$msg = "<div class='alert alert-danger'><strong>Error!</strong>Product Not Insert !</div>";
					return $msg;
				}
				
			}

		}

		public function getAllProduct()
		{
			/*$query = "SELECT p.*, c.catName,b.brandName
					FROM product_add_info as p AND catagory_information as c AND brand_information as b
					WHERE p.catId = c.catId AND p.brandId = b.brandId
					ORDER BY p.productId DESC";*/
					$query = "SELECT `product_add_info`.*,catagory_information.catName, brand_information.brandName
					FROM product_add_info
					INNER JOIN catagory_information
					ON product_add_info.catId = catagory_information.catId
					INNER JOIN brand_information
					ON product_add_info.brandId = brand_information.brandId
					ORDER BY product_add_info.productId DESC";
					$result = $this->db->select($query);
					return $result;
				}

				public function getProductById($id)
				{
					$query = " SELECT * FROM `product_add_info` WHERE productId  = '$id'";
					$result = $this->db->select($query);
					return $result;
				}

				public function productUpdate($data, $file,$id)
				{
					$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
					$catId 		 = mysqli_real_escape_string($this->db->link, $data['catId']);
					$brandId  	 = mysqli_real_escape_string($this->db->link, $data['brandId']);
					$body 		 = mysqli_real_escape_string($this->db->link, $data['body']);
					$price 	 	 = mysqli_real_escape_string($this->db->link, $data['price']);
					$type  		 = mysqli_real_escape_string($this->db->link, $data['type']);


					$permited  = array('jpg', 'jpeg', 'png', 'gif');
					$file_name = $file['image']['name'];
					$file_size = $file['image']['size'];
					$file_temp = $file['image']['tmp_name'];

					$div = explode('.', $file_name);
					$file_ext = strtolower(end($div));
					$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
					$uploaded_image = "upload/".$unique_image;

					if ($productName == "" || $catId == "" || $brandId == "" ||$body == "" ||$price == "" ||$type == "") {

						$msg = "<div class='alert alert-danger'><strong>Error!</strong>Fields must not be empty !</div>";
						return $msg;

					}
					else{

						if (!empty($file_name)) {


							if ($file_size >1048567) {
								echo "<div class='alert alert-danger'><strong>Error!</strong>Image Size should be less then 1MB !</div>";
							}
							elseif (in_array($file_ext, $permited) === false) {
								echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
							}


							else{

								move_uploaded_file($file_temp, $uploaded_image);
								$query = "UPDATE product_add_info
								SET productName = '$productName',
								catId	    = '$catId',
								brandId	    = '$brandId',
								body  		= '$body',
								price	    = '$price',
								image	    = '$uploaded_image',
								type	    = '$type'

								WHERE productId='$id'";

								$productUpdate = $this->db->update($query);
								if ($productUpdate) {
									$msg = "<div class='alert alert-success'><strong>Success!</strong>Product Update Sussfully !</div>";
									return $msg;
								}else{
									$msg = "<div class='alert alert-success'><strong>Success!</strong>Product Not Update !</div>";
									return $msg;
								}

							}
						}
						else{
							$query = "UPDATE product_add_info
							SET productName = '$productName',
							catId	    = '$catId',
							brandId	    = '$brandId',
							body  		= '$body',
							price	    = '$price',
							type	    = '$type'

							WHERE productId='$id'";

							$productUpdate = $this->db->update($query);
							if ($productUpdate) {
								$msg = "<div class='alert alert-success'><strong>Success!</strong>Product Update Sussfully. !</div>";
								return $msg;
							}else{
								$msg = "<div class='alert alert-danger'><strong>Error!</strong>Product Not Update !</div>";
								return $msg;
							}
						}
					}
				}

				public function delProductById($id)
				{
					$query = "SELECT * FROM product_add_info  WHERE productId = '$id'";
					$getdata = $this->db->select($query);
					if ($getdata) {
						while ($delimg = $getdata->fetch_assoc()) {
							$delLink = $delimg['image'];
							unlink($delLink);
						}
					}
					$del_query = "DELETE FROM `product_add_info` WHERE `productId` = '$id'";
					$deleteData = $this->db->delete($del_query);
					if ($deleteData) {
						$msg = "<div class='alert alert-success'><strong>Success!</strong>Product Delete Sussfully !</div>";
						return $msg;
					}else{
						$msg = "<div class='alert alert-danger'><strong>Error!</strong>Product Delete Not !
							</div>";
						return $msg;
					}


				}

				public function getFutureProduct()
				{
					$query = "SELECT * FROM `product_add_info` WHERE type='0' ORDER BY  productId DESC LIMIT 4";
					$result = $this->db->select($query);
					return $result;
				}

				public function getNewProduct()
				{
					$query = "SELECT * FROM `product_add_info` ORDER BY  productId DESC LIMIT 4";
					$result = $this->db->select($query);
					return $result;
				}

				public function getSingleProduct($id)
				{
					$query = "SELECT `product_add_info`.*,catagory_information.catName, brand_information.brandName
					FROM product_add_info
					INNER JOIN catagory_information
					ON product_add_info.catId = catagory_information.catId
					INNER JOIN brand_information
					ON product_add_info.brandId = brand_information.brandId AND product_add_info.productId = '$id'";
					$result = $this->db->select($query);
					return $result;
				}

				public function letestFromIphone()
				{
					$query = "SELECT * FROM `product_add_info` WHERE brandId='1' ORDER BY  productId DESC LIMIT 1";
					$result = $this->db->select($query);
					return $result;
				}

				public function letestFromSamsung()
				{
					$query = "SELECT * FROM `product_add_info` WHERE brandId='2' ORDER BY  productId DESC LIMIT 1";
					$result = $this->db->select($query);
					return $result;
				}

				public function letestFromAcer()
				{
					$query = "SELECT * FROM `product_add_info` WHERE brandId='3' ORDER BY  productId DESC LIMIT 1";
					$result = $this->db->select($query);
					return $result;
				}

				public function letestFromCanon()
				{
					$query = "SELECT * FROM `product_add_info` WHERE brandId='4' ORDER BY  productId DESC LIMIT 1";
					$result = $this->db->select($query);
					return $result;
				}

				public function productByCat($id)
				{
					$catId  		 = mysqli_real_escape_string($this->db->link, $id);
					$query = " SELECT * FROM `product_add_info` WHERE catId  = '$id'";
					$result = $this->db->select($query);
					return $result;
				}

				public function insertCompareData($cmprid, $cmrId)
				{
					$cmrId       = mysqli_real_escape_string($this->db->link, $cmrId);
					$productId   = mysqli_real_escape_string($this->db->link, $cmprid);

					$comparequery = " SELECT * FROM `tbl_compare` WHERE cmrId  = '$cmrId' AND productId = '$productId'";
					$check = $this->db->select($comparequery);
					if ($check) {
						$msg = "<div class='alert alert-danger'><strong>Error!</strong>Already Added !
							</div>";
						return $msg;
					}

					$query = " SELECT * FROM `product_add_info` WHERE productId  = '$productId'";
					$result = $this->db->select($query)->fetch_assoc();

					if ($result) {

						$productId   = $result['productId'];
						$productName = $result['productName'];
						$price       = $result['price'];
						$image       = $result['image'];

						$query  = "INSERT INTO `tbl_compare`(`cmrId`,`productId`,`productName`,`price`,`image`) VALUES('$cmrId','$productId','$productName','$price','$image')";

						$productinsert = $this->db->insert($query);

						if ($productinsert) {
							$msg = "<div class='alert alert-success'><strong>Success!</strong>Added to Compare !
							</div>";
							return $msg;
						}else{
							$msg = "<div class='alert alert-danger'><strong>Error!</strong>Not Added !
							</div>";
							return $msg;
						}
					}
				} 


				public function getCompareData($cmrId)
				{
					$query = "SELECT * FROM tbl_compare WHERE cmrId='$cmrId'";
					$result = $this->db->select($query);
					return $result;
				}

				public function delCompareData($cmrId)
				{
					$query = "DELETE FROM tbl_compare  WHERE cmrId = '$cmrId'";
					$getdata = $this->db->select($query);
					return $getdata;
				}

				public function saveWishlistData($id, $cmrId)
				{	
					$comparequery = " SELECT * FROM `tbl_wlist` WHERE cmrId  = '$cmrId' AND productId = '$id'";
					$check = $this->db->select($comparequery);
					if ($check) {
						$msg = "<div class='alert alert-danger'><strong>Error!</strong>Already Added !
							</div>";
						return $msg;
					}
					$query = " SELECT * FROM `product_add_info` WHERE productId  = '$id'";
					$result = $this->db->select($query)->fetch_assoc();
					if ($result) {
						
						$productId = $result['productId'];
						$productName = $result['productName'];
						$price = $result['price'];
						$image = $result['image'];

						$query  = "INSERT INTO `tbl_wlist`(`cmrId`,`productId`,`productName`,`price`,`image`) VALUE('$cmrId','$productId','$productName','$price','$image')";

						$productinsert = $this->db->insert($query);

						if ($productinsert) {
							$msg = "<div class='alert alert-success'><strong>Success!</strong>Added ! Check Wishlist Page.
							</div>";
							return $msg;
						}else{
							$msg = "<div class='alert alert-danger'><strong>Error!</strong>Not Added !
							</div>";
							return $msg;
						}
					} 
				}

				public function checkWlistData($cmrId)
				{
					$query = " SELECT * FROM `tbl_wlist` WHERE cmrId  = '$cmrId' ORDER BY id DESC";
					$result = $this->db->select($query);
					return $result;
				}

				public function delWishlistData($cmrId, $productId)
				{
					error_reporting(0);
					$query = "DELETE FROM tbl_wlist  WHERE cmrId = '$cmrId' AND productId='$productId'";
					$result = $this->db->select($query);
					return $result;
				}
















			}

			?>