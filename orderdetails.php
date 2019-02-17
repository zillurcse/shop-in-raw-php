<?php include 'inc/header.php';?>
<?php 
	$login = Session::get("custlogin");
	if ($login == false) {
		echo "<script>window.location = 'login.php';</script>";
	}
 ?>
<?php 
	if (isset($_GET['customarid'])) {
 		$id    = $_GET['customarid'];
 		$time  = $_GET['time'];
 		$price = $_GET['price'];
 		$confirm = $ct->ProductShiftConfirm($id, $time, $price);
 	}
 ?>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="order">
				<h2>Your Order Detials</h2>

				<table class="table table-bordered table-hover table-striped">
					<tr>
						<th width="5%">NO</th>
						<th width="30%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Quantity</th>
						<th width="15%">Total Price</th>
						<th width="15%">Date</th>
						<th width="15%">Status</th>
						<th width="10%">Action</th>
					</tr>
					<?php 
						$cmrId = Session::get("cmrId");
						$getOrder = $ct->getOrderProduct($cmrId);
						if ($getOrder) {
						$i = 0;;
						while ($result = $getOrder->fetch_assoc()) {

							$i++;
								?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" class='img-responsive img-thumbnail' alt=""/></td>
								<td><?php echo $result['quantity']; ?></td>
								<td>$<?php 
								 echo $result['price'];
									 ?>
								</td> 
								<td><?php echo $fm->formatDate($result['date']); ?></td>
								<td>
									<?php
										if ($result['status'] == '0') {
											echo "Pending";
										}elseif($result['status'] == '1'){ 
											echo "Shifted";
											
									 }else{
											echo "OK";
										}
									 ?>
										
								</td>
									<?php 
										if ($result['status'] == '1') { ?>
											<td style="text-align: center;"><a href="?customarid=<?php echo $cmrId ?>& price=<?php echo $result['price']; ?>& time=<?php echo $result['date']; ?>" style="text-decoration: none">Confirm</a></td>
										<?php } elseif($result['status'] == '2'){ ?>
										  	<td><?php echo "OK"; ?></td>
										<?php }elseif($result['status'] == '0'){ ?>
											<td><?php echo "N/A"; ?></td>
										<?php } ?>
							</tr>
								
						<?php } } ?>

				</table>
				
			</div>
		</div>		
		<div class="clear"></div>
	</div>
</div>
<?php include 'inc/footer.php';?>

