<?php
	include_once './inc/header.php';
	// include './inc/slider.php';
?>
<?php 
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$search = $_POST["search"];
        $searchProduct = $product->searchProdct($search);
?>		
	<div class="main">
		<div class="content">
			<div class="content_top">
				<div class="heading">
					<h3>Keys searh: <?php echo $search;?></h3>
				</div>
				<div class="clear"></div>
			</div>
			<div class="section group">
				<?php
					if ($searchProduct){
						while ($result = $searchProduct->fetch_assoc()){
				?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview-3.php">
							<img src="shop/admin/uploads/<?php echo $result["image"];?>" alt="" style="width:200px; height: 200px; object-fit: cover;" />
						</a>
						<h2><?php echo $result["productName"];?></h2>
						<p><?php echo $format->textShorten($result["product_desc"],150);?></p>
						<p><span class="price"><?php echo $result["price"];?></span></p>
						<div class="button">
							<span>
								<a href="details.php?productId=<?php echo $result["productId"]?>" class="details">Details</a>
							</span>
						</div>
					</div>
				<?php
						}
					} else{
				?>
					<h2>Not found</h2>
				<?php
					}
				?>
				
			</div>
		</div>
	</div>
<?php
	} else {
		echo "<script>location='404.php'</script>";
	}
?>

 <?php
	include_once './inc/footer.php';
 ?>