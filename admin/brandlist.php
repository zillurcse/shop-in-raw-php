<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php 
	$brand = new Brand();
	error_reporting(0);
	if (isset($_GET['delbrand'])) {
		$id = $_GET['delbrand'];
		$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delbrand']);
		$delBrand = $brand->delBrandById($id);
	}

 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block"> 
                <?php 
                if ($delBrand) {
                	echo $delBrand;
                }

                 ?>       
                    <table class="data display datatable table table-bordered table-hover table-striped" id="example">
					<thead>
						<tr>
							<th width="10%">Serial No.</th>
							<th width="75%">Brand Name</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							 $getBrand = $brand->getAllBrand();
							 if ($getBrand) {
							 	$i = 0;
							 	while ($result = $getBrand->fetch_assoc()) {
							 		$i++;
							 	
						 ?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName']; ?></td>
							<td><a href="brandedit.php?brandId=<?php echo $result['brandId']; ?>" style="color: #628ac5" >Edit</a> || <a onclick="return confirm('Are you sure to Delete!')" href="?delbrand=<?php echo $result['brandId']; ?>" style="color: red">Delete</a></td>
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

