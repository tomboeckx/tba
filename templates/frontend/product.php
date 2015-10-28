	<?php $this->layout('frontend::template', ['title' => $data['product']['name'].' | voordelig '.$data['category']['name'].' online kopen | Throwback Authentics webshop', 'data' => $data]) ?>
		<link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/css/styled-elements.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/css/product-details.css" type="text/css" media="screen" />
		<script type="text/javascript" src="http://<?=$_SERVER['HTTP_HOST']?>/js/jssor/jssor.js"></script>
		<script type="text/javascript" src="http://<?=$_SERVER['HTTP_HOST']?>/js/jssor/jssor.slider.js"></script>
		<script type="text/javascript" src="http://<?=$_SERVER['HTTP_HOST']?>/js/tba/product-details.js"></script>

			<div id="main">
				<!-- wrapper-main -->
				<div class="wrapper">
					<!-- content -->
					<input type="hidden" id="prodID" value="<?php echo $prodid;?>">
					<div id="content">	
						
						
						
						<div id="page_content">
							<!-- 2 cols -->
							<div class="one-half">
								<h6 class="line-divider"><?=$data['product']['name']?></h6>
								<div id="productimages" style="width:438px;height:438px;display:inline-block; ">
									<div id="slider2_container" style="position: relative; width: 438px; height: 438px;margin-left:auto;margin-right:auto;">

										<!-- Loading Screen -->
										<div u="loading" style="position: absolute; top: 0px; left: 0px;">
											<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
												background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
											</div>
											<div style="position: absolute; display: block; background: url(http://<?=$_SERVER['HTTP_HOST']?>/js/jssor/img/loading.gif) no-repeat center center;
												top: 0px; left: 0px;width: 100%;height:100%;">
											</div>
										</div>

										<!-- Slides Container -->
										<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 438px; height: 438px; overflow: hidden;">
											<?php foreach($data['product']['images'] as $image): ?>
												<div>
													<img src='http://<?=$_SERVER['HTTP_HOST']?>/fotos/products/product/<?=$image['image']?>' alt='Foto <?=$data['product']['name']?>' />
												</div>
											<?php endforeach ?>
										</div>
										<!-- bullet navigator container -->
										<div u="navigator" class="jssorb01" style="position: absolute; bottom: 16px; right: 10px;">
											<!-- bullet navigator item prototype -->
											<div u="prototype" style="POSITION: absolute; WIDTH: 12px; HEIGHT: 12px;"></div>
										</div>
										<!-- Bullet Navigator Skin End -->
									
										<!-- Arrow Left -->
										<span u="arrowleft" class="jssora13l" style="width: 40px; height: 50px; top: 150px; left: 0px;">
										</span>
										<!-- Arrow Right -->
										<span u="arrowright" class="jssora13r" style="width: 40px; height: 50px; top: 150px; right: 0px">
										</span>
									</div>
								</div>
								<br />
								<br />
								<?php if($data['category']['sold']==1):?>
									<h2 style='color:red;'>Verkocht</h2>
								<?php elseif($data['product']['reserved']==1):?>
									<h2 style='color:red;'>Product is gereserveerd</h2>
								<?php else:?>
								<div>
								<span class="productbuttonHolder">
									<a id="reservelink" class="link-button productbutton" href="../product_reservation.php?prodid=<?=$data['product']['id']?>"><span>Reserveer product</span></a>
									&nbsp;<a id="infolink" class="link-button productbutton" href="../product_information.php?prodid=<?=$data['product']['id']?>"><span>Vraag informatie</span></a>
									<!--&nbsp;<a id="buynowlink" class="link-button productbutton" href="../product_reservation.php?prodid=<?=$data['product']['id']?>"><span>Nu kopen !</span></a>
								-->
								</span>
								</div>
								<?php endif; ?>

							</div>
							<div class="one-half last">
								<h6 class="line-divider">Productinformatie:</h6>
								<div id="productdescription" style="margin-left:5px;;width:438px;display:inline-block; ">
									<div style='margin:6px;color: #51565b;'>
										<p>
											Productcategorie:<br><b><?=$data['category']['name']?></b><br>
											Periode:<br><b><?=$data['product']['periode']?></b><br>
											Designer:<br><b><?=$data['product']['fabrikant']?></b><br>
											Prijs:<br><b><?=$data['product']['price']?> €</b><br>
											Omschrijving:<br>
											<br>
											<?=$data['product']['description']?></b>
											<br>
										</p>
									</div>
								</div>
							</div>
							<div class="clear "></div>
							<!-- ENDS 2 cols -->	
						</div>
						<br>
						<br>
						<table id="navprod">
							<tr>
								<td class="prodnav">
									<a class="link-button" href="products.php?prodid=<?=$data['prevprodid'];?>"><span>< <?=$data['prevprodname'];?> </span></a>
								</td>
								<td>
								</td>
								<td class="prodnav">
									<a class="read-more link-button"  style="float:right;" href="products.php?prodid=<?=$data['nextprodid'];?>"><span><?=$data['nextprodname'];?> ></span></a>
								</td>
							</tr>
						</table>

					</div>

					<!-- ENDS content -->

				</div>
				<!-- ENDS wrapper-main -->
			</div>
