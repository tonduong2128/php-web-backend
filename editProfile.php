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
<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["submit"]){
        $updateCustomer = $customer->updateCustomer($_POST);
        if ($updateCustomer){
            header("Location: profile.php");
        }
    }
?>
<style>
    .tblone input:not([type="submit"]){
        width: 100%;
        height:30px;
        font-size:16px;
        outline:none;
        border:1px solid rgba(0,0,0,0.1);
        border-radius:4px;
    }
</style>
 <div class="main">
    <div class="content">   
    	<div class="section group">
            <div class="content_bottom">
                <div class="heading">
                    <h3>Profile customer</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tblone">
                    <?php
                        $id = Session::get("customer_id");
                        $getCustomer = $customer->showCustomer($id);
                        if ($result = $getCustomer->fetch_assoc()){
                    ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>
                                <input name="name" value="<?php echo $result["name"];?>" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>
                                <input name="address" value="<?php echo $result["address"];?>" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td>
                                <input name="city" value="<?php echo $result["city"];?>" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td>
                                <input name="country" value="<?php echo $result["country"];?>" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td>
                                <input name="zipcode" value="<?php echo $result["zipcode"];?>" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>
                                <input name="phone" value="<?php echo $result["phone"];?>" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <input name="email" value="<?php echo $result["email"];?>" type="text">
                            </td>
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
                        font-size:20px;
                        background-color:rgba(0,0,0,0.1);
                        cursor: pointer;
                    }
                    .btn-profile:hover{
                        background-color:rgba(0,0,0,0.2);
                    }
                </style>
                <div style="float:right">
                    <div >
                        <input
                            name="submit"
                            type="submit"
                            class="btn-profile"
                            value="Save"
                        />
                    </div>
                </div>
            </form>
 		</div>

 	</div>
</div>
  
<?php
	include_once './inc/footer.php';
?>