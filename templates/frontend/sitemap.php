	<?php $this->layout('frontend::template', ['title' => 'Sitemap | Throwback Authentics', 'data' => $data]) ?>
	<div id="main">
		<!-- wrapper-main -->
		<div class="wrapper">
			<!-- content -->
			<div id="content">
				<div id="page-title">
					<div style="height:105px;">
						<span class="title">Sitemap</span>
					</div>
				</div>

				<div class="lists-arrow">
				<ul>
					<li><h2><a href="../home">Home<span class="subheader"></span></a><h2></li>
					<li><h2><a href="../info"><?=$text['page1title']?><span class="subheader"> - <?=$text['page1subheader']?></span></a></h2></li>
					<?php foreach($data["categories"] as $cat): ?>
						<li><h2><a href="/<?=$cat['seoname']?>"><?=$cat['name']?><span class="subheader">  <?=$cat['subheader']?></span></a></h2></li>
						<?php foreach($data["products"] as $prod): ?>
							<?php if ($cat['id'] == $prod['category']): ?>
								<li><a href="/<?=$cat['seoname']?>/<?=$prod['seoname']?>"><?=$prod['name']?></a></li>
							<?php endif ?>
						<?php endforeach ?>
					<?php endforeach ?>
					<li><h2><a href="../voorwaarden"><?=$text['page2title']?><span class="subheader">  <?=$text['page2subheader']?></span></a></h2></li>
					<li><h2><a href="../contact">Contact</a></h2></li>
				</ul>
				</div>

			</div>
			<!-- ENDS content -->
		</div>
		<!-- ENDS wrapper-main -->
	</div>
	<script type="text/javascript">
	$(function() {
		$( "#navInfo" ).addClass( "current-menu-item" );
	});
	</script>
