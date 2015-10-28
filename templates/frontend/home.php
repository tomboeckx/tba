	<?php $this->layout('frontend::template', ['title' => 'original vintage, antique en industrial design lampen meubels stoelen en decoratie online kopen | Throwback Authentics webshop ', 'data' => $data]) ?>
	<div id="main">
		<div id="slider-block">
			<div id="slider-holder" style="background: none;height: auto;margin-top:70px;">
				<ul class="frontNav">
					<li class="tbaPicture"><img alt="" src="http://www.throwback-authentics.be/fotos/uploads/1421271689_THROWBACK%20Authentics%20Logo%2005%20Photo%20B.jpg" class="tbaImage" /></li>
					<li><a href="/meubilair"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_meubilair_8996479408.jpg" /></a><p class="frontNavText">Meubiliair</p></li>
					<li><a href="/stoelen"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_stoel_7713897107.jpg" /></a><p class="frontNavText">Stoel en kruk</p></li>
					<li><a href="/diversen"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_diversen_7662759600.jpg" /></a><p class="frontNavText">Diversen</p></li>
					<li><a href="/decoratie"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_deco_5593505306.jpg" /></a><p class="frontNavText">Decoratie</p></li>
					<li><a href="/verkocht"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_sold_2438583322.png" /></a><p class="frontNavText">Verkocht</p></li>
					<li><a href="/lampen"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_lampen_8263766444.jpg" /></a><p class="frontNavText">Lampen</p></li>
					<li><a href="/meubilair"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_meubilair_8996479408.jpg" /></a><p class="frontNavText">Meubiliair</p></li>
					<li><a href="/stoelen"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_stoel_7713897107.jpg" /></a><p class="frontNavText">Stoel en kruk</p></li>
					<li><a href="/diversen"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_diversen_7662759600.jpg" /></a><p class="frontNavText">Diversen</p></li>
					<li><a href="/decoratie"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_deco_5593505306.jpg" /></a><p class="frontNavText">Decoratie</p></li>
					<li><a href="/verkocht"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_sold_2438583322.png" /></a><p class="frontNavText">Verkocht</p></li>
					<li><a href="/lampen"><img class="catlinkImage" alt="" src="http://dev.throwback-authentics.be/fotos/categories/icon100/cat_lampen_8263766444.jpg" /></a><p class="frontNavText">Lampen</p></li>
				</ul> 
				<div class="clear "></div>

				<p>&nbsp;</p>

				<p style="text-align:center"><?=$data['infoText']?></p>

				<p>&nbsp;</p>
				<p>&nbsp;</p>

				<p>&nbsp;</p>
			</div>
		</div>
		<br />
		<!-- wrapper-main -->
		<div class="wrapper">
			<!-- content -->
			<div id="content" style="margin-bottom:0px;">
				<div >
						<h1 class="title" style="text-align:center;">Producten in de kijker - aanbiedingen</h1>
				</div>
				<?php if(count($data['products'])<> 0):?>
				<br>
				<div class="panes">
					<!-- Posts -->
					<div style="display: block;">
						<ul class="blocks-thumbs thumbs-rollover">
						<?php foreach($data['products'] as $product): ?>
							<li>
								<a title="<?=$this->e($product['name'])?>" class="thumb productdetails nobg" href="/<?=$product['catseoname']?>/<?=$product['seoname'];?>">
									<img src="/fotos/products/offer/<?=$this->e($product['image'])?>" style="opacity: 1;" alt="<?=$this->e($product['name'])?>">
								</a>
								<div class="excerpt">
									<a class="header productdetails" href="/<?=$product['catseoname']?>/<?=$product['seoname'];?>"><?=$this->e($product['name'])?></a>
									<p><b>Periode: </b><?=$this->e($product['periode'])?><br><b>Fabrikant / designer: </b><?=$this->e($product['fabrikant'])?></p>
								</div>
								<a class="link-button productdetails" href="/<?=$product['catseoname']?>/<?=$product['seoname'];?>"><span>Details →</span></a>
							</li>
						<?php endforeach ?>
						</ul>
					</div>
					<!-- ENDS posts -->
				</div>
				<?php endif ?>
			</div>
			<!-- ENDS content -->
		</div>
		<!-- ENDS wrapper-main -->
	</div>
	<script type="text/javascript">
	$(function() {
		$( "#navHome" ).addClass( "current-menu-item" );
	});
	</script>
