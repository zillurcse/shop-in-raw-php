<div class="header_bottom_left">
    <div class="section group">
        <?php 
        $getIphone = $pd->letestFromIphone();
        if ($getIphone) {
            while ($result = $getIphone->fetch_assoc()) {
                                # code...

               ?>

               <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                   <a href="details.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image'] ?>" alt="" /></a>
               </div>
               <div class="text list_2_of_1">
                <h2>Iphone</h2>
                <p><?php echo $result['productName']; ?></p>
                <div class=""><span><a class="btn btn-primary" href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
            </div>
        </div>

    <?php } } ?>

    <?php 
    $getsamsung = $pd->letestFromSamsung();
    if ($getsamsung) {
        while ($result = $getsamsung->fetch_assoc()) {
                                # code...

           ?>
           <div class="listview_1_of_2 images_1_of_2">
            <div class="listimg listimg_2_of_1">
              <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image'] ?>" alt="" / ></a>
          </div>
          <div class="text list_2_of_1">
              <h2>Samsung</h2>
              <p><?php echo $result['productName']; ?></p>
              <div class=""><span><a class="btn btn-primary" href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
          </div>
      </div>
  <?php } } ?>
</div>
<div class="section group">
   <?php 
   $getacer = $pd->letestFromAcer();
   if ($getacer) {
    while ($result = $getacer->fetch_assoc()) {
                                # code...

       ?>
       <div class="listview_1_of_2 images_1_of_2">
        <div class="listimg listimg_2_of_1">
           <a href="details.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image'] ?>" alt="" /></a>
       </div>
       <div class="text list_2_of_1">
        <h2>Acer</h2>
        <p><?php echo $result['productName']; ?></p>
        <div class=""><span><a class="btn btn-primary" href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
    </div>
</div> 
<?php } } ?>

<?php 
$getcanon = $pd->letestFromCanon();
if ($getcanon) {
    while ($result = $getcanon->fetch_assoc()) {
                                # code...

       ?>

       <div class="listview_1_of_2 images_1_of_2">
        <div class="listimg listimg_2_of_1">
          <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image'] ?>" alt="" /></a>
      </div>
      <div class="text list_2_of_1">
          <h2>Canon</h2>
          <p><?php echo $result['productName']; ?></p>
          <div class=""><span><a class="btn btn-primary" href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
      </div>
  </div>
<?php } } ?>
</div>
<div class="clear"></div>
</div>
<div class="header_bottom_right_images">
 <!-- FlexSlider -->

 <section class="slider">
  <div class="flexslider">
    <ul class="slides">
        <li><img src="images/Slider_img1.jpg" alt=""/></li>
        <li><img src="images/2.jpg" alt=""/></li>
        <li><img src="images/3.jpg" alt=""/></li>
        <li><img src="images/4.jpg" alt=""/></li>
    </ul>
</div>
</section>
<!-- FlexSlider -->
</div>
<div class="clear"></div>
</div>