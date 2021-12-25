<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include '../../classes/Product.php'?>
<?php
$product = new Product();
if ($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["submit"])){
    $insertCat = $product->insertSlider($_POST, $_FILES);
    if ($insertCat){
        // echo "<script>window.location = 'catlist.php' </script>";
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
    <div class="block">   
        <?php
            if (isset($insertCat)){
                echo $insertCat;
            }
        ?>            
         <form action="sliderAdd.php" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="sliderName" placeholder="Enter Slider Title..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Type</label>
                    </td>
                    <td>
                        <select name="type">
                            <option selected hidden>Type</option>
                            <option value="0">Hidden</option>
                            <option value="1">Show</option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>