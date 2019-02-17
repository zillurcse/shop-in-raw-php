 <?php 
 include 'lib/Session.php';
 Session::init();
 include 'lib/Database.php';
 include 'helpars/Format.php';



 spl_autoload_register(function($class){
   include_once "classes/".$class.".php";
 });

 $db = new Database();
 $fm = new Format();
 $pd = new Product();
 $cat = new Category();
 $ct = new Cart();
 $cmr = new Customar();

 ?>

 <?php
 header("Cache-Control: no-cache, must-revalidate");
 header("Pragma: no-cache"); 
 header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
 header("Cache-Control: max-age=2592000");
 ?>
 <!DOCTYPE HTML>
 <head>
  <title>Store Website</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
  <link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
  <script src="js/jquerymain.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/script.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
  <script type="text/javascript" src="js/nav.js"></script>
  <script type="text/javascript" src="js/move-top.js"></script>
  <script type="text/javascript" src="js/easing.js"></script> 
  <script type="text/javascript" src="js/nav-hover.js"></script>
  <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
  <script type="text/javascript">
    $(document).ready(function($){
      $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
    });
  </script>
</head>
<body style="width: 1170px; margin: 0 auto;">
  <div class="wrap" style="width: 1185px">
    <div class="header_top">
      <div class="logo">
        <a href="index.php"><img src="images/Untitled-1 copy.jpg" class="img-responsive img-thumbnail" style="height: 85px; width: 300px" alt="" /></a>
      </div>
      <div class="header_top_right">
        <div class="search_box">
          <form>
            <input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
          </form>
        </div>
        <div class="shopping_cart">
          <div class="cart">
            <a href="#" title="View my shopping cart" rel="nofollow">
              <span class="cart_title">Cart</span>
              <span class="no_product">
                <?php 
                $getData = $ct->checkCartTable();
                if ($getData) {
                 $sum = Session::get("sum");
                 $qty = Session::get("qty");
                 echo "$ ".$sum."  | Qty ".$qty;
               }
               else{
                echo "(Empty)";
              }
              ?>

            </span>
          </a>
        </div>
      </div>
      <?php 
      if (isset($_GET['cid'])) {
        $cmrId = Session::get("cmrId");
        $delData = $ct->delCustomarCart();
        $delComp = $pd->delCompareData($cmrId);
        Session::destroy();
      }
      ?>
      <div>
        <?php 
        $login = Session::get("custlogin");
        if ($login == false) { ?>
          <a href="login.php" class="login" style="border: 1px solid #cecece; box-sizing: border-box; color: #444; display: block; float: left; font-size: 25px; height: 38px; margin-left: 10px; text-align: center; width: 125px; text-decoration: none;">Login</a>
        <?php } else { ?> 
          <a href="?cid=<?php Session::get('cmrId'); ?>" class="login" style="border: 1px solid #cecece; box-sizing: border-box; color: #444; display: block; float: left; font-size: 25px; height: 38px; margin-left: 10px; text-align: center; width: 125px; text-decoration: none;">Logout</a>

        <?php } ?>

      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="menu">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        
        <ul class="nav navbar-nav">
          <li class="actite"><a href="index.php">Home</a></li>
          <li><a href="topbrands.php">Top Brands</a></li>
          <?php 
          $chkCart = $ct->checkCartTable();
          if ($chkCart) { ?>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="payment.php">Payment</a></li>
            <?php
          }
          ?>

          <?php 
          $cmrId = Session::get("cmrId");
          $chkOrder = $ct->checkOrder($cmrId);
          if ($chkOrder) { ?>
            <li><a href="orderdetails.php">Order Detials</a></li>
            <?php
          }
          ?>

          <?php 
          $login = Session::get("custlogin");
          if ($login == true) { ?>
            <li><a href="profile.php">Profile</a></li>
            <?php 
          }
          ?>

          <?php 
          $cmrId = Session::get("cmrId");
          $getProduct = $pd->getCompareData($cmrId);
          if ($getProduct) {
           ?>
           <li><a href="compare.php">Compare</a> </li>
         <?php } ?>

         <?php 
         $cmrId = Session::get("cmrId");
         $chkwlist = $pd->checkWlistData($cmrId);
         if ($chkwlist) {
           ?>
           <li><a href="wishlist.php">WishList</a> </li>
         <?php } ?>

         <li><a href="contact.php">Contact</a></li>
       </ul>
       <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>

        <li>
          <?php 
          $login = Session::get("custlogin");
          if ($login == false) { ?>
            <a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
          <?php } else { ?> 
            <a href="?cid=<?php Session::get('cmrId'); ?>" class="btn btn-warning"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
          <?php } ?>
        </li>
      </ul>
    </div>
  </nav>
</div>

<div class="header_bottom">