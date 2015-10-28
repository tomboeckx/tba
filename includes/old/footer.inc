			<!-- FOOTER -->
			<div id="footer">
				<!-- wrapper-footer -->
				<div class="wrapper">
					<!-- footer-cols -->
					<ul id="footer-cols">
						<li class="col">
							<h6>Paginas</h6>
							<ul>
								<li class="page_item"><a href="index.php">Home</a></li>
								<li class="page_item"><a href="categories.php">Producten</a></li>
								<li class="page_item"><a href="contact.php">Contact</a></li>
							</ul>
						</li>
						
						<li class="col">
							<h6>Producten</h6>
							<ul>
								<?php
									$result = mysqli_query($cnn,"SELECT * FROM categories");

									while($row = mysqli_fetch_array($result)) { ?>
										<li><a href="products.php?catid=<?php echo $row['id']?>"><?php echo $row['name']?></a></li>
								<?	}
								?>
							</ul>
						</li>
						<li class="col">
							<h6>
							<?php 
							$resultfooter = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='footerheader'");
							$rowfooter = mysqli_fetch_array($resultfooter);
							$footertext = $rowfooter["value"];
							echo $footertext;
							?>
							</h6>
							<?php 
							$resultfooter = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='footertext'");
							$rowfooter = mysqli_fetch_array($resultfooter);
							$footertext = $rowfooter["value"];
							echo $footertext;
							?>
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
