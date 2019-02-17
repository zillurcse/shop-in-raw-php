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
			<div style="text-align: center">
				<h3 class="panel panel-primary">Choose Payment Option</h3>
				<a href="paymentoffline.php" style="font-size: 25px; color: #fff; background: red none repeat scroll 0 0; padding: 5px 30px; border-radius: 5px; text-decoration: none;">Offline Payment</a>
				<a href="paymentonline.php" style="font-size: 25px; color: #fff; background: red none repeat scroll 0 0; padding: 5px 30px; border-radius: 5px; text-decoration: none;">Online Payment</a>
			</div>
			<div><a href="cart.php" class="btn btn-primary" style="width: 150px; margin: 5px auto 0; padding-bottom: 4px; text-align: center; display: block; border: 1px solid #333">Previouse</a></div>
		</div>
	</div>
</div>

<?php include 'inc/footer.php';?>
