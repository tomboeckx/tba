jQuery(document).ready(function($) {

	// hide messages 
	$("#error").hide();
	$("#success").hide();
	
	// on submit...
	$("#contactForm #submit").click(function() {
		$("#error").hide();
		
		//required:
		
		//name
		var name = $("input#name").val();
		if(name == ""){
			$("#error").fadeIn().text("Naam is vereist.");
			$("input#name").focus();
			return false;
		}
		
		// email
		var email = $("input#email").val();
		if(email == ""){
			$("#error").fadeIn().text("Email is vereist.");
			$("input#email").focus();
			return false;
		}
		
		// subject
		var subject = $("input#subject").val();
		if(subject == ""){
			$("#error").fadeIn().text("Onderwerp is vereist.");
			$("input#subject").focus();
			return false;
		}

		
		// comments
		var vraag = $("#vraag").val();
		
		// send mail php
		var sendMailUrl = $("#sendMailUrl").val();
		
		//to, from & subject
		var to = $("#to").val();
		var from = $("#from").val();
		
		// data string
		var dataString = 'name='+ name
						+ '&email=' + email        
						+ '&vraag=' + vraag
						+ '&subject=' + subject;						         
		// ajax
		$.ajax({
			type:"POST",
			url: sendMailUrl,
			data: dataString,
			success: success()
		});
	});  
		
		
	// on success...
	 function success(){
	 	$("#success").fadeIn();
	 	$("#contactForm").fadeOut();
	 }
	
    return false;
});

