	<?php $this->layout('frontend::template', ['title' => 'Het onstaan van Throwback Authentics ', 'data' => $data]) ?>
	<div id="main">
		<!-- wrapper-main -->
		<div class="wrapper">
			<!-- content -->
			<div id="content">
				<div class="plain-text">
					<?=$data['page1body']?>
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
