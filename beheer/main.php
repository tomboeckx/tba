<?php include '../includes/check_auth.inc'; ?>
<?php include '../includes/cnn_open.inc'; ?>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=10">

		<link rel="stylesheet" href="css/flat.css" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

		<title>Throwback Authentics - store back-end</title>
		
		<script type="text/javascript">
		//callback handler for form submit
		function navText() {
			$.ajax({
				type: 'GET',
				url: "./text.php",
				processData: false,
				contentType: false,
				success: function(data){
					$("#bodycontent").html(data);
					$("#pageTileHolder").html($("#PageTitle").val());
				}
			});
		};
		function navCats() {
			$.ajax({
				type: 'GET',
				url: "./cats.php",
				processData: false,
				contentType: false,
				success: function(data){
					$("#bodycontent").html(data);
					$("#pageTileHolder").html($("#PageTitle").val());
				}
			});
		};
		function navOrders() {
			$.ajax({
				type: 'GET',
				url: "./orders.php",
				processData: false,
				contentType: false,
				success: function(data){
					$("#bodycontent").html(data);
					$("#pageTileHolder").html($("#PageTitle").val());
				}
			});
		};
		</script>

		
	</head>
	<body>
		<!-- top bar-->
		<div id="menuWrapper">
			<div id="menu">
			<h1 id="pageTileHolder">Throwback Authentics - Administrator login</h1>
			</div>
		</div>
		<!-- end top bar-->
		<!-- content -->
		<div id="content"> 
			<!-- left side navigation -->
			<div id="navWrapper">
				<div id="nav">
					<p id="navHeader"></p>
					<ul style="list-style: none outside none;padding-left:0;">
						<li class="navItem" onclick="navCats();"><a href="javascript:navCats();"><span>Producten</span></a></li>
						<li class="navItem" onclick="navText();"><a href="javascript:navText();"><span>Teksten</span></a></li>
						<li class="navItemEmpty"></li>
						<li class="navItem" onclick="navOrders();"><a href="javascript:navOrders();"><span>Orders</span></a></li>
						<li class="navItemEmpty"></li>
						<li class="navItem" onclick="window.open('http://www.throwback-authentics.be', '_blank');"><a href="http://www.throwback-authentics.be" target="_blank"><span>Bekijk site</span></a></li>
						<li class="navItemEmpty"></li>
						<li class="navItem" onclick="location.href='logout.php';"><a href="logout.php"><span>Afmelden</span></a></li>
					</ul>
					<br/>
					<p id="navFooter">Developed by <a href="http://www.b-dev.net">b-dev.net</a>.<br>Click <a href="http://www.b-dev.net/contact">here</a> for support.</p>
				</div>
			</div>
			<!-- left side navigation -->

			<!-- actual content -->
			<div id="bodyWrapper">
				<div id="bodycontent">
					<h1>Maak een keuze</h1>
				</div>
			</div>
			<!-- actual content -->

		</div>
		<!-- end content wrapper-->
	</body>
</html>
<?php include '../includes/cnn_close.inc'; ?>
