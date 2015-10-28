			<?php $this->layout('frontend::template', ['title' => 'Contacteer ons | Throwback Authentics', 'data' => $data]) ?>
			<div id="main">
				<!-- wrapper-main -->
				<div class="wrapper">
					
					<!-- content -->
					<div id="content">
						
						<!-- title -->
						<div id="page-title">
							<span class="title">Contacteer ons</span>
							<span class="subtitle">Gebruik onderstaand formulier indien u meer informatie wenst over een van onze producten of onze winkel.</span>
						</div>
						<!-- ENDS title -->
							
						<!-- column (left)-->
						<div class="one-column">
							<!-- form -->
							<h2>Contactformulier</h2>
							<script type="text/javascript" src="js/tba/form-validation.js"></script>
							<form id="contactForm" action="#" method="post">
								<fieldset>
									<div>
										<label>Uw naam</label>
										<input name="name"  id="name" type="text" class="form-poshytip" title="Uw naam" />
									</div>
									<div>
										<label>Uw email</label>
										<input name="email"  id="email" type="text" class="form-poshytip" title="Uw email adres" />
									</div>
									<div>
										<label>Onderwerp</label>
										<input name="subject"  id="subject" type="text" class="form-poshytip" title="Onderwerp van de vraag" />
									</div>
									<div>
										<label>Vraag</label>
										<textarea  name="vraag"  id="vraag" rows="5" cols="20" class="form-poshytip" title="Stel uw vraag"></textarea>
									</div>
									
									<!-- send mail configuration -->
									<input type="hidden" value="info@throwback-authentics.be" name="to" id="to" />
									<input type="hidden" value="info@throwback-authentics.be" name="from" id="from" />
									<input type="hidden" value="contact_mail.php" name="sendMailUrl" id="sendMailUrl" />
									<!-- ENDS send mail configuration -->
									
									<p><input type="button" value="Verzend" name="submit" id="submit" /></p>
								</fieldset>
								<p id="error" class="warning">Fout bij het versturen van het bericht. Gelieve een mailtje te sturen naar info@throwback-authentics.be via uw mail client.</p>
							</form>
							<p id="success" class="success">Bedankt om contact met ons op te nemen. Wij beantwoorden uw vraag zo snel mogelijk</p>
							<!-- ENDS form -->
						</div>
						<!-- ENDS column -->
						
						<!-- column (right)-->
						<div class="one-column">
							<!-- content -->
							<p><b>Throwback Authentics</b><br/>
							<p>Toekomststraat 7A<br/>
							3550 Heusden-Zolder<br/>
							(+32) 486 622 058<br/>
							<a href="mailto:info@throwback-authentics.be">info@throwback-authentics.be</a></p>

							<p>
							<img src="/images/adres.png" width="600" height="300" />
							<!-- <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyC9W4k270tRPoUrkR-ZC8yt0vF4X-LlWhI&q=Toekomststraat+7A,3550+Heusden-Zolder" width="400" height="350" frameborder="0" style="border:0"></iframe>-->
							</p>
							<!-- ENDS content -->
						</div>
						<!-- ENDS column -->							
		
					</div>
					<!-- ENDS content -->

				</div>
				<!-- ENDS wrapper-main -->
			</div>
			<script type="text/javascript">
			$(function() {
				$( "#navContact" ).addClass( "current-menu-item" );
			});
			</script>
