<?php include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../../classes/Category.php';
    include '../../classes/Brand.php';
    include '../../classes/Product.php';
?>


<?php
    if ($_SERVER["REQUEST_METHOD"]==="POST"){
        $pd = new Product();
        $productId = $_REQUEST["productId"];
        $resultUp = $pd->updateProductWithId($productId, $_POST, $_FILES);
    } 
    if (isset($_GET["productId"]) || $_GET["productId"] !=null ){
        $productId = $_REQUEST["productId"];
        $pd = new Product();
        $result = $pd->getProductById($productId);
        if (!$result){
            echo "<script> window.location = 'productlist.php' </script>";
        } else{
            $data2 = $result->fetch_assoc();
        }
    } else{
        echo "<script>window.location = 'productlist.php'</script>";
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">           
        <?php
            if (isset($resultUp)){
                echo $resultUp;
            } 
        ?>       
         <form action="?productId=<?php echo $productId?>" method="post" enctype="multipart/form-data"> <!--enctype="multipart/form-data" thêm hình ảnh bắt buộc phải có-->
            <table class="form">               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $data2["productName"];?>" name="productName" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category"  >
                            <?php
                                $cat = new Category();
                                $result = $cat->getCategoryById($data2["catId"]);
                                $data = $result->fetch_assoc();
                            ?>
                            <option 
                                selected 
                                value="<?php echo $data2["catId"];?>"
                            >
                                <?php echo $data["catName"] ?>
                            </option>
                            <?php
                                $result = $cat->showCategory();
                                while($data = $result->fetch_assoc()){
                                    if ($data["catId"] === $data2["catId"]) {continue;};
                            ?>

                                <option value="<?php echo $data["catId"] ?>"><?php echo $data["catName"] ?></option>
                            <?php          
                            }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                       
                        <select id="select" name="brand" >
                            <?php
                                $brand = new Brand();
                                $result = $brand->getBrandById($data2["brandId"]);
                                $data = $result->fetch_assoc();
                            ?>
                            <option selected value="<?php echo $data2["brandId"];?>">
                                <?php echo $data["brandName"] ?>
                            </option>
                            <?php
                                $result = $brand->showBrand();
                                while($data = $result->fetch_assoc()){
                                    if ($data["brandId"] === $data2["brandId"]) {continue;};
                            ?>
                                <option value="<?php echo $data["brandId"] ?>"><?php echo $data["brandName"] ?></option>
                            <?php          
                            }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="product_desc">
                            <?php echo $data2["product_desc"]; ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input value="<?php echo $data2["price"];?>" type="text" placeholder="Enter Price..." class="medium" name="price"/>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <div>
                            <img src="uploads/<?php echo $data2["image"]?>" alt="photo product" height="80">
                        </div>
                        <input hidden name = "nameImage" value="<?php echo $data2["image"]?>" >
                        <input type="file"  accept="jpg/*, jpeg/*, png/*, gif/*" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label >Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option
                                <?php 
                                    if ($data2["type"]==="1") {
                                        echo "selected";
                                    }
                                ?>
                                value="1">Featured</option>
                            <option 
                                <?php 
                                    if ($data2["type"]==="2") {
                                        echo "selected";
                                    } 
                                ?>
                                value="2">Non-Featured</option>
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

<?php    
?>
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


