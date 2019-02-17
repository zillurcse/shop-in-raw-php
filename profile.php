<?php include 'inc/header.php';?>
  
<div class="main">
	<div class="content">
		<div class="section group">
			<?php 
				$id = Session::get("cmrId");
				$getdata = $cmr->getcustomarData($id);
				if ($getdata) {
					 while ($result = $getdata->fetch_assoc()) {
					 	
			 ?>
			<table class="table table-hover table-bordered table-striped">
				<caption><h3>User Profile Detials</h3></caption>
				<thead>
					<tr>
						<th colspan="3"><h4>Your Profile Detials</h4></th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="20%">Name</td>
						<td width="5%">:</td>
						<td><?php echo $result['name']; ?></td>
					</tr>

					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><?php echo $result['phone']; ?></td>
					</tr>

					<tr>
						<td>Email</td>
						<td>:</td>
						<td><?php echo $result['email']; ?></td>
					</tr>

					<tr>
						<td>Address</td>
						<td>:</td>
						<td><?php echo $result['address']; ?></td>
					</tr>

					<tr>
						<td>City</td>
						<td>:</td>
						<td><?php echo $result['city']; ?></td>
					</tr>

					<tr>
						<td>Zipcode</td>
						<td>:</td>
						<td><?php echo $result['zip']; ?></td>
					</tr>

					<tr>
						<td>Country</td>
						<td>:</td>
						<td><?php echo $result['country']; ?></td>
					</tr>
					<tr>
						<td colspan="3"><a href="editprofile.php" class="btn btn-primary">Edit Detials</a></td>
					</tr>
				</tbody>
			</table>
			<?php  } } ?>
		</div>
	</div>
</div>

<?php include 'inc/footer.php';?>
