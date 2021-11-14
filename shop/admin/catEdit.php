<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../classes/Category.php'?>

<?php
	$cat = new Category();
	if ($_SERVER["REQUEST_METHOD"]==="POST"){
		$catName = $_REQUEST["catName"];
        $catId = $_GET["catId"];
        $result = $cat->updateCategoryWithId($catId, $catName);
        if ($result){
            echo "<script> window.location='catlist.php'</script>";
        } 
	}
?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"> 
                <?php
                   
                    if (!isset($_REQUEST["catName"])){
                        $result = $cat->getCategoryById($_GET["catId"]);
                        if (!$result){
                            echo "<script> window.location='catlist.php'</script>";
                        }
                        $catName = $result->fetch_assoc();
                        if ($catName) {  
                ?>
                    <form action="catEdit.php?catId=<?php echo $_GET["catId"];?>" method="POST">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" value='<?php echo $catName["catName"]; ?>' name="catName" placeholder="Enter Category Name..." class="medium" />
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