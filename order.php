<?php
   include_once './inc/header.php';
   include_once './inc/slider.php';
?>
<?php
	$login_check = Session::get('customer_login');
	if (!$login_check){
		echo "<script> window.location = 'login.php' </script>";
	}					
?>
<div class="main">
   <div class="content">
      <div class="cartoption">		
         <div class="cartpage">
            <div class="not_found" >
               <h1 style="front-size:40px;"> Order php</h1>
            </div>
         <div>
      </div>  	
      <div class="clear"></div>
   </div>
</div>
<?php
   include_once './inc/footer.php';
?>