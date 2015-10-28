	function click(el) {
	  // Simulate click on the element.
	  var evt = document.createEvent('Event');
	  evt.initEvent('click', true, true);
	  el.dispatchEvent(evt);
	}

	function handleFiles(files) {
	  upload();
	}

	//callback handler for form submit
	function upload() {
		if(beforeSubmit()==true) {
			var formElement = document.getElementById("editForm");
			$.ajax({
				xhr: function()
				{
					var xhr = new window.XMLHttpRequest();
					//Upload progress
					xhr.upload.addEventListener("progress", OnProgress, false);
					return xhr;
				},
				type: 'POST',
				url: "./imageupload/catimgupload.php",
				processData: false,
				contentType: false,
				data: new FormData( formElement ),
				success: function(data){
					$("#output").html(data);
					$("#cat_picture").val($("#hiddenNewFilename").val());
					//alert($("#cat_picture").val()):
					afterSuccess();
				}
			});
		}
	};

	function CKupdate(){
		for ( instance in CKEDITOR.instances ) {
			CKEDITOR.instances[instance].updateElement();
			}
	}

	function navSaveCat(catid) {
		CKupdate();
		var formElement = document.getElementById("editForm");
		var str = $( "#editForm" ).serialize();

		$.ajax({
			type: 'get',
			url: "./edit_cat.php?catid="+catid,
			processData: false,
			contentType: false,
			data: str,
			success: function(data){
				$("#bodycontent").html(data);
			}
		});
	};

	$(function() {
		CKEDITOR.replace('cat_description', {height: 400});
		
		document.querySelector('#fileSelect').addEventListener('click', function(e) {
			var fileInput = document.querySelector('#imageInput');
			fileInput.click(); // use the native click() of the file input.
			e.preventDefault();
		}, false);

	});
