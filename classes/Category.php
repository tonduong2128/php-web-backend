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
    }
?>