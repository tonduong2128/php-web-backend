<?php
	include_once './inc/header.php';
	include_once './inc/slider.php';
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 style="min-width: max-content;">Compare Product</h2>
					<table class="tblone">
						<tr>
							<th width="10%">ID</th>
							<th width="20%">Product Name</th>
							<th width="20%">Image</th>
							<th width="15%">Price</th>
							<th width="15%">Action</th>
						</tr>
						<?php
							$customerId = Session::get("customer_id");
							$getCompare = $product->getCompare($customerId);
							if ($getCompare){
									$id=0;
									while ($result = $getCompare->fetch_assoc()){
									$id++;
									?>
									<tr>
										<td><?php echo $id; ?></td>
										<td><?php echo $result["productName"]?></td>
										<td><img  src="./shop/admin/uploads/<?php echo $result["image"];?>" alt=""/></td>
										<td><?php echo $format->currency($result["price"])." VND" ; ?></td>
										<td>
											<a href="details.php?productId=<?php echo $result["productId"];?>">View</a>
										</td>
									</tr>
									<?php
								}
							} else{
								echo "Compare is empty";
							}
						?>	
					</table>	
			</div>
			<div class="shopping">
				<div class="shopleft" style="width:100%;">
					<a href="index.php"> <img src="./shop/images/shop.png" alt="" /></a>
				</div>
			</div>		
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 
 <?php
	include_once './inc/footer.php';
 ?>