			<?php $this->layout('frontend::template', ['title' => 'Throwback Authentics - Productinformatie', 'data' => $data]) ?>
			<div id="main">
				<!-- wrapper-main -->
				<div class="wrapper">
					
					<!-- content -->
					<div id="content">
						
						<!-- title -->
						<div id="page-title">
							<span class="title">Productinformatie</span>
							<span class="subtitle">Gebruik onderstaand formulier om bijkomende informatie over een product te vragen. Wij beantwoorden uw vraag zo snel mogelijk.</span>
						</div>
						<!-- ENDS title -->
							
						<!-- column (left)-->
						<div class="one-column">
							<!-- form -->
							<h2>Productinformatie</h2>
							<script type="text/javascript" src="js/tba/form-validation-reservation.js"></script>
							<form id="contactForm" action="#" method="post">
								<fieldset>
									<div>
										<label>Betreft product</label>
										<span><b><?=$data['product']['name'];?></b></span>
									</div>
									<div>
										<label>Productreferentie</label>
										<span><b><?=$data['product']['reference'];?></b></span>
									</div>
									<div>
										<label>Prijs</label>
										<span><b><?=$data['product']['price'];?>€</b></span>
									</div>
									<div>
										<label>Uw naam</label>
										<input name="name" id="name" type="text" class="form-poshytip" title="Uw naam" />
									</div>
									<div>
										<label>Uw email</label>
										<input name="email" id="email" type="text" class="form-poshytip" title="Uw email adres" />
									</div>
									<div>
										<label>Uw telefoonnummer</label>
										<input name="phone" id="phone" type="text" class="form-poshytip" title="Uw telefoon of gsm nummer" />
									</div>
									<div>
										<label>Uw vraag</label>
										<textarea  name="vraag" id="vraag" rows="5" cols="20" class="form-poshytip" title="Stel uw bijkomende vraag"></textarea>
									</div>
									
									<!-- send mail configuration -->
									<input type="hidden" value="<?php echo $data['product']['id'];?>" name="prodid" id="prodid" />
									<input type="hidden" value="info@throwback-authentics.be" name="to" id="to" />
									<input type="hidden" value="info@throwback-authentics.be" name="from" id="from" />
									<input type="hidden" value="product_reservation_mail.php" name="sendMailUrl" id="sendMailUrl" />
									<!-- ENDS send mail configuration -->
									
									<p><input type="button" value="Verzend" name="submit" id="submit" /></p>
								</fieldset>
								<p id="error" class="warning">Fout bij het versturen van het bericht. Gelieve een mailtje te sturen naar info@throwback-authentics.be via uw mail client voor bijkomende informatie.</p>
							</form>
							<p id="success" class="success">Bedankt voor uw vraag. We beantwoorden uw vraag zo snel mogelijk.</p>
							<!-- ENDS form -->
						</div>
						<!-- ENDS column -->
						
						<!-- column (right)-->
						<div class="one-column">
							<!-- content -->
							<p>   
								<img src="/fotos/products/thumb/<?=$data['product']['image']['image'];?>" class='smallProdImage' />
							</p>
							<p>
								<i>Afhaal adres:</i><br/>
								<b>Throwback Authentics</b><br/>
								Toekomststraat 7A<br/>
								3550 Heusden-Zolder<br/>
								(+32) 486 622 058<br/>
								<a href="mailto:info@throwback-authentics.be">info@throwback-authentics.be</a>
							</p>
							<!-- ENDS content -->
						</div>
						<!-- ENDS column -->							
		
					</div>
					<!-- ENDS content -->

				</div>
				<!-- ENDS wrapper-main -->
			</div>
