<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Customar.php'; ?>
<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../classes/Cart.php");
?>
<?php 
    if (!isset($_GET['custId']) || $_GET['custId'] == NULL) {
        echo "<script>window.location = 'inbox.php';</script>";
    }
    else{
        //$id = $_GET['custId'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custId']);
    }

 ?>

<?php 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script>window.location = 'inbox.php';</script>";
        }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customar Detials</h2>
               <div class="block copyblock"> 
               
                 <?php 
                    $cus = new Customar();
                    $getCustomar = $cus->getcustomarData($id);
                    if ($getCustomar) {
                        while ($result = $getCustomar->fetch_assoc()) {
                            # code...
                        
                  ?>
                 <form action="" method="post">
                    <table class="form table table-bordered table-hover table-striped">					
                        <tr>
                            <td>Name</td>
                            <td>
                                <input class="form-control" type="text" readonly="readonly" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>Address</td>
                            <td>
                                <input class="form-control" type="text" readonly="readonly" value="<?php echo $result['address']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>City</td>
                            <td>
                                <input class="form-control" type="text" readonly="readonly" value="<?php echo $result['city']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>Country</td>
                            <td>
                                <input class="form-control" type="text" readonly="readonly" value="<?php echo $result['country']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>Zip Code</td>
                            <td>
                                <input class="form-control" type="text" readonly="readonly" value="<?php echo $result['zip']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>Phone</td>
                            <td>
                                <input class="form-control" type="text" readonly="readonly" value="<?php echo $result['phone']; ?>" class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>Email</td>
                            <td>
                                <input class="form-control" type="text" readonly="readonly" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td colspan="2">
                                <input class="form-control" type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>