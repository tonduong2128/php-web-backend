<?php
    $filePath=realpath(dirname(__FILE__));
    include_once $filePath.'/../lib/database.php';
    include_once $filePath.'/../helpers/format.php';
?>


<?php
    class Product    
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function insertProduct($data , $files) 
        {

            $productName = mysqli_real_escape_string($this->db->link, $data["productName"]);
            $brand = mysqli_real_escape_string($this->db->link, $data["brand"]);
            $category = mysqli_real_escape_string($this->db->link, $data["category"]);
            $product_desc = mysqli_real_escape_string($this->db->link, $data["product_desc"]);
            $price = mysqli_real_escape_string($this->db->link, $data["price"]);
            $type = mysqli_real_escape_string($this->db->link, $data["type"]);


            //kiểm tra hình ảnh và lưu vào folder upload
            $perimited = array('jpg','jpeg','png','gif');
            $file_name = $files['image']['name'];
            $file_size = $files['image']['size'];
            $file_temp = $files['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image="uploads/".$unique_image;

            if ($productName == "" || $brand == ""|| $category == "" || $product_desc == ""|| $price == ""|| $type == "" || $file_name=="") {
                $alert = "<span class='error'> Fields must be not empty </span>";
                return $alert;
            } else{
                // upload hình ảnh vào folder uploads
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tbl_product(productName, brandId, catId, product_desc, price, type, image) 
                    VALUES('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
                $result=$this->db->insert($query);
                if ($result){
                    $alert = "<span class='success'>Insert product Successfully</span>";
                    return $alert;
                } else{
                    $alert = "<span class='error'>Insert product Not Successfully</span>";
                    return $alert;
                }
            }
        
        }

        public function showProduct(){
            $query = "SELECT * FROM tbl_product order by productId desc ";
            $result=$this->db->select($query);
            return $result;
        }
        public function getProductById($productId){
            $query = "SELECT * FROM tbl_product WHERE productId='$productId' LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        }
        public function updateProductWithId($productId,$data ,$files){
            $productName = mysqli_real_escape_string($this->db->link, $data["productName"]);
            $brand = mysqli_real_escape_string($this->db->link, $data["brand"]);
            $category = mysqli_real_escape_string($this->db->link, $data["category"]);
            $product_desc = mysqli_real_escape_string($this->db->link, $data["product_desc"]);
            $price = mysqli_real_escape_string($this->db->link, $data["price"]);
            $type = mysqli_real_escape_string($this->db->link, $data["type"]);


            //kiểm tra hình ảnh và lưu vào folder upload
            $perimited = array('jpg','jpeg','png','gif');
            $file_name = $files['image']['name'];
            $file_size = $files['image']['size'];
            $file_temp = $files['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image="uploads/".$unique_image;

            if ($productName == "" || $brand == ""|| $category == "" || $product_desc == ""|| $price == ""|| $type == "") {
                $alert = "<span class='error'> Fields must be not empty </span>";
                return $alert;
            } else{
                
                if ($file_name !== ""){
                    unlink("uploads/".$data["nameImage"]);
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product SET productName='$productName', catId=$category, brandId=$brand,
                    product_desc='$product_desc', type=$type, price=$price, image='$unique_image' WHERE productId = $productId;";
                    $result = $this->db->update($query);    
                    if ($result) {
                        return "<p class='success'>Update product success</p>";
                    } else{
                        return "<p class='error'> Product id not match </p>";
                    }
                } else{
                    $query = "UPDATE tbl_product SET productName='$productName', 
                    catId=$category, brandId=$brand,
                    product_desc='$product_desc', type=$type ,price=$price WHERE productId = $productId;";
                    $result = $this->db->update($query);    
                    if ($result) {
                        return "<p class='success'>Update product success</p>";
                    } else{
                        return "<p class='error'> Product id not match </p>";
                    }
                }
            }
        }
        public function deleteProductById($id, $image){
            $id = (int)$id;
            $query = "DELETE FROM tbl_product WHERE productId = $id";
            $result = $this->db->delete($query);
            if ($result) {
                unlink('uploads/'.$image);
                return "<p class='success'>Delete product success</p>";
            } else{
                return "<p class='error'> Product id not match </p>";
            }
        }
        public function insertSlider($data, $files)
        {
            $silderName = mysqli_real_escape_string($this->db->link, $data["sliderName"]);
            $type = mysqli_real_escape_string($this->db->link, $data["type"]);

            //kiểm tra hình ảnh và lưu vào folder upload
            $perimited = array('jpg','jpeg','png','gif');
            $file_name = $files['image']['name'];
            $file_size = $files['image']['size'];
            $file_temp = $files['image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image="uploads/".$unique_image;

            if ($silderName == "" || $type == ""|| $file_name="") {
                $alert = "<span class='error'> Fields must be not empty </span>";
                return $alert;
            } else{
                // upload hình ảnh vào folder uploads
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tbl_slider(sliderName, image, type) 
                    VALUES('$silderName', '$unique_image', '$type')";
                $result=$this->db->insert($query);
                if ($result){
                    $alert = "<span class='success'>Insert slider Successfully</span>";
                    return $alert;
                } else{
                    $alert = "<span class='error'>Insert slider Not Successfully</span>";
                    return $alert;
                }
            }
        }
        public function showSlider()
        {
            $query = "SELECT * FROM tbl_slider WHERE type=1 order by id desc ";
            $result=$this->db->select($query);
            return $result;   
        }
        public function showSliderAdmin()
        {
            $query = "SELECT * FROM tbl_slider order by id desc ";
            $result=$this->db->select($query);
            return $result;   
        }
        public function deleteSliderById($sliderId, $image)
        {
            $query = "DELETE FROM tbl_slider WHERE id=$sliderId";
            $result = $this->db->delete($query);
            if ($result){
                unlink('uploads/'.$image);
            }
            if ($result){
                $alert = "<span class='success'>Delete slider Successfully</span>";
                return $alert;
            } else{
                $alert = "<span class='error'>Delete slider Not Successfully</span>";
                return $alert;
            }
        }
        public function updateTypeSlider($id, $type)
        {
            $query ="UPDATE tbl_slider SET type='$type' WHERE id=$id";
            $result = $this->db->update($query);
            if ($result){
                $alert = "<span class='success'>Change type slider Successfully</span>";
                return $alert;
            } else{
                $alert = "<span class='error'>Change type slider Not Successfully</span>";
                return $alert;
            }
        }

        //BACKEND
        public function getProductFeathered(){
            $query = "SELECT * FROM tbl_product WHERE type=1";
            $result=$this->db->select($query);
            return $result; 
        }
        public function getProductNew(){
            $quantityEachPage = 4;
            if (!isset($_GET['page'])){
                $page=1;
            } else{
                $page = $_GET["page"];
            }
            $quantity = $quantityEachPage*$page;
            $start = ($page - 1)*$quantityEachPage;
            $query = "SELECT * FROM tbl_product order by productId desc LIMIT $start,$quantityEachPage";
            $result=$this->db->select($query);
            return $result;
        }
        public function getAllProduct(){
            $query = "SELECT * FROM tbl_product order by productId desc";
            $result=$this->db->select($query);
            return $result;
        }
        public function getLastedSamsung(){
            $query = "SELECT * FROM tbl_product WHERE brandId=1 order by productId  desc LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        } 
        public function getLastedApple(){
            $query = "SELECT * FROM tbl_product WHERE brandId=2 order by productId  desc LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        } 
        public function getLastedDell(){
            $query = "SELECT * FROM tbl_product WHERE brandId=3 order by productId  desc LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        } 
        public function getLastedOppo(){
            $query = "SELECT * FROM tbl_product WHERE brandId=4 order by productId  desc LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        }
        
        public function insertCompare($productId, $customerId)
        {
            $productId = mysqli_real_escape_string($this->db->link,$productId);
            $customerId = mysqli_real_escape_string($this->db->link,$customerId);
            
            $query = "SELECT * FROM tbl_compare WHERE productId='$productId' AND customerId='$customerId'";
            $result = $this->db->select($query);
            if ($result){
                return "<p class='error'>Added compare already </p>";
            }

            $query = "SELECT * FROM tbl_product WHERE productId='$productId'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result["productName"];
            $price = $result["price"];
            $image = $result["image"];

            $queryCompare = "INSERT INTO tbl_compare (productId, customerId, productName, price, image) 
                VALUES ($productId, $customerId, '$productName', '$price', '$image')";
            $insertCompare = $this->db->insert($queryCompare);

            if ($insertCompare) {
                return "<p class='success'>Added compare success</p>";
            } else{
                return "<p class='error'>Added compare not success </p>";
            };
        }
        public function getCompare($customerId)
        {
            $query = "SELECT * FROM tbl_compare WHERE customerId='$customerId'";
            $result=$this->db->select($query);
            return $result;
        }
        public function delAllCompare($customerId)
        {
            $query = "DELETE FROM tbl_compare WHERE customerId='$customerId'";
            $result=$this->db->delete($query);
            return $result;
        }

        public function insertWishlist($productId, $customerId)
        {
            $productId = mysqli_real_escape_string($this->db->link,$productId);
            $customerId = mysqli_real_escape_string($this->db->link,$customerId);
            
            $query = "SELECT * FROM tbl_wishlist WHERE productId='$productId' AND customerId='$customerId'";
            $result = $this->db->select($query);
            if ($result){
                return "<p class='error'>Added compare already </p>";
            }

            $query = "SELECT * FROM tbl_product WHERE productId='$productId'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result["productName"];
            $price = $result["price"];
            $image = $result["image"];

            $queryCompare = "INSERT INTO tbl_wishlist (productId, customerId, productName, price, image) 
                VALUES ($productId, $customerId, '$productName', '$price', '$image')";
            $insertCompare = $this->db->insert($queryCompare);

            if ($insertCompare) {
                return "<p class='success'>Added wishlist success</p>";
            } else{
                return "<p class='error'>Added wishlist not success </p>";
            };
        }
        public function getWishlist($customerId)
        {
            $query = "SELECT * FROM tbl_wishlist WHERE customerId='$customerId'";
            $result=$this->db->select($query);
            return $result;
        }
        public function delWishlist($productId, $customerId)
        {
            $query = "DELETE FROM tbl_wishlist WHERE customerId='$customerId' AND productId='$productId' ";
            $result=$this->db->delete($query);
            return $result;
        }


        public function searchProdct($search)
        {
            $search = $this->fm->validation($search);
            $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$search%' ";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>