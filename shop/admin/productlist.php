<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../classes/Product.php'?>
<?php include '../../classes/Category.php'?>
<?php include '../../classes/Brand.php'?>
<?php include_once '../../helpers/format.php'?>
<?php
	$format = new Format();
	$product = new Product();

	if (isset($_GET["productDelId"]) && $_GET["productDelId"]!=null){
		$idDel = $_GET["productDelId"];
		$resultDel = $product->deleteProductById($idDel);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<?php
				if (isset($resultDel)){
					echo $resultDel;
				}
			?>
			<thead>
				<tr>
					<th>ID</th>
					<th>Product name</th>
					<th>Product price</th>
					<th>Product image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$result = $product->showProduct();
					if ($result){
						$i=0;
						while ($data = $result->fetch_assoc())
						{
							$i++;
				?>		
					<tr class="odd gradeX">	
						<td><?php echo $i; ?></td>
						<td><?php echo $data["productName"] ?></td>
						<td><?php echo $data["price"] ?></td>
						<td ><img height="80" style="display: inline-block; vertical-align:middle; padding:10px 0;" src= "uploads/<?php echo $data["image"]?>"/></td>
						<td>
							<?php 
								$cat = new Category();
								$result2 = $cat->getCategoryById($data["catId"]);
								if ($result){
									$data2 = $result2->fetch_assoc();
									echo $data2["catName"];
								}
							?>
						</td>
						<td>
							<?php 
								$brand = new Brand();
								$result2 = $brand->getBrandById($data["brandId"]);
								if ($result){
									$data2 = $result2->fetch_assoc();
									echo $data2["brandName"];
								}
							?>
						</td>
						<td><?php echo $format->textShorten($data["product_desc"],50);?></td>
						<td class="center"> 
							<?php
								if ($data["type"]=="1") {
									echo 'Feathered';
								} else{
									echo 'Non-Feathered';
								}
							?>
						</td>
						<td>
							<a href="productEdit.php?productId=<?php echo $data["productId"]; ?>">Edit</a> 
							|| <a 
									href="?productDelId=<?php echo $data["productId"]?>" 
									onclick=" return confirm('You must be delete')">Delete
								</a>
						</td>
					</tr>
				<?php		
						}
					}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
