<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getLasted = $product->getLastedDell();
					if ($getLasted){
						while($result=$getLasted->fetch_assoc()){

				?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productId=<?php echo$result["productId"];?>"> 
								<img src="shop/admin/uploads/<?php echo $result['image'];?>" alt="" style="object-fit: cover;" />
							</a>
						</div>
						<div class="text list_2_of_1">
							<h2>Dell</h2>
							<p><?php echo $format->textShorten($result['product_desc'],50);?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo$result["productId"];?>">Add to cart</a></span></div>
					   </div>
				   	</div>			
				<?php
						}
					}
				?>
				<?php
					$getLasted = $product->getLastedSamsung();
					if ($getLasted){
						while($result=$getLasted->fetch_assoc()){

				?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productId=<?php echo$result["productId"];?>"> 
								<img src="shop/admin/uploads/<?php echo $result['image'];?>" alt="" style="object-fit: cover;"/>
							</a>
						</div>
						<div class="text list_2_of_1">
							<h2>Sam Sung</h2>
							<p><?php echo $format->textShorten($result['product_desc'],50);?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo$result["productId"];?>">Add to cart</a></span></div>
					   </div>
				   	</div>			
				<?php
						}
					}
				?>
			</div>
			<div class="section group">
				<?php
					$getLasted = $product->getLastedApple();
					if ($getLasted){
						while($result=$getLasted->fetch_assoc()){

				?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productId=<?php echo$result["productId"];?>"> 
								<img src="shop/admin/uploads/<?php echo $result['image'];?>" alt="" style="object-fit: cover;"/>
							</a>
						</div>
						<div class="text list_2_of_1">
							<h2>Apple</h2>
							<p><?php echo $format->textShorten($result['product_desc'],50);?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo$result["productId"];?>">Add to cart</a></span></div>
					   </div>
				   	</div>			
				<?php
						}
					}
				?>		
				<?php
					$getLasted = $product->getLastedOppo();
					if ($getLasted){
						while($result=$getLasted->fetch_assoc()){

				?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productId=<?php echo$result["productId"];?>">
							 	<img src="shop/admin/uploads/<?php echo $result['image'];?>" alt="" style="object-fit: cover;"/>
							</a>
						</div>
						<div class="text list_2_of_1">
							<h2>Oppo</h2>
							<p><?php echo $format->textShorten($result['product_desc'],50);?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo$result["productId"];?>">Add to cart</a></span></div>
					   </div>
				   	</div>			
				<?php
						}
					}
				?>
			</div>
		  <div class="clear"></div>
		</div>
		<div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
							$showSlider = $product->showSlider();
							if ($showSlider){
								while ($result = $showSlider->fetch_assoc()){
						?>
							<li>
								<img src="shop/admin/uploads/<?php echo $result["image"];?>" 
								alt="" style="max-height:310px; max-width:540; object-fit:cover;"/>
							</li>
						<?php
									
								}
							} 
						?>
				    </ul>
				  </div>
			</section>
			<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	