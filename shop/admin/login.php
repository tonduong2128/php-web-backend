<?php
	include "../../classes/AdminLogin.php";
?>
<?php
	$ClassAdminLogin = new AdminLogin();
	if ($_SERVER["REQUEST_METHOD"]==="POST"){
		$adminUser = $_POST["adminUser"];
		$adminPass = $_POST["adminPass"];
		$login_check = $ClassAdminLogin->loginAdmin($adminUser, $adminPass);
	}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post"> <!--Gửi đến chính mình-->
			<h1>Admin Login</h1>
			<?php
				if (isset($login_check)){
					echo $login_check;
				}
			?>
			<div>
				<input type="text" placeholder="Username" required="" name="adminUser" />
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="adminPass" />
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>