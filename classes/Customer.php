
<?php
    $filePath=realpath(dirname(__FILE__));
    include_once $filePath.'/../lib/database.php';
    include_once $filePath.'/../helpers/format.php';
?>


<?php
    class Customer    
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function insertCustomer($data){
            $name = mysqli_real_escape_string($this->db->link, $data["name"]);
            $city = mysqli_real_escape_string($this->db->link, $data["city"]);
            $zipcode = mysqli_real_escape_string($this->db->link, $data["zipcode"]);
            $email = mysqli_real_escape_string($this->db->link, $data["email"]);
            $address = mysqli_real_escape_string($this->db->link, $data["address"]);
            $country = mysqli_real_escape_string($this->db->link, $data["country"]);
            $phone = mysqli_real_escape_string($this->db->link, $data["phone"]);
            $password = mysqli_real_escape_string($this->db->link,md5($data["password"]));
            
            if ($name=="" || $city=="" || $zipcode=="" || $email=="" || $address=="" || $country==""|| $phone=="" || $password==""){
                $alert = "<p class='error' >Field must be not empty</p>";
                return $alert;
            } else{
                $checkEmail ="SELECT * FROM tbl_customer WHERE email='$email'";
                $result_check = $this->db->select($checkEmail);
                if ($result_check){
                    $alert = "<p class='error' >Email aready existed ! Pleaz enter other email</p>";
                    return $alert;
                }
                $query = "INSERT INTO tbl_customer(name ,city, zipcode, email, address, country, phone, password) 
                                    VALUES('$name', '$city', '$zipcode', '$email', '$address', '$country', '$phone', '$password')";
                $result = $this->db->insert($query);
                if ($result){
                    $alert = "<p class='susses' >Insert customer sussesfully !!!</p>";
                    return $alert;    
                } else{
                    $alert = "<p class='error' >Sometime wrong. Pleaz try again !!!</p>";
                    return $alert;
                }
            }
        }
        public function loginCustomer($data){
            $email = mysqli_real_escape_string($this->db->link, $data["email"]);
            $password = mysqli_real_escape_string($this->db->link, md5($data["password"]));
            if ($email =="" || $password==""){
                $alert = "<p class='error' >Field must be not empty</p>";
                return $alert;
            } else{
                $checkAccount ="SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' LIMIT 1";
                $result_check = $this->db->select($checkAccount);
                if ($result_check){
                    $result = $result_check->fetch_assoc();
                    Session::set('customer_login', true);
                    Session::set('customer_id', $result['id']);
                    Session::set('customer_name', $result['name']);
                    echo "<script>window.location='order.php'</script>";
                } else{
                    $alert = "<p class='error' >Email or password not match</p>";
                    return $alert;
                }
            }
        }
        function showCustomer($id){
            $query = "SELECT* FROM tbl_customer WHERE id='$id'";
            $result = $this->db->select($query);
            return $result;
        }
        function updateCustomer($data){
            $name = $data['name'];
            $address = $data['address'];
            $city = $data['city'];
            $country = $data['country'];
            $zipcode = $data['zipcode'];
            $phone = $data['phone'];
            $email = $data['email'];
            $query = "UPDATE tbl_customer SET name='$name', address='$address', city='$city', country='$country', 
            zipcode='$zipcode', phone='$phone', email='$email';";
            $result = $this->db->update($query);
            return $result;
        }
    }
?>