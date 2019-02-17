<?php include 'inc/header.php';?>
<?php 
if (isset($_GET['proid'])) {

	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
}

?>

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$addCart = $ct->addToCart($quantity, $id);
}
?>

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
	$productId = $_POST['productId'];
	$insertCom = $pd->insertCompareData($productId, $cmrId);
}
?>
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
	$saveWlist = $pd->saveWishlistData($id, $cmrId);
}
?>
<style>
.mybutto{width: 100px; float: left; margin-right: 45px}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="cont-desc span_1_of_2">	
				<?php 
				$getpd = $pd->getSingleProduct($id);
				if ($getpd) {
					while ($result = $getpd->fetch_assoc()) {
						

						?>			
						<div class="grid images_3_of_2">
							<img src="admin/<?php echo $result['image']; ?>" class="img-responsive img-thumbnail panel-body" alt="" />
						</div>  
						<div class="desc span_3_of_2 panel panel-primary">
							<h2 class="panel-heading"><?php echo $result['productName']; ?></h2>

							<div class="price">
								<p>Price: <span>$<?php echo $result['price']; ?></span></p>
								<p>Category: <span><?php echo $result['catName']; ?></span></p>
								<p>Brand:<span class="panel-footer"><?php echo $result['brandName']; ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1"/>
									<input type="submit" class="buysubmit btn btn-primary" name="submit" value="Buy Now"/>
								</form>				
							</div>
							<span style="color: red; font-size: 20px;">
								<?php 

								if (isset($addCart)) {
									echo $addCart;
								}
								?>
								
							</span>
							<?php 

							if (isset($insertCom)) {
								echo $insertCom;
							}
							if (isset($saveWlist)) {
								echo $saveWlist;
							}
							?>

							<?php 
							$login = Session::get("custlogin");
							if ($login == true) { ?>
								<div class="add-cart" style=" height: 80px; padding: 10px; margin-left: 5px">
									<div class="mybutto">
										<form action="" method="post">
											<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>
											<input type="submit" class="buysubmit btn btn-success" name="compare" value="Add to Compare"/>
										</form>	
									</div>
									<div class="mybutto">
										<form action="" method="post">

											<input type="submit" class="buysubmit btn btn-primary" name="wlist" value="Save to Favorit"/>
										</form>	
									</div>			
								</div>
							<?php } ?>
						</div>
						<div class="" >
							<h2 class="btn btn-success" style="width: 655px; color: #fff">Product Details</h2>
							<?php echo $result['body']; ?>
						</div>
					<?php } } ?>

				</div>
				<div class="rightsidebar span_3_of_1">
					<h2 class="panel-heading btn btn-primary" style="width: 300px; color: #fff">CATEGORIES</h2>
					<ul>
						<?php 
						$getCat = $cat->getAllCat();
						if ($getCat) {
							while ($result = $getCat->fetch_assoc()) {
									# code...
								
								?>
								<li><a href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>

							<?php } } ?>
						</ul>

					</div>
				</div>
			</div>
		</div>

		<?php include 'inc/footer.php';?>
