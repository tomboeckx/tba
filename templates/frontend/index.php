	<?php $this->layout('frontend::template', ['title' => 'Throwback Authentics - Home', 'data' => $data]) ?>
	<div id="main">
		<!-- wrapper-main -->
		<div class="wrapper">
			<!-- content -->
			<div id="content" style="margin-bottom:0px;">
				<div class="plain-text">
					<?=$data['infoText']?>
				</div>
				<?php if(count($data['products'])<> 0):?>
				<br>
				<div class="panes">
					<!-- Posts -->
					<div style="display: block;">
						<ul class="blocks-thumbs thumbs-rollover">
						<?php foreach($data['products'] as $product): ?>
							<li>
								<a title="<?=$this->e($product['name'])?>" class="thumb productdetails nobg" href="product.php?prodid=<?=$this->e($product['id'])?>">
									<img src="/fotos/products/product/<?=$this->e($product['image']['image'])?>" style="opacity: 1;" alt="<?=$this->e($product['name'])?>">
								</a>
								<div class="excerpt">
									<a class="header productdetails" href="product.php?prodid=<?=$this->e($product['id'])?>"><?=$this->e($product['name'])?></a>
								</div>
								<a class="link-button productdetails" href="product.php?prodid=<?=$this->e($product['id'])?>"><span>Details →</span></a>
							</li>
						<?php endforeach ?>
						</ul>
					</div>
					<!-- ENDS posts -->
				</div>
			</div>
			<?php endif ?>
			<!-- ENDS content -->
		</div>
		<!-- ENDS wrapper-main -->
	</div>
	<script type="text/javascript">
	$(function() {
		$( "#navHome" ).addClass( "current-menu-item" );
	});
	</script>
