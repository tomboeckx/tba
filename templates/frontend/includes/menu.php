			<!-- Menu -->
			<div id="menu">
				<!-- ENDS menu-holder -->
				<div id="menu-holder">
					<!-- wrapper-menu -->
					<div class="wrapper">
						<!-- Navigation -->
						<ul id="nav" class="sf-menu">
							<li id="navHome"><a href="../home">Home<span class="subheader"></span></a></li>
							<li id="navInfo"><a href="../info"><?=$text['page1title']?><span class="subheader"><?=$text['page1subheader']?></span></a></li>
							<?php foreach($categories as $cat): ?>
								<li id="navCat<?=$cat['id']?>"><a href="/<?=$cat['seoname']?>"><?=$cat['name']?><span class="subheader"><?=$cat['subheader']?></span></a></li>
							<?php endforeach ?>
							<li id="navConditions"><a href="../voorwaarden"><?=$text['page2title']?><span class="subheader"><?=$text['page2subheader']?></span></a></li>
							<li id="navContact"><a href="../contact">Contact<span class="subheader">Onze gegevens</span></a></li>
						</ul>
						<!-- Navigation -->
					</div>
					<!-- wrapper-menu -->
				</div>
				<!-- ENDS menu-holder -->
				<img src="../images/Logo.png" class="throwbackLogo" alt="Throwback Authentics Logo">
			</div>
			<!-- ENDS Menu -->
