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
<style>
    .chose-method{
        padding-top:30px;
        font-size:30px;
    }
    .group-link{
        display:flex;
        flex-direction:column;
    }
    .group-link a{
        text-align:center;
        padding: 10px 20px;  
        font-size:20px;      
    }
    .group-link a:hover{
        color:red;
    }
    .button{
        border:1px solid #ccc;
        padding:8px 10px; 
        border-radius:10px; 
        font-weight:600; 
        background-color:rgba(0,0,0,0.1);
        cursor: pointer;
    }
    .button:hover{
        background-color:rgba(0,0,0,0.2);
    }
</style>
 <div class="main">
    <div class="content">   
    	<div class="section group" >
            <div class="content_bottom" >
                <div class="heading">
                    <h3>Payment method</h3>
                </div>
                <h1 class="chose-method">Choose the method payment</h1>
                <div class="group-link">
                    <a href="offlinePayment.php">Offline payment</a>
                    <a href="onlinePayment.php">Online payment</a>
                </div>
                <button
                    class="button"
                    onclick="window.history.back();"
                ><< Preview</button>
                <div class="clear"></div>
            </div>
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
                .contaner-btn{
                   
                }
            </style>
            <div class="contaner-btn"style="text-align:right; margin:16px;">
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