<?php
    $filePath=realpath(dirname(__FILE__));
    include_once  $filePath.'/../lib/database.php';
    include_once  $filePath.'/../helpers/format.php'
?>




<?php
    class Brand 
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function insertBrand($brandName){
            $brandName = $this->fm->validation($brandName);

            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if (empty($brandName)){
                $alert = "<span class='error'> Brand name must be not empty </span>";
                return $alert;
            } else{
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                $result=$this->db->insert($query);
                if ($result){
                    $alert = "<span class='success'>Insert Brand Successfully</span>";
                    return $alert;
                } else{
                    $alert = "<span class='error'>Insert Brand Not Successfully</span>";
                    return $alert;
                }
            }
        }
        public function showBrand(){
            $query = "SELECT * FROM tbl_brand order by brandId desc ";
            $result=$this->db->select($query);
            return $result;
        }
        public function getBrandById($brandId){
            $query = "SELECT * FROM tbl_brand WHERE brandId='$brandId' LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        }
        public function updateBrandWithId($brandId,$brandName){
            $brandIdNum= (int)$brandId;
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = $brandIdNum";
            $result = $this->db->update($query);
            return $result;
        }
        public function deleteBrandById($id){
            $id = (int)$id;
            $query = "DELETE FROM tbl_brand WHERE brandId = $id";
            $result = $this->db->delete($query);
            if ($result) {
                return "<p class='success'>Delete brand success</p>";
            } else{
                return "<p class='error'> brand id not match</p>";
            }
        }
    }
?>