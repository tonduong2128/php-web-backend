<?php
    include '../../lib/database.php';
    include '../../helpers/format.php'
?>




<?php
    class Category 
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function insertCategory($catName){
            $catName = $this->fm->validation($catName);

            $catName = mysqli_real_escape_string($this->db->link, $catName);


            if (empty($catName)){
                $alert = "<span class='error'> Category name must be not empty </span>";
                return $alert;
            } else{
                $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
                $result=$this->db->insert($query);
                if ($result){
                    $alert = "<span class='success'>Insert Category Successfully</span>";
                    return $alert;
                } else{
                    $alert = "<span class='error'>Insert Category Not Successfully</span>";
                    return $alert;
                }
            }
        }
        public function loginCheck(){
            
        }
        public function loginDestroy(){
            
        }

        public function showCategory(){
            $query = "SELECT * FROM tbl_category order by catId desc ";
            $result=$this->db->select($query);
            return $result;
        }
        public function getCategoryById($catId){
            $query = "SELECT * FROM tbl_category WHERE catId='$catId' LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        }
        public function updateCategoryWithId($catId,$catName){
            $catIdNum= (int)$catId;
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = $catIdNum";
            $result = $this->db->update($query);
            return $result;
        }
        public function deleteCategoryById($id){
            $id = (int)$id;
            $query = "DELETE FROM tbl_category WHERE catId = $id";
            $result = $this->db->delete($query);
            if ($result) {
                return "<p class='success'>Delete Category success</p>";
            } else{
                return "<p class='error'> Category id not match</p>";
            }
        }
    }
?>