<?php
	include_once './inc/header.php';
	// include './inc/slider.php';
?>
<?php
    $login_check = Session::get('customer_login');
    if ($login_check){	 
    } else{
        header("Location:login.php");
    } 
?>
 <div class="main">
    <div class="content">   
    	<div class="section group">
            <div class="content_bottom">
                <div class="heading">
                    <h3>Profile customer</h3>
                </div>
                <div class="clear"></div>
            </div>
            <table class="tblone" >
                <?php
                    $id = Session::get("customer_id");
                    $getCustomer = $customer->showCustomer($id);
                    if ($result = $getCustomer->fetch_assoc()){
                ?>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><?php echo $result["name"];?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><?php echo $result["address"];?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><?php echo $result["city"];?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><?php echo $result["country"];?></td>
                    </tr>
                    <tr>
                        <td>Zipcode</td>
                        <td>:</td>
                        <td><?php echo $result["zipcode"];?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><?php echo $result["phone"];?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $result["email"];?></td>
                    </tr>
                </tr>
                <?php        
                    }
                    ?>
            </table>
            <style>
                .btn-profile{
                    border:1px solid #ccc;
                    padding:8px 10px; 
                    border-radius:10px; 
                    font-weight:600; 
                    background-color:rgba(0,0,0,0.1);
                }
                .btn-profile:hover{
                    background-color:rgba(0,0,0,0.2);
                }
            </style>
            <div style="text-align:right">
                <div >
                    <a
                        class="btn-profile"
                        href="editProfile.php"
                    >Update Profile</a>
                </div>
            </div>
 		</div>

 	</div>
</div>
  
<?php
	include_once './inc/footer.php';
?>