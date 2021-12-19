
<?php
    $filePath=realpath(dirname(__FILE__));
    include_once $filePath.'/../lib/database.php';
    include_once $filePath.'/../helpers/format.php';
?>


<?php
    class Cart    
    {
        private $db;
        private $fm;

        public function __construct(){
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function addToCart($productId, $quantity){

            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link,$quantity);
            
            $productId = mysqli_real_escape_string($this->db->link,$productId);
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE productId='$productId' AND sessionId='".session_id()."'";
            $result = $this->db->select($query);
            if ($result){
                $newQuantity = $result->fetch_assoc()["quantity"] +$quantity; 
                $this->updateQuantityById($productId,$newQuantity);
            } else{
                $query = "SELECT * FROM tbl_product WHERE productId='$productId'";
                $result = $this->db->select($query)->fetch_assoc();
                $query = "INSERT INTO tbl_cart (productId, sessionId, productName, price, quantity, image) 
                        VALUES (' ".$result["productId"]."', '$sessionId', '".$result["productName"]." ', '".$result["price"]."', '$quantity', '".$result["image"]."')";
                $result = $this->db->insert($query);
            }

            if ( $result ) {
                header('Location:cart.php'); //sai vì đã có session rồi //đã xóa bên slide
                // echo '<script> window.location = "cart.php"</script>';

            } else {
                header('Location:404.php');
                // echo '<script> window.location = "404.php"</script>';
            };
        }
        public function showCart(){
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sessionId='$sessionId'";
            $result=$this->db->select($query);
            return $result;
        }
        public function updateQuantityById($productId, $quantity){
            $sessionId = session_id();
            $query = "UPDATE tbl_cart SET quantity = $quantity WHERE sessionId='$sessionId' AND productId=$productId";
            $result = $this->db->update($query);
            if ($result){
                return "<p class='error' style='font-size:20px; color: green';>Update quantity product sussesful</p>";
            } {
                return "<p class='sussess' style='font-size:20px; color: red;'>Update quantity product not sussesful</p>";
            }
        }
        public function deleteCartById($cartDelId){
            $query = "DELETE FROM tbl_cart WHERE cartId = $cartDelId";
            $result = $this->db->delete($query);
            if ($result){
                return "<p class='error' style='font-size:20px; color: green';>Delete cart sussesful</p>";
            } {
                return "<p class='sussess' style='font-size:20px; color: red;'>Delete cart product not sussesful</p>";
            }    
        }
        public function delAllCart(){
            $sessionId = session_id();
            $query = "DELETE FROM `tbl_cart` WHERE `sessionId`='$sessionId' ;";
            $result = $this->db->delete($query);
            return $result;
        }
        public function checkCart(){
            $sessionId = session_id();
            $query="SELECT* FROM tbl_cart WHERE sessionId='$sessionId'";
            $result = $this->db->select($query);
            if ($result){
                return true;
            }
            return false;
        }
        public function orderCheck($customerId){
            $query="SELECT* FROM tbl_order WHERE customerId='$customerId'";
            $result = $this->db->select($query);
            if ($result){
                return true;
            }
            return false;
        }
        public function insertOrder($customerId){
            $sessionId = session_id();
            $query="SELECT* FROM tbl_cart WHERE sessionId='$sessionId'";
            $getProduct = $this->db->select($query);
            if ($getProduct){
                while ($result = $getProduct->fetch_assoc()){
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price']*$quantity;
                    $image = $result['image'];
                    $customerId = $customerId;
                    $query_oder = "INSERT INTO tbl_order(productId, productName, quantity, price, image, customerId) 
                    VALUES ($productId, '$productName', $quantity, '$price', '$image', $customerId)";
                    $resultInsert = $this->db->insert($query_oder);
                }
                return $resultInsert;
            }
            return false;
        }
        public function getAmountPrice($customerId){
            $query = "SELECT price FROM tbl_order WHERE customerId='$customerId'";
            $getPrice = $this->db->select($query);
            return $getPrice;
        }
        public function getCartOrder($customerId){
            $query = "SELECT * FROM tbl_order WHERE customerId='$customerId'";
            $result = $this->db->select($query);
            return $result;
        }



        //admin
        public function getInboxCart(){
            $query = "SELECT* FROM tbl_order";
            $result = $this->db->select($query);
            return $result;
        } 
        public function shifted($shiftId, $time, $price)
        {
            $id = mysqli_real_escape_string($this->db->link, $shiftId);
            $time =  mysqli_real_escape_string($this->db->link, $time);
            $price =  mysqli_real_escape_string($this->db->link, $price);
            $query = "UPDATE tbl_order SET status = 1 WHERE id=$id AND date='$time' AND price='$price'";
            $result = $this->db->update($query);
            if ($result){
                return "<p class='error' style='font-size:20px; color: green';>Update order sussesful</p>";
            } {
                return "<p class='sussess' style='font-size:20px; color: red;'>Update order not sussesful</p>";
            } 
        }
        public function delShifted($shiftId, $time, $price)
        {
            $id = mysqli_real_escape_string($this->db->link, $shiftId);
            $time =  mysqli_real_escape_string($this->db->link, $time);
            $price =  mysqli_real_escape_string($this->db->link, $price);
            $query = "DELETE FROM tbl_order WHERE id=$id AND date='$time' AND price='$price'";
            $result = $this->db->delete($query);
            if ($result){
                return "<p class='error' style='font-size:20px; color: green';>Result order sussesful</p>";
            } {
                return "<p class='sussess' style='font-size:20px; color: red;'>Result order not sussesful</p>";
            }
        }
        public function shiftedConfirm($customerId, $time, $price)
        {
            $customerId = mysqli_real_escape_string($this->db->link, $customerId);
            $time =  mysqli_real_escape_string($this->db->link, $time);
            $price =  mysqli_real_escape_string($this->db->link, $price);
            $query = "UPDATE tbl_order SET status = 2 WHERE customerId=$customerId AND date='$time' AND price='$price'";
            $result = $this->db->update($query);
            if ($result){
                return "<p class='error' style='font-size:20px; color: green';>Confirm order sussesful</p>";
            } {
                return "<p class='sussess' style='font-size:20px; color: red;'>Confirm order not sussesful</p>";
            } 
        }
    }
?>