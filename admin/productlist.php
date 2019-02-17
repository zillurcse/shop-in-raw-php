<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include_once '../helpars/Format.php'; ?>
<?php 
$pd = new Product();
$fm = new Format();
?>
<?php 
	if (isset($_GET['delpro'])) {
		$id = $_GET['delpro'];
		$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delpro']);
		$delpro = $pd->delProductById($id);
	}

 ?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">  
			<?php 
			$delpro = 0;
                	if ($delpro) {
                		echo $delpro;
                	}

                	?> 
			<table class="data display datatable table table-bordered table-hover table-striped" id="example">
				<thead>
					<tr>
						<th width="5%">SL</th>
						<th width="15%">Product Name</th>
						<th width="10%">Catagory</th>
						<th width="10%">Brand</th>
						<th width="35%">Description</th>
						<th width="5%">Price</th>
						<th width="10%">Image</th>
						<th width="5%">Type</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 0;
					$getproduct = $pd->getAllProduct();
					if ($getproduct) {
						while ($result = $getproduct->fetch_assoc()) {
							$i++;

							?>
							<tr class="odd gradeX">
								<td><?php echo $i ; ?></td>
								<td><?php echo $result['productName'] ; ?></td>
								<td><?php echo $result['catName'] ; ?></td>
								<td><?php echo $result['brandName'] ; ?></td>
								<td><?php echo $fm->textShorten($result['body'], 50  ) ; ?></td>
								<td>$<?php echo $result['price'] ; ?></td>
								<td><img class='img-responsive img-thumbnail' src="<?php echo $result['image'] ; ?>" alt="" height="40px" width="60px"></td>
								<td>
									<?php

									if ($result['type'] == 0) {
										echo "Featured";
									}else{
										echo "General";
									}
									?>

								</td>
								<td><a href="productedit.php?proid=<?php echo $result['productId']; ?>" style="color: #628ac5">Edit</a> || <a onclick="return confirm('Are you sure to Delete!')" href="?delpro=<?php echo $result['productId']; ?>" style="color: red">Delete</a></td>
							</tr>
						<?php } } ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function () {
			setupLeftMenu();
			$('.datatable').dataTable();
			setSidebarHeight();
		});
	</script>
	<?php include 'inc/footer.php';?>
