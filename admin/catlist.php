<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php 
error_reporting(0);
$cat = new Category();
if (isset($_GET['delcat'])) {
	$id = $_GET['delcat'];
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcat']);
	$delcat = $cat->delcatById($id);
}

?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<div class="block"> 
			<?php 
			if ($delcat) {
				echo $delcat;
			}

			?>       
			<table class="data display datatable table table-bordered table-hover table-striped" id="example">
				<thead>
					<tr>
						<th width="10%">Serial No.</th>
						<th width="75%">Category Name</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>

					<?php 
					$getCat = $cat->getAllCat();
					if ($getCat) {
						$i = 0;
						while ($result = $getCat->fetch_assoc()) {
							$i++;
							
							?>

							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['catName']; ?></td>
								<td><a href="catedit.php?catid=<?php echo $result['catId']; ?>" style="color: #628ac5">Edit</a> || <a onclick="return confirm('Are you sure to Delete!')" href="?delcat=<?php echo $result['catId']; ?>" style="color: red">Delete</a></td>
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

