<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filePath = realpath(dirname(__FILE__));
	include_once $filePath.'/../../classes/cart.php';
?>
<?php
	if (!isset($_GET['shiftId']) || $_GET['shiftId'] == NULL){
    } else {
        $cart = new Cart();
        $shiftId = $_GET["shiftId"];
        $time = $_GET["time"];
        $price = $_GET["price"];
        $shifted = $cart->shifted($shiftId, $time, $price);
	}	
	if (!isset($_GET['delId']) || $_GET['delId'] == NULL){
    } else {
        $cart = new Cart();
        $delId = $_GET["delId"];
        $time = $_GET["time"];
        $price = $_GET["price"];
        $delShifted = $cart->delShifted($delId, $time, $price);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<div class="block">   
		<?php
			if (isset($shifted)){
				echo $shifted;
			}
			if (isset($delShifted)){
				echo $delShifted;
			}
		?>     
		<table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Order time</th>
					<th>Product</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$cart = new Cart();
					$getInboxCart = $cart->getInboxCart();
					if ($getInboxCart){
						$index = 0;
						while ($result= $getInboxCart->fetch_assoc()){
				?>
					<tr class="odd gradeX">
						<td><?php echo ++$index?></td>
						<td><?php echo $result['date'];?></td>
						<td><?php echo $result['productName'];?></td>
						<td><?php echo $result['quantity'];?></td>
						<td><?php echo $result['price'];?></td>
						<td><a href="customer.php?customerId=<?php echo $result['customerId'];?>">View customer</a></td>
						<td>
							<?php
								if ($result['status']==0)
								{
							?>
								<a href="?shiftId=<?php echo $result["id"];?>&price=<?php echo $result["price"];?>&
								time=<?php echo $result['date'];?>">Pending</a>
							<?php
								} else if($result['status']==1){
							?>
								Shifting...
							<?php
								} else{
							?>
								<a href="?delId=<?php echo $result["id"];?>&price=<?php echo $result["price"];?>&
								time=<?php echo $result['date'];?>">Romove</a>
							<?php		
								}
							?>
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
