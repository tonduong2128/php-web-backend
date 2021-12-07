
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
    }
?>