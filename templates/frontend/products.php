	<?php $this->layout('frontend::template', ['title' => $data['category']['name'].' | Throwback Authentics', 'data' => $data]) ?>
			<div id="main">
				<!-- wrapper-main -->
				<div class="wrapper">
					<!-- content -->
					<div id="content">
						
						<!-- category info -->
						<div id="page-title">
							<div style="height:105px;">
								<span class="title"><?=$data['category']['name'];?></span><br />
							</div>
						</div>
						<!-- ENDS category info -->
						
						
						<!-- Products -->
						<div id="projects-list">
						<?php foreach($data['products'] as $product): ?>

							<!-- product -->
							<div class="project">
								<h6><a class="productdetails" href="/<?=$data['category']['seoname']?>/<?=$product['seoname'];?>"><?=$product['name'];?></a></h6>
								
								<!-- shadow -->
								<div class="project-shadow">
									<!-- product-thumb -->
									<div class="project-thumbnail">
										<!-- meta -->
										<ul class="meta">
											<li>Designer: <strong><?=$product['fabrikant'];?></strong></li>
											<li>Periode: <strong><?=$product['periode'];?></strong></li>
										</ul>
										<!-- ENDS meta -->
										<?php if (isset($product['image'])): ?>
										<a class="productdetails cover productimage" href="/<?=$data['category']['seoname']?>/<?=$product['seoname'];?>"><img style="height:329px;" src="/fotos/products/product/<?=$product['image'];?>"  alt="Foto <?=$product['name'];?>" /></a>
										<?php endif;?>
									</div>
									<!-- ENDS product-thumb -->
									<br>
									<a class="read-more link-button productdetails" href="/<?=$data['category']['seoname']?>/<?=$product['seoname'];?>">
										<span>details</span>
									</a>
								
								</div>
								<!-- ENDS shadow -->
							</div>
							<!-- ENDS product -->
						<?php endforeach ?>
						</div>
						<!-- ENDS Products -->
						<!-- Category description / seo text -->
						<?php if($data['category']['description']!=""):?>
							<div id="page-title">
								<div style="height:105px;">
								</div>
							</div>
							<div id="page-title">
								<div style="height:105px;">
									<p class="dropcap dark"><?=$data['category']['description'];?></p>
								</div>
							</div>
							<br>
							<div>
								<table style="border:0px;">
									<tr>
	<!--										<td style="border:0px;padding:0px 0px 0px 30px;vertical-align:top;"><img class="catImage" src="fotos/categories/icon100/<?=$data['category']['picture'];?>"  alt="<?=$data['category']['name'];?>" /></td>-->
										<td style="border:0px;padding:0px;"></td>
									</tr>
								</table>
							</div>
						<?php endif; ?>
						<!-- ENDS Category description / seo text -->
						<!-- prev / next category navigation -->
						<br>
						<br>
						<table id="navcat">
							<tr>
								<td class="catnav">
									<a class="link-button" href="products.php?catid=<?=$data['prevcatid'];?>"><span>< <?=$data['prevcatname'];?> </span></a>
								</td>
								<td>
								</td>
								<td class="catnav">
									<a class="read-more link-button"  style="float:right;" href="products.php?catid=<?=$data['nextcatid'];?>"><span><?=$data['nextcatname'];?> ></span></a>
								</td>
							</tr>
						</table>
						<!-- ENDS prev / next category navigation -->
					</div>
					<!-- ENDS content -->

				</div>
				<!-- ENDS wrapper-main -->
			</div>
			<script type="text/javascript">
			$(function() {
				$( "#navCat<?=$data['category']['id']?>" ).addClass( "current-menu-item" );
			});
			</script>

