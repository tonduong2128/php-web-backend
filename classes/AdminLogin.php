<?php
    include_once '../../lib/session.php';
    Session::checkLogin();
    include '../../lib/database.php';
    include '../../helpers/format.php'
?>




<?php
    class AdminLogin 
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function loginAdmin($adminUser, $adminPass){
            $adminUser = $this->fm->validation($adminUser);
            $adminPass = $this->fm->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
            if (empty($adminUser)||empty($adminPass)){
                $alert = "User and pass must be not empty";
                return $alert;
            } else{
                $md5AdminPass = md5($adminPass);
                $query = "SELECT* FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$md5AdminPass' LIMIT 1 ";
                $result=$this->db->select($query);
                if ($result){
                    $value = $result->fetch_assoc();
                    var_dump($value);
                    Session::set('login', true);
                    Session::set('adminId', $value['adminId']);
                    Session::set('adminUser', $value['adminUser']);
                    Session::set('adminName', $value['adminName']);
                    header('Location: index.php');
                } else{
                    return $alert = "User and pass not match";
                }
            }
        }
        public function loginCheck(){
            
        }
        public function loginDestroy(){
            
        }
    }
?>