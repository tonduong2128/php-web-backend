<?php
	include_once './inc/header.php';
	// include './inc/slider.php';
?>
<style>
    .box_left{
        border:1px solid #ccc;
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
<?php
    $isLogined =Session::get('login_check'); 
    if (!isset($isLogined)){
        header("Location:login.php");
    }
?>
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
                    <table class="tblone">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Product Name</th>
                            <th width="15%">image</th>
                            <th width="15%">Price</th>
                            <th width="10%">Quantity</th>
                            <th width="15%"> Date</th>
                            <th width="15%"> Status</th>
                            <th width="10%"> Action</th>
                        </tr>
                        <?php
                            $customerId = Session::get('customer_id');
                            $getCartOrder = $cart->getCartOrder($customerId);
                            if ($getCartOrder){
                                $i=1;
                                while ($result = $getCartOrder->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $result["productName"]?></td>
                                        <td><img src="./shop/admin/uploads/<?php echo $result["image"];?>" alt=""></td>
                                        <td><?php echo $result["price"]." VND"?></td>
                                        <td>
                                            <?php echo $result["quantity"];?>   
                                        </td>
                                        <td><?php echo $format->formatDate($result['date']);?></td>
                                        <td>
                                            <?php 
                                                if ($result['status']){
                                                    echo "Processed";
                                                } else{
                                                    echo "Pending";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                        <?php
                                            if (!$result['status']){
                                        ?>
                                            <a href=">cartId" onclick="return confirm('Are you want to delete');">
                                                <?php echo "Xóa" ;?>
                                            </a>
                                        <?php
                                            } else{
                                                echo "N/A";
                                            }
                                        ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else{
                                echo "Cart is empty";
                            }
                        ?>	
                    </table>	
                    </div>
                </div>
            </div>
            <div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="./shop/images/shop.png" alt="" /></a>
				</div>
                <div style="clear:both"></div>
			</div>	
         </div>
    </div>
</form>
  
<?php
	include_once './inc/footer.php';
?>