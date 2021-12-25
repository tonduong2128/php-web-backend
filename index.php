<?php
	include_once './inc/header.php';
	include_once './inc/slider.php';
?>
<?php
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group" style="height:100%;">
		<?php
			  	$getProductFeathead = $product->getProductFeathered();
				if ($getProductFeathead){
					while ($result = $getProductFeathead->fetch_assoc()){
		?>
						<div class="grid_1_of_4 images_1_of_4">
							<a href="details.php?productId=<?php echo $result["productId"]?>" >
								<img style="object-fit: cover; width:230px; height:230px;" src="./shop/admin/uploads/<?php echo $result["image"];?>" alt="" />
							</a>
							<h2><?php echo $result["productName"]; ?></h2>
							<p><?php echo $format->textShorten($result["product_desc"],50);?></p>
							<p><span class="price"><?php echo $format->currency($result["price"])." VND" ; ?></span></p>
							<div class="button">
								<span>
									<a href="details.php?productId=<?php echo $result["productId"]?>" class="details">Details</a>
								</span>
							</div>
						</div>
		<?php
					}
				} else{
					echo "Feathread is empty";
				}
		?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			<?php
					$getProductNew = $product->getProductNew();
					if ($getProductNew){
						while ($result = $getProductNew->fetch_assoc()){
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?productId=<?php echo $result["productId"]?>">
						<img style="object-fit: cover; width:230px; height:230px;" src="./shop/admin/uploads/<?php echo $result["image"];?>" alt="" />
					</a>
					<h2><?php echo $result["productName"]; ?></h2>
					<p><span class="price"><?php echo $format->currency($result["price"])." VND" ; ?></span></p>
					<div class="button">
						<span>
							<a href="details.php?productId=<?php echo $result["productId"]?>" class="details">Details</a>
						</span>
					</div>
				</div>
			<?php
						}
					} else{
						echo "Feathread is empty";
					}
			?>
		</div>
		<div class="">
			<?php
				$productAll = $product->getAllProduct();
				$productCount = mysqli_num_rows($productAll);
				$productButton = $productCount/4;
				$productButton = ceil($productButton);
				echo "Page:";
				for ($i=1; $i <= $productButton ; $i++) { 
					echo "<a style='margin: 0 5px;' href='index.php?page=$i'>$i</a>";
				}
			?>		
		</div>
    </div>
	
 </div>
 <?php
	include_once './inc/footer.php';
 ?>