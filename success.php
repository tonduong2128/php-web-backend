<?php
	include_once './inc/header.php';
	// include './inc/slider.php';
?>

<?php
    // if (isset($_GET["orderId"]) && $_GET["orderId"]=!NULL){
    //     $customerId = Session::get("customer_id");
    //     $insertOrder = $cart>insertOrder($customerId);
    //     $delCart = $cart->delAllCart();
    //     header('Location:sussess.php');
    // }
?>
<style>
    .box_left{
        width:50%;
        border:1px solid #ccc;
        float: left;
        padding: 10px;
    }
    .box_right{
        width:45%;
        border:1px solid #ccc;
        float: right;
        padding: 10px;
    }
</style>
<style>
    .btn-profile{
        border:1px solid #ccc;
        padding:8px 10px; 
        border-radius:10px; 
        font-weight:600; 
        background-color:rgba(0,0,0,0.1);
    }
    .btn-profile:hover{
        background-color:rgba(0,0,0,0.2);
    }
</style>
<form action="" method="Post">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Success order</h3>
                    <?php
                        $customerId = Session::get("customer_id");            
                        $getAmount = $cart->getAmountPrice($customerId);
                        $amount =0;
                        if ($getAmount){
                            while($result = $getAmount->fetch_assoc()){
                                $amount+=$result['price'];
                            }
                        }
                    ?>
                    <p style="display:inline-block;">Tatol Price You Have Bought From My Website: <p style="color:red; display:inline-block;"> 
                        <?php echo $amount*1.1; ?></p> VND
                    </p>
                    <p>We will contact as soon as possiable. Please see your order details here <a style="text-decoration:underline;" href="orderDetail.php">Click here</a></p>
                </div>
            </div>    
        </div>
    </div>
</form>
  
<?php
	include_once './inc/footer.php';
?>