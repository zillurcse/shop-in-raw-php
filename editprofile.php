<?php include 'inc/header.php';?>
<?php 
$login = Session::get("custlogin");
if ($login == false) {
	echo "<script>window.location = 'login.php';</script>";
}
?>
<?php 

	$cmrId = Session::get("cmrId");
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$Updatecustomar = $cmr->customarUpdate($_POST,$cmrId);
}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<?php 
				$id = Session::get("cmrId");
				$getdata = $cmr->getcustomarData($id);
				if ($getdata) {
					 while ($result = $getdata->fetch_assoc()) {
					 	
			 ?>
			<form action="" method="post">
				<table class="table table-hover table-bordered table-striped">
				<caption><h3>Update Profile Detials</h3></caption>
				<thead>
	<?php 
		if (isset($Updatecustomar)) {
			echo "<tr><th colspan='2'><h4>".$Updatecustomar."</h4></th></tr>";
						}
					 ?>
					
					<tr>
						<th colspan="2"><h4>Your Update Profile Detials</h4></th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="20%">Name</td>
						<td>
							<input type="text" name="name" class="form-control" value="<?php echo $result['name']; ?>">
						</td>
					</tr>

					<tr>
						<td>Phone</td>
						<td>
							<input type="text" name="phone" class="form-control" value="<?php echo $result['phone']; ?>">
						</td>
					</tr>

					<tr>
						<td>Email</td>
						<td>
							<input type="text" name="email" class="form-control" value="<?php echo $result['email']; ?>">
						</td>
					</tr>

					<tr>
						<td>Address</td>
						<td>
							<input type="text" name="address" class="form-control" value="<?php echo $result['address']; ?>">
						</td>
					</tr>

					<tr>
						<td>City</td>
						<td>
							<input type="text" name="city" class="form-control" value="<?php echo $result['city']; ?>">
						</td>
					</tr>

					<tr>
						<td>Zipcode</td>
						<td>
							<input type="text" name="zip" class="form-control" value="<?php echo $result['zip']; ?>">
						</td>
					</tr>

					<tr>
						<td>Country</td>
						<td>
							<input type="text" name="country" class="form-control" value="<?php echo $result['country']; ?>">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="submit" class="btn btn-primary" value="Update">
						</td>
					</tr>
				</tbody>
			</table>

			</form>
			<?php  } } ?>
		</div>
	</div>
</div>

<?php include 'inc/footer.php';?>
