	<?php $this->layout('frontend::template', ['title' => 'Throwback Authentics - Home', 'data' => $data]) ?>
	<div id="main">
		<!-- wrapper-main -->
		<div class="wrapper">
			<!-- content -->
			<div class="content">
				
				<!-- title -->
				<div id="page-title">
					<span class="title">Onze productcategorieën</span>
					<span class="subtitle"></span>
				</div>
				<!-- ENDS title -->
				
				<!-- Portfolio -->
				<div id="projects-list">
					<?php foreach($data['categories'] as $cat): ?>
					<div class="catHolder">
						<div class="catDivide">
							<table width="100%" class="noborder">
							<tr onclick="document.location = 'products.php?catid=<?=$cat['id'];?>';" class="link">
								<td style="vertical-align:top; width:100px;" class="noborder">
									<a href="products.php?catid=<?=$cat['id'];?>"><img class="catImage" src="fotos/categories/icon100/<?=$cat['picture'];?>"  alt="Categorie <?=$cat['name'];?>" /></a>
								</td>
								<td style="vertical-align:top;" class="noborder">
									<h2><?=$cat['name'];?></h2>
									<h5><?=$cat['subheader'];?></h5>
									<!--<br>
									<p><?=$cat['description'];?></p>-->
								</td>
							</tr>
							</table>
							<a class="cat-button" href="products.php?catid=<?=$cat['id'];?>">
								<span>Ga naar <?=$cat['name'];?></span>
							</a>
						</div>
					</div>
					<?php endforeach ?>
				</div>
				<!-- ENDS Portfolio -->
				
			</div>
			<!-- ENDS content -->

		</div>
		<!-- ENDS wrapper-main -->
	</div>
