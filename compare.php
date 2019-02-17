<?php include 'inc/header.php';?>
<?php 
$login = Session::get("custlogin");
if ($login == false) {
	echo "<script>window.location = 'login.php';</script>";
}
?>

<div class="main">
	<div class="content">
		<div class="cartoption">		
			<div class="cartpage">
				<h2>Your Compare List</h2>
				<table class="table table-bordered table-hover table-striped">
					
					<tr>
						<th>SL</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
					<?php 
					$cmrId = Session::get("cmrId");
					$getProduct = $pd->getCompareData($cmrId);
					if ($getProduct) {
						$i = 0;
						while ($result = $getProduct->fetch_assoc()) {

							$i++;

							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><?php echo $result['price']; ?></td>
								<td><img style='height: 60px; width: 100px' src="admin/<?php echo $result['image']; ?>" class='img-responsive img-thumbnail' alt=""/></td>  
								<td><a href="details.php?proid=<?php echo $result['productId']; ?>">View</a></td> 
								
							</tr>
								<?php } } ?>

					</table>
					
				
				</div>
				<div class="shopping">
					<div class="shopleft">
						<a href="index.php"> <img src="images/shop.png" alt="" /></a>
					</div>
					<div class="shopright">
						<a href="payment.php"> <img src="images/check.png" alt="" /></a>
					</div>
				</div>
			</div>  	
			<div class="clear"></div>
		</div>
	</div>
</div>

<?php include 'inc/footer.php';?>