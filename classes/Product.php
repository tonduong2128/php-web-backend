<?php
    include_once '../../lib/database.php';
    include_once '../../helpers/format.php';
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
        // public function loginCheck(){
            
        // }
        // public function loginDestroy(){
            
        // }

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
        public function updateProductWithId($productId,$data){
            $productIdNum= (int)$productId;
            $query = "UPDATE tbl_product SET productName='".$data['productName'].
            "', catId='".$data['category']."', brandId='".$data['brand']."',
            product_desc='".$data['product_desc']."',
            type='".$data['type']."',
            price='".$data['price']."'
              WHERE productId = '".$productIdNum."'";
            $result = $this->db->update($query);    
            if ($result) {
                return "<p class='success'>Update product success</p>";
            } else{
                return "<p class='error'> Product id not match </p>";
            }
        }
        public function deleteProductById($id){
            $id = (int)$id;
            $query = "DELETE FROM tbl_product WHERE productId = $id";
            $result = $this->db->delete($query);
            if ($result) {
                return "<p class='success'>Delete product success</p>";
            } else{
                return "<p class='error'> Product id not match </p>";
            }
        }
    }
?>