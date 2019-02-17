<?php include 'inc/header.php';?>
<?php 
$login = Session::get("custlogin");
if ($login == false) {
	echo "<script>window.location = 'login.php';</script>";
}
?>
<?php 
		if (isset($_GET['orderid']) && $_GET['orderid']=='order') {
			$cmrId = Session::get("cmrId");
			$insertorder = $ct->orderProduct($cmrId);
			$delData = $ct->delCustomarCart();
			echo "<script>window.location = 'success.php';</script>";
			
		}
 ?>
<div class="main">
	<div class="content">
		<div class="section group">
			
			<div class="devistion">
				<table class="table table-hover table-bordered table-striped">
					
					<tr>
						<th>NO</th>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
					</tr>
					<?php 
					$getProduct = $ct->getCartProduct();
					if ($getProduct) {
						$i = 0;
						$sum = 0;
						$qty = 0;
						while ($result = $getProduct->fetch_assoc()) {

							$i++;

							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td>$<?php echo $result['price']; ?></td>
								<td><?php echo $result['quantity']; ?></td>
								<td>$<?php 
									 $total = $result['price'] * $result['quantity'];
									 echo $total;
									 ?>
								</td>
							</tr>
								<?php 
								$qty = $qty + $result['quantity'];
								$sum = $sum + $total; 
								?>
						<?php } } ?>
					</table>
					</table>
					<table class="table table-hover table-bordered table-striped" style="float:right;text-align:left; width: 58%">
						<tr>
							<td width="45%">Sub Total </td>
							<td width="5%">:</td>
							<td width="50%">$<?php echo $sum; ?></td>
						</tr>
						<tr>
							<td width="45%">VAT </td>
							<td width="5%">:</td>
							<td width="50%">10% ($ <?php $vat = $sum * 0.1; echo $vat; ?>)</td>
						</tr>
						<tr>
							<td width="45%">Grand Total </td>
							<td width="5%">:</td>
							<td width="50%">
								$<?php 
									$vat = $sum * 0.1;
									$gettotal = $sum + $vat;
									echo $gettotal;

							 	?>
							 	
							 </td>
						</tr>
						<tr>
							<td width="45%">Quantity</td>
							<td width="5%">:</td>
							<td width="50%"><?php echo $qty; ?></td>
						</tr>
					</table>
			</div>
			<div class="devistion">
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
	<div class="btn btn-info" style=" text-align: center; display: block;"><a href="?orderid=order" style="text-decoration: none; color: #fff;  text-align: center; font-size: 20px; display: block; padding: 5px">Order</a></div>
</div>

<?php include 'inc/footer.php';?>
