
<?php
    $filePath=realpath(dirname(__FILE__));
    include_once $filePath.'/../lib/database.php';
    include_once $filePath.'/../helpers/format.php';
?>


<?php
    class User    
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db=new Database();
            $this->fm=new Format();
        }
    }
?>