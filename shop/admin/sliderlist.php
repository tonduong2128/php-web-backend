<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../../classes/Product.php'?>
<?php
	$product = new Product();
?>

<?php
	if (isset($_GET["delId"]) && $_GET["delId"] != NULL){
		$sliderId = $_GET["delId"];
		$image = $_GET["image"];
		$deleteSliderById = $product->deleteSliderById($sliderId, $image);
	}
	if (isset($_GET["id"]) && isset($_GET["type"])){
		$sliderId = $_GET["id"];
		$type = $_GET["type"];
		$updateTypeSlider = $product->updateTypeSlider($sliderId, $type);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>.No</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Type</th>
					<th width="20%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if (isset($deleteSliderById)){
						echo $deleteSliderById;
					}
					if (isset($updateTypeSlider)){
						echo $updateTypeSlider;
					}
				?>
				<?php
					$showSlider = $product->showSliderAdmin();
					$id = 0;
					if ($showSlider){
						while ($result = $showSlider->fetch_assoc()){
				?>
					<tr class="odd gradeX">
						<td><?php echo $id;?></td>
						<td><?php echo $result["sliderName"];?></td>
						<td><img src="./uploads/<?php echo $result["image"];?>" height="40px" width="60px"/></td>				
						<td>
							<?php 
								if ($result["type"]==1){
									$idSlider = $result["id"]; 
									echo "<a href='?id=$idSlider&type=0'>Off</a>";
								} else{
									$idSlider = $result["id"]; 
									echo "<a href='?id=$idSlider&type=1'>On</a>";
								}
							?>
						</td>
						<td>
							<a onclick="return confirm('Are you sure to Delete!');"  
								href="?delId=<?php echo $result["id"];?>&image=<?php echo $result["image"];?>"
							>Delete</a> 
						</td>
					</tr>	
				<?php
						$id++;
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
