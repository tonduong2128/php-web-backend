<?php
	include_once './inc/header.php';
	// include './inc/slider.php';
?>
<style>
	.btn-submit{
		border-radius: 8px;
		padding: 6px 10px;
		font-size: 16px;
		background: #fff;
		border: 1px solid;
	}
	.btn-submit:hover{
		background: #ccc;
    	cursor: pointer;
	}
</style>
<?php
	$login_check = Session::get('customer_login');
	if ($login_check){
		echo "<script> window.location = 'order.php' </script>";
	}					
?>
<?php
	if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["submit"]))
	{
		$insertCustomer = $customer->insertCustomer($_POST);
	}

?>
<?php
	if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["login"]))
	{
		$loginCustomer = $customer->loginCustomer($_POST);
	}
		
?>
 <div class="main">
	 <?php
	 	if (isset($insertCustomer)){
			 echo $insertCustomer;
		}
		if (isset($loginCustomer)){
			echo $loginCustomer;
	   }
	 ?>
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post">
				<input name="email" type="text"  class="field" placeholder="Enter email" require>
				<input name="password" type="password"  class="field" placeholder="Enter password" require >
				<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
					<div class="buttons">
						<div>
							<input name="login" type="submit" class="btn-submit" value="Sign in" >
						</div>
					</div>
				</div>
            </form>
			<?php
			
			?>

			<div class="register_account">
				<h3>Register New Account</h3>
				<form action="" method="POST">
					<table>
						<tbody>
						<tr>
							<td>
								<div>
								<input name="name" type="text"  placeholder="Name" require>
								</div>
								
								<div>
								<input name="city" type="text"   placeholder="City" require>
								</div>
								
								<div>
									<input name="zipcode" type="text"  placeholder="Zip-code" require>
								</div>
								<div>
									<input name="email" type="text"  placeholder="E-mail" require>
								</div>
							</td>
							<td>	
								<div>
									<input name="address" type="text"  placeholder="Address" require>
								</div>
								<div>
									<select id="country" name="country" class="frm-field required">
										<option selected hidden >Select a Country</option>         
										<option value="AF">Afghanistan</option>
										<option value="AL">Albania</option>
										<option value="DZ">Algeria</option>
										<option value="AR">Argentina</option>
										<option value="AM">Armenia</option>
										<option value="AW">Aruba</option>
										<option value="AU">Australia</option>
										<option value="AT">Austria</option>
										<option value="AZ">Azerbaijan</option>
										<option value="BS">Bahamas</option>
										<option value="BH">Bahrain</option>
										<option value="BD">Bangladesh</option>
									</select>
								</div>		        
								<div>
									<input name="phone" type="text" placeholder="Phone" require>
								</div>
								<div>
									<input name="password" type="text"  placeholder="Password" require>
								</div>
							</td>
						</tr> 
						</tbody>
					</table> 
					<div class="search">
						<div>
							<input name="submit" type="submit" class="btn-submit" value="Create Account" >
						</div>
					</div>
					<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
					<div class="clear"></div>
				</form>
			</div>  	
       <div class="clear"></div>
    </div>
 </div>
  
 <?php
	include_once './inc/footer.php';
 ?>