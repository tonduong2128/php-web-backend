<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../classes/Category.php'?>

<?php
    $filePath = realpath(dirname(__FILE__));
	include_once $filePath.'/../../classes/customer.php';

	if (!isset($_GET['customerId']) || $_GET['customerId'] == NULL){
        echo "<script>loction='inbox.php'</script>";
    } else {
        $customer = new Customer();
        $customerId = $_GET["customerId"];
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"  style="width:100%;" > 
                   <?php
                    $getCustomer = $customer->showCustomer($customerId);
                    if ($getCustomer){
                        while ($result = $getCustomer->fetch_assoc()){
                    ?>
                        <form action="" method="POST">  
                            <table class="form" >					
                                <tr >
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>
                                        <input  readonly value='<?php echo $result["name"]; ?>'class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td>
                                        <input  readonly value='<?php echo $result["address"]; ?>'class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>:</td>
                                    <td>
                                        <input  readonly value='<?php echo $result["city"]; ?>'class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>:</td>
                                    <td>
                                        <input  readonly value='<?php echo $result["country"]; ?>'class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Zip Code</td>
                                    <td>:</td>
                                    <td>
                                        <input  readonly value='<?php echo $result["zipcode"]; ?>'class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>:</td>
                                    <td>
                                        <input  readonly value='<?php echo $result["phone"]; ?>'class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>
                                        <input  readonly value='<?php echo $result["email"]; ?>'class="medium" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    <?php
                        }
                    }
                }
                   ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>