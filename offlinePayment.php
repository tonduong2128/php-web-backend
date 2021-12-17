<?php
	include_once './inc/header.php';
	// include './inc/slider.php';
?>

<?php
    if (isset($_GET["orderId"]) && $_GET["orderId"]=!NULL){
        $customerId = Session::get("customer_id");
        $insertOrder = $cart->insertOrder($customerId);
        if ($insertOrder){
            $destroyCart = $cart->delAllCart();
            header('Location:success.php');
        } else{
            header('Location:cart.php');
        }

    }
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
                    <h3>Offline payment</h3>
                </div>
                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
                    <?php 
                        if (isset($updateQuantity)){echo $updateQuantity;}
                        if (isset($deleteCart)){echo $deleteCart;}
                    ?>
                    <table class="tblone">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Product Name</th>
                            <th width="25%">Price</th>
                            <th width="15%">Quantity</th>
                            <th width="25%">Total Price</th>
                        </tr>
                        <?php
                            $myCarts = $cart->showCart();
                            $totalPrice = 0;
                            if ($myCarts){
                                $i=1;
                                while ($result = $myCarts->fetch_assoc()){
                                    $totalPrice += ((int)$result["price"])*((int)$result["quantity"]);
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $result["productName"]?></td>
                                        <td><?php echo $result["price"]." VND"?></td>
                                        <td>
                                            <?php echo $result["quantity"];?>   
                                        </td>
                                        <td><?php echo ((int)$result["price"])*((int)$result["quantity"])." VND"?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else{
                                echo "Cart is empty";
                            }
                        ?>	
                    </table>	
                    <table style="float:right;text-align:left;" width="40%">
                            <tr>
                                <th>Sub Total : </th>
                                <td>
                                    <?php echo ($totalPrice)." VND";
                                        Session::set("sum", $totalPrice);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>VAT : </th>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <th>Grand Total :</th>
                                <td><?php echo ($totalPrice*1.1)." VND"?></td>
                            </tr>
                    </table>	
                    </div>
                </div>
                <div class="box_right">
                <table class="tblone" >
                    <?php
                        $id = Session::get("customer_id");
                        $getCustomer = $customer->showCustomer($id);
                        if ($result = $getCustomer->fetch_assoc()){
                    ?>
                        <tr>
                            <td colspan="3" style="font-size:26px;"><div>Profile</div></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $result["name"];?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo $result["address"];?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><?php echo $result["city"];?></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td><?php echo $result["country"];?></td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td><?php echo $result["zipcode"];?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?php echo $result["phone"];?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $result["email"];?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div style="text-align:right; margin:8px 0;">
                                    <div >
                                        <a
                                            class="btn-profile"
                                            href="editProfile.php"
                                        >Update Profile</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tr>
                    <?php        
                        }
                        ?>
                </table>
                </div>
            </div>
            <div style="text-align:center; margin-top:30px;" >
                <a href="?orderId=order" class="btn-profile" style="top: 40px; font-size:26px;" >Order now</a>
            </div>
         </div>
    </div>
</form>
  
<?php
	include_once './inc/footer.php';
?>