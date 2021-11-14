<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../classes/Brand.php'?>

<?php
	$cat = new Brand();
	if ($_SERVER["REQUEST_METHOD"]==="POST"){
		$brandName = $_REQUEST["brandName"];
        $brandId = $_GET["brandId"];
        $result = $cat->updateBrandWithId($brandId, $brandName);
        if ($result){
            echo "<script> window.location='brandlist.php'</script>";
        } 
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Brand</h2>
               <div class="block copyblock"> 
                <?php
                   
                    if (!isset($_REQUEST["brandName"])){
                        $result = $cat->getBrandById($_GET["brandId"]);
                        if (!$result){
                            echo "<script> window.location='brandlist.php'</script>";
                        }
                        $brandName = $result->fetch_assoc();
                        if ($brandName) {  
                ?>
                    <form action="brandEdit.php?brandId=<?php echo $_GET["brandId"];?>" method="POST">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" value='<?php echo $brandName["brandName"]; ?>' name="brandName" placeholder="Enter Brand Name..." class="medium" />
                                </td>
                            </tr>
                            <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php 
                    }
                }
                ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>