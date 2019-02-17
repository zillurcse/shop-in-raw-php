<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<div class="main">
	<div class="content container">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="sec tion group container">

			<?php 
			$getFpd = $pd->getFutureProduct();
			if ($getFpd) {
				while ($result = $getFpd->fetch_assoc()) {

					?>

					<div class="grid_1_of_4 images_1_of_4 panel panel-primary">
						<a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" class="img-responsive img-thumbnail" alt="" /></a>
						<div class="panel-heading"><?php echo $result['productName']; ?></div>
						<p><?php echo $fm->textShorten($result['body'], 60); ?></p>
						<p><span class="price">$<?php echo $result['price']; ?></span></p>   
						<div class="button">
							<span class="btn btn-success">
								<a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a>
							</span>
						</div>
					</div>

				<?php } } ?>
				
			</div>
			<div class="content_bottom">
				<div class="heading">
					<h3>New Products</h3>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">

				<?php 
				$getNpd = $pd->getNewProduct();
				if ($getNpd) {
					while ($result = $getNpd->fetch_assoc()) {

						?>

						<div class="grid_1_of_4 images_1_of_4 panel panel-primary" >
							<a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" class="panel-body" alt="" /></a>
							
								<h2 class="panel-heading"><?php echo $result['productName']; ?></h2>
							
							<p class="panel-footer"><?php echo $fm->textShorten($result['body'], 10); ?></p>
							<div class="button">
							<span class="btn btn-success">
								<a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a>
							</span>
						</div>
						</div>
					<?php } } ?>

				</div>
			</div>
		</div>
	</div>



	<?php include 'inc/footer.php'; ?>	