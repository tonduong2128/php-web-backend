<?php
	include_once './inc/header.php';
	// include './inc/slider.php';
?>
<?php
	if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['compare'])){
		$productId = $_POST["productId"];
		$insertCompare = $product->insertCompare($productId, $customerId);
	}
	if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['wishlist'])){
		$productId = $_POST["productId"];
		$insertWishlist = $product->insertWishlist($productId, $customerId);
	}
?>
 <div class="main">
    <div class="content">
		<?php
			if (isset($_GET["productId"])){
				$productId = $_GET["productId"];
				$pro = $product->getProductById($productId);

				if ($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST['submit'])){
					$quantity=$_POST["quantity"];
					$addToCart = $cart->addToCart($productId, $quantity);
				}

				if ($pro){
					while ($result = $pro->fetch_assoc()){
		?>
    	<div class="section group">
						<div class="cont-desc span_1_of_2">				
							<div class="grid images_3_of_2">
								<img style="object-fit: cover; width:230px; height:230px;" src="./shop/admin/uploads/<?php echo $result["image"];?>" alt="" />
							</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result["productName"]; ?></h2>
							<p><?php echo $format->textShorten($result["product_desc"],150) ;?></p>					
							<div class="price">
								<p>Price: <span><?php echo $result["price"]." VND" ; ?></span></p>
								<p>Category: <span>
									<?php
										$cat = $category->getCategoryById($result["catId"]);
										if ($category){
											while ($nameCat = $cat->fetch_assoc()){
												echo $nameCat["catName"];
											}
										}
									?>
								</span></p>
								<p>Brand:<span>
									<?php
										$bra = $brand->getBrandById($result["brandId"]);
										if ($bra){
											while ($nameBrand = $bra->fetch_assoc()){
												echo $nameBrand["brandName"];
											}
										}
									?>
								</span></p>
							</div>
						<div class="add-cart">
							<form action="" method="post">
								<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
								<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
							</form>				
						</div>
						<?php
							$login_check = Session::get('customer_login');
							if ($login_check){
						?>
							<div style="display: flex;">
								<div class="add-cart">
									<form action="" method="POST">
										<input type="hidden" class="buysubmit" name="productId" value="<?php echo $result["productId"];?>"/>				
										<input type="submit" class="buysubmit" name="compare" value="Compare product"/>				
									</form>
									<?php
										if (isset($insertCompare)){
											echo $insertCompare;
										}
									?>
								</div>
								<div style="padding:6px"></div>
								<div class="add-cart">
									<form action="" method="POST">
										<input type="hidden" class="buysubmit" name="productId" value="<?php echo $result["productId"];?>"/>				
										<input type="submit" class="buysubmit" name="wishlist" value="Save to wishlist"/>				
									</form>
									<?php
										if (isset($insertWishlist)){
											echo $insertWishlist;
										}
									?>
								</div>
							</div>
						<?php			 
							} 
						?>
						
		</div>
		<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result["product_desc"];?></p>
	    </div>
		<?php }
				} else{
					echo "<script> window.location = '404.php'</script>";
				}
			} else{
				// header("Location:cart.php");
			}
		?>		
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					  	<?php
							$getCategory = $category->showCategory();
							if ($getCategory){
								while ($result = $getCategory->fetch_assoc()){
						?>
							<li>
								<a href="productbycat.php?catId=<?php echo $result["catId"]?>">
									<?php echo $result["catName"];?>
								</a>
							</li>
						<?php
								}
							} 
					  	?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
</div>
  
<?php
	include_once './inc/footer.php';
x?>