<?php
	include_once './inc/header.php';
	include_once './inc/slider.php';
?>
<?php
	if (isset($_GET["cartDelId"]) && $_GET["cartDelId"] != null){
		$cartDelId = $_GET["cartDelId"];
		$deleteCart = $cart->deleteCartById($cartDelId);
	}
	if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["quantity"]) && isset($_GET["productId"])){
		$quantity = $_POST["quantity"];
		$productId = $_GET["productId"];
		$updateQuantity = $cart->updateQuantityById($productId, $quantity);
		if (!$updateQuantity){
			header('Location: cart.php');
		} else{
		}
	}
?>
<?php
	if(!isset($_GET["id"])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php 
						if (isset($updateQuantity)){echo $updateQuantity;}
						if (isset($deleteCart)){echo $deleteCart;}
					?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$myCarts = $cart->showCart();
								$totalPrice = 0;
								if ($myCarts){
									while ($result = $myCarts->fetch_assoc()){
										$totalPrice += ((int)$result["price"])*((int)$result["quantity"]);
										?>
										<tr>
											<td><?php echo $result["productName"]?></td>
											<td><img  src="./shop/admin/uploads/<?php echo $result["image"];?>" alt=""/></td>
											<td><?php echo $result["price"]." VND"?></td>
											<td>
												<form action="?productId=<?php echo $result["productId"]; ?>" method="post">
													<input type="number" min="1" name="quantity" value="<?php echo $result["quantity"];?>"/>
													<input type="submit" name="submit" value="Update"/>
												</form>
											</td>
											<td><?php echo ((int)$result["price"])*((int)$result["quantity"])." VND"?></td>
											<td><a href="?cartDelId=<?php echo$result["cartId"];?>" onclick ='return confirm("You want to delete")'> X</a></td>
										</tr>
										<?php
									}
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
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 
 <?php
	include './inc/footer.php';
 ?>