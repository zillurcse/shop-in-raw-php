<?php 
	include 'inc/header.php';
	$login = Session::get("custlogin");
	if ($login == true) {
		echo "<script>window.location = 'order.php';</script>";
	}

 ?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$cusLogin = $cmr->customarLogin($_POST);
}
?>
<div class="main">
	<div class="content">
		<div class="login_panel">
			<?php 
				if (isset($cusLogin)) {
				echo $cusLogin;
			}
			?>
			<h3>Existing Customers</h3>

		<form action="" method="post" >


				<table class="table table-bordered table-hover table-striped">
					<tr>
						<input class="form-control" name="email" type="text" placeholder="Entert your email." />
						
					</tr>
					<tr>
						<input class="form-control" name="password" type="password" placeholder="Password" />
						
					</tr>
				</table>
				<div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>

			</div>
		</form>


		<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
			$customarReg = $cmr->customarRegistration($_POST);
		}
		?>
		<div class="register_account" style="width: 750px; height: 380px">
			<?php 
				if (isset($customarReg)) {
				echo $customarReg;
			}
			?>
			<h3>Register New Account</h3>
			<form action="" method="post">
				<table class="table table-bordered table-hover table-striped">
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Entert your name">
								</div>

								<div>
									<input type="text" name="city" placeholder="Entert your City" >
								</div>

								<div>
									<input type="text" name="zip" placeholder="Zip-code" >
								</div>
								<div>
									<input type="text" name="email" placeholder="Entert your Email" >
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Entert your Address" >
								</div>
								<div>
									<input type="text" name="country" placeholder="Entert your Country" >
								</div>	        

								<div>
									<input type="text" name="phone" placeholder="Entert your Phone" >
								</div>

								<div>
									<input type="text" name="password" placeholder="password" >
								</div>
							</td>
						</tr> 
					</tbody></table> 
					<div class="search"><div><button class="btn btn-primary" name="register">Create Account</button></div></div>
					
					<div class="clear"></div>
				</form>
			</div>  	
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>