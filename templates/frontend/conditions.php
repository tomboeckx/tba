	<?php $this->layout('frontend::template', ['title' => 'Info en voorwaarden | Throwback Authentics', 'data' => $data]) ?>
	<div id="main">
		<!-- wrapper-main -->
		<div class="wrapper">
			<!-- content -->
			<div id="content">
				<div class="plain-text">
					<?=$data['page2body']?>
				</div>
			</div>
			<!-- ENDS content -->
		</div>
		<!-- ENDS wrapper-main -->
	</div>
	<script type="text/javascript">
	$(function() {
		$( "#navConditions" ).addClass( "current-menu-item" );
	});
	</script>
