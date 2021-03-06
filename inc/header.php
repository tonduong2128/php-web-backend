<?php
 	include_once './lib/session.php';
	Session::init();
	include_once './lib/database.php';
	include_once './helpers/format.php';
?>
<?php
	spl_autoload_register(function($className){
		include_once "./classes/".$className.".php";
	});
	$database = new Database();
	$cart = new Cart();
	$format = new Format();
	$user = new User();
	$product = new Product();
	$category = new Category();
	$brand = new Brand();
	$customer = new Customer();
?>
<?php
  	header("Cache-Control: no-cache, must-revalidate");
  	header("Pragma: no-cache"); 
  	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  	header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="shop/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="shop/css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="shop/js/jquerymain.js"></script>
<script src="shop/js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="shop/js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="shop/js/nav.js"></script>
<script type="text/javascript" src="shop/js/move-top.js"></script>
<script type="text/javascript" src="shop/js/easing.js"></script> 
<script type="text/javascript" src="shop/js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="shop/images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="post">
				    	<input type="text" name="search" placeholder="Search for product..."><input type="submit" name="searchProduct" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php
										echo (string)(Session::get("sum")*1.1)." VND";
									?>
								</span>
							</a>
						</div>
			      </div>
		   <div class="login">
				<?php
					if (isset($_GET['action']) && $_GET['action']=='logout'){
						Session::destroy();
					}
					if (isset($_GET['customerId'])){
						$delCart = $cart->delAllCart();
						$delCompare = $product->delAllCompare($_GET['customerId']);
						Session::destroy();
					}
				?>
				<?php
					$login_check = Session::get('customer_login');
					if ($login_check){
						echo "<a href='?customerId=".Session::get("customer_id")."'>Logout</a>";
					} else{
						echo "<a href='login.php'>Login</a>";
					}
				?>
			</div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <li><a href="cart.php">Cart</a></li>
	  <?php
	  	$login_check = Session::get('customer_login');
	 	if ($login_check){
		?>
			<li><a href="profile.php">Profile</a> </li>
			<li><a href="compare.php">Compare</a> </li>
			<li><a href="wishlist.php">Wishlist</a> </li>
		<?php		 
		 } 
	  ?>
	   	<?php
			$customerId = Session::get("customer_id");
			$order_check = $cart->orderCheck($customerId);
	 	if ($order_check){
		?>
			<li><a href="orderDetail.php">Ordered</a> </li>
		<?php		 
		 } 
	  	?>
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>