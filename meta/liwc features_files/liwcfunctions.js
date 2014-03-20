$(document).ready(function() {
	$("div.hiddendiv").hide();
	

	$("a.showContact").click(function() {
//		$("div#contactus").show();
        $("div#contactus").slideDown("fast");
		$("input#fullname").focus();
	});
	$("input#cancelContact").click(function() {
//		$("div#contactus").hide();
        $("div#contactus").slideUp("fast");
	});
	
	$("input#submitContactForm").click(function() {
		var fullname = $("input#fullname").val();
		var subject = $("input#subject").val();
		var email = $("input#contactemail").val();
		var message = $("textarea#message").val();
		if (isBlank(fullname) ) {
			alert ("Please enter your name");
			$("input#fullname").focus();
		} else if ( isBlank(subject) ) {
			alert ("Please enter a subject for your email"); 
			$("input#subject").focus();
		} else if ( !checkemail(email) ) {
			alert ("Please enter a valid email address"); 
			$("input#contactemail").focus();
		} else if ( isBlank(email) ) {
			alert ("Please enter your email address"); 
			$("input#contactemail").focus();
		} else if ( isBlank(message) ) {
			alert ("Please enter a message to send us"); 
			$("textarea#message").focus();
		} else {
			var dataString = 'fullname='+ fullname + '&subject=' + subject + '&email=' + email + '&message=' + message;
			$.ajax({
				type: "POST",
				url: "sendeail.php",
				data: dataString,
				success: function(msg) {
					$('#contactFormResponse').html("<div id='message'></div>");
					msg = jQuery.trim(msg);
					if (msg == "OK") {
						$('#message').html("<p><img id='checkmark' src='images/check.png' />")
						.append("<p>Thank you " + fullname + ", your message has been sent to us.</p>")
						.append("<input type='button' id='sentOK' class='formButton' value='OK'>");
					} else {
						$('#message').html("<img id='checkmark' src='images/cancel.png' />")
						.append(msg)
						.append("<input type='button' id='sentOK' class='formButton' value='OK'>");
					}
					$("input#sentOK").click(function() {
						$("div#contactus").hide();
					});

				}
			});
		}
	});	
	
	// load simplemodal page
	$( ".dictionaries" ).click(function(e) {
		var thisid = "dictionary_info/" + this.id + ".html";
		$('<div></div>').load(thisid).modal({overlayClose:true}); // AJAX
	});

	// load EULA
//	$( "#eula" ).load('eula.html').modal({overlayClose:true}); // AJAX
	// load EULA
	$( "#eula" ).click(function() {
		$('<div></div>').load('eula.html').modal({overlayClose:true}); // AJAX
	});

});



/////////////////

function isBlank(val){
	if(val==null){
		return true;
	}
	for(var i=0;i<val.length;i++) {
		if ((val.charAt(i)!=' ')&&(val.charAt(i)!="\t")&&(val.charAt(i)!="\n")&&(val.charAt(i)!="\r")){
			return false;
		}
	}
	return true;
}
function isDigit(num) {
	if (num.length>1){
		return false;
	}
	var string="1234567890";
	if (string.indexOf(num)!=-1){
		return true;
	}
	return false;
}
function isInteger(val){
	if (isBlank(val)){
		return false;
	}
	for(var i=0;i<val.length;i++){
		if(!isDigit(val.charAt(i))){
			return false;
		}
	}
	return true;
}

function checkemail(str) {
	var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	return (filter.test(str));
}
