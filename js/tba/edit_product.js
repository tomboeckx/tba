	var imgid = 0;
	var uploadSPODialog;
	
	$(document).ready(function(){
		CKEDITOR.replace('prod_description', {height: 400});

		uploadSPODialog = $("#dialog-uploadFromSPO").dialog({
			resizable: false,
			height:750,
			width:1000,
			modal: true,
			autoOpen : false,
			buttons: {
				"Selectie opladen": function() {
				  $( "#dialog-uploadFromSPO" ).dialog( "close" );
				  
				  uploadSelection();
				},
				Annuleer: function() {
				  $( "#dialog-uploadFromSPO" ).dialog( "close" );
				}
			}

		});
		
		$( "#dialog-confirmpicture" ).dialog({
		  resizable: false,
		  height:600,
		  width:500,
		  modal: true,
		  autoOpen : false,
		  buttons: {
			"Verwijder foto": function(e) {
			  $( this ).dialog( "close" );
			  
			  navDeletePicture();
			  e.preventDefault();
			},
			Annuleer: function() {
			  $( this ).dialog( "close" );
			}
		  }
		});
		
		//event listener for hidden file input
		document.querySelector('#fileSelect').addEventListener('click', function(e) {
			var fileInput = document.querySelector('#imageInput');
			fileInput.click(); // use the native click() of the file input.
			e.preventDefault();
		}, false);

		
	});
	
	function uploadSelection() {
		
		var selected = [];
		
		$('#content-uploadFromSPO input:checked').each(function() {
			selected.push($(this).attr('value'));
		});
		
		if(selected.length == 0) {
			alert("No selection was made");
		}
		else {
			uploadFromSPO(selected);
		}
	}

	function upload() {
		if(beforeSubmit()==true) {
			var formElement = document.getElementById("editForm");
			$.ajax({
				xhr: function()
				{
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", OnProgress, false); //progress
					return xhr;
				},
				type: 'POST',
				url: "./imageupload/prodimgupload.php",
				data: new FormData( formElement ),
				processData: false,
				contentType: false,
				success: function(data){
					$("#savedpics").html(data);
					afterSuccess();
				}
			});
		}
	};

	function uploadFromSPO(imageArray) {
		beforeSubmitSPO();
		var formElement = document.getElementById("editForm");
		var str = $( "#editForm" ).serialize();
		$.ajax({
			xhr: function()
			{
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", OnProgress, false); //progress
				return xhr;
			},
			type: 'POST',
			url: "./imageupload/prodimguploadSPO.php?imageArray="+imageArray,
			data: new FormData( formElement ),
			processData: false,
			contentType: false,
			success: function(data){
				$("#savedpics").html(data);
				afterSuccess();
			}
		});
	};

	
	function openSPODialog() {
		var pid = $( "#prod_id" ).val();
		$("#dialog-uploadFromSPO").dialog("open");
		$("#content-uploadFromSPO").load("./spo/index.php?prodid="+pid);
		return false;

	}
	function navToSPORoot() {
		var pid = $( "#prod_id" ).val();
		$("#content-uploadFromSPO").load("./spo/index.php?prodid="+pid);
		return false;
	}
	
	function navToSPOFolder( folder ) {
		$("#content-uploadFromSPO").load("./spo/index.php?folder="+folder)
		return false;
	};
	
	function navDeletePicture() {
		var pid = $( "#prod_id" ).val();
		
		$.ajax({
			type: 'GET',
			url: 'edit_product.php?imgid='+imgid+'&prodid='+pid,
			processData: false,
			contentType: false,
			success: function(data){
				$("#bodycontent").html(data);
			}
		});
	};

	
	function confirmDelete(id) {
		imgid = id;
		var str = $("#foto"+imgid).html();
		$("#deleteFotoHolder").html(str);
		$("#dialog-confirmpicture").dialog("open");
	}

	function navSaveProduct(catid) {
		CKupdate();
		var formElement = document.getElementById("editForm");
		var str = $( "#editForm" ).serialize();
		var pid = $( "#prod_id" ).val();

		$.ajax({
			type: 'get',
			url: "./edit_product.php?prodid="+pid+"&catid="+catid,
			processData: false,
			contentType: false,
			data: str+"&save=save",
			success: function(data){
				$("#bodycontent").html(data);
			}
		});
	};

	function CKupdate(){
		for ( instance in CKEDITOR.instances ) {
			CKEDITOR.instances[instance].updateElement();
		}
	}

	function click(el) {
	  // Simulate click on the element.
	  var evt = document.createEvent('Event');
	  evt.initEvent('click', true, true);
	  el.dispatchEvent(evt);
	}

	function handleFiles(files) {
	  upload();
	}
