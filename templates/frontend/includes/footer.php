			<!-- FOOTER -->
			<div id="footer">
				<!-- wrapper-footer -->
				<div class="wrapper">
					<!-- footer-cols -->
					<ul id="footer-cols">
						<li class="col">
							<h6>Paginas</h6>
							<ul>
								<li class="page_item"><a href="../home">Producten</a></li>
								<li class="page_item"><a href="../info">Het onstaan van Throwback Authentics</a></li>
								<li class="page_item"><a href="../voorwaarden">Info en voorwaarden</a></li>
								<li class="page_item"><a href="../contact">Contact</a></li>
								<li class="page_item"><a href="../sitemap">Sitemap</a></li>
							</ul>
						</li>
						
						<li class="col">
							<h6>Producten</h6>
							<ul>
							<?php foreach($categories as $cat): ?>
								<li><a href="/<?=$cat['seoname']?>"><?=$cat['name']?></a></li>
							<?php endforeach ?>
							</ul>
						</li>
						<li class="col">
							<h6><?=$text['footerTitle']?></h6>
							<p class="dropcap"><?=$text['footerText']?></p>
						</li>
					</ul>
					<!-- ENDS footer-cols -->
				</div>
				<!-- ENDS wrapper-footer -->
			</div>
			<!-- ENDS FOOTER -->
			<!-- GOOGLE ANALYTICS TRACKING CODE -->
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-58178707-1', 'auto');
			  ga('send', 'pageview');

			</script>
			<!-- ENDS GOOGLE ANALYTICS TRACKING CODE -->
