<?php include 'inc/header.php';?>
<?php 
$login = Session::get("custlogin");
if ($login == false) {
	echo "<script>window.location = 'login.php';</script>";
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<div style="text-align: center; width: 60%; text-align: center; margin: 0 auto; border: 1px; display: block;">
				<table class="table table-bordered table-striped">
					<h3 class="panel panel-primary">Success</h3>
					<?php 
						$cmrId = Session::get("cmrId");
						$amount = $ct->payableAmmount($cmrId);
						if ($amount) {
							$sum = 0;
							while ($result = $amount->fetch_assoc()) {
								$price = $result['price'];
								$sum   = $sum+$price;
							}
						}
					 ?>
				<p class="panel panel-primary" style="text-align: justify; font-size: 18px; color: red">Total Payable Amount(Including Vat) : $
					<?php 
					//error_reporting(0);
						$vat = $sum * 0.1;
						$total = $vat+$sum;
						echo $total;
					 ?>
				</p>
				<p class="panel panel-primary" style="text-align: justify; font-size: 18px">Thanks for Purchase. Recieve Your Order Successfully. We will be Contact you As soon as Possible with Delivery Detials. Here is your order detials.... <a href="orderdetails.php">Vesit Here..</a></p>
				</table>
			</div>
			
		</div>
	</div>
</div>

<?php include 'inc/footer.php';?>
