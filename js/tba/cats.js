	function navAddCat() {
		$.ajax({
			type: 'GET',
			url: "./edit_cat.php",
			processData: false,
			contentType: false,
			success: function(data){
				$("#bodycontent").html(data);
				$("#pageTileHolder").html($("#PageTitle").val());
				
			}
		});
	};
	function navEditCat(id) {
		$.ajax({
			type: 'GET',
			url: "./edit_cat.php?catid="+id,
			processData: false,
			contentType: false,
			success: function(data){
				$("#bodycontent").html(data);
				$("#pageTileHolder").html($("#PageTitle").val());
			}
		});
	};
	function navGotoCat(id) {
		$.ajax({
			type: 'GET',
			url: "./products.php?catid="+id,
			processData: false,
			contentType: false,
			success: function(data){
				$("#bodycontent").html(data);
				$("#pageTileHolder").html($("#PageTitle").val());
			}
		});
	};
	
	
	function navDeleteCat(id) {
		$.ajax({
			type: 'GET',
			url: "./cats.php?catid="+id,
			processData: false,
			contentType: false,
			success: function(data){
				$("#bodycontent").html(data);
				$("#pageTileHolder").html($("#PageTitle").val());
			}
		});
	};

	var catid = 0;
	$(document).ready(function(){
		$( "#dialog-confirm" ).dialog({
		  resizable: false,
		  height:350,
		  width:650,
		  modal: true,
		  autoOpen : false,
		  buttons: {
			"Verwijder productcategorie": function() {
			  $( this ).dialog( "close" );
			  
			  navDeleteCat(catid);
			},
			Annuleer: function() {
			  $( this ).dialog( "close" );
			}
		  }
		});
		
		
	});
	
	function confirmDelete(id) {
		catid = id;
		
		$("#dialog-confirm").dialog("open");
	}
