$(document).ready(function () {
	// console.log("CVPG-PrioSys");

	$('#signup').click(function(){
		window.location = "registration.html";
	});

	$('#login').click(function(){
		window.location = "login.html";
	});

	$('#btnSignUp').click(function(){

		var fName = $('#firstN').val();
		var lName = $('#lastN').val();
		var email = $('#email').val();
		var pass = $('#pass').val();
		var pass2 = $('#pass2').val();

		$.ajax({
            type:'GET',
            data:{
            	fName:fName,
            	lName:lName,
            	email:email,
            	pass:pass,
            	pass2:pass2,
                action:'register',
            },
            url:'includes/function.php',
	        beforeSend:function(){
	        	$('#btnSignUp').prop('disabled', true);
	         	$('#btnSignUp').addClass('spinner');
				$('#btnSignUp').css({"cursor": "not-allowed"});
				$('#usedEmail').hide();
				$('#errEmail').hide();
				$('#errPass').hide();
	        },
            success:function(data) {
            	myObj = JSON.parse(data);
            	$('#btnSignUp').prop('disabled', false);
            	$('#btnSignUp').removeClass('spinner');
				$('#btnSignUp').css({"cursor": "pointer"});

            	if(myObj.response == 1) {
            		alert("Registration successful");
            		window.location = "login.html";
            	}

            	else if (myObj.responseEmail == 1) {
            		if(myObj.dataEmail == "used") {
            			$('#usedEmail').show();
            		}

            		else if(myObj.dataEmail == "invalid") {
            			$('#errEmail').show();
            		}
            	}

            	else if(myObj.responsePassword == 1) {
            		$('#errPass').show();
            	}

            	else if (myObj.response == "empty") {
            		alert(myObj.comment);
            	}

            	else {
            		alert("There is a problem");
            	}            	
            }
        });
	});

	$('#btnLogin').click(function(){

		var email = $('#email').val();
		var pass = $('#pass').val();

		$.ajax({
            type:'GET',
            data:{
            	email:email,
            	pass:pass,
                action:'login',
            },
            url:'includes/function.php',
	        beforeSend:function(){
	        	$('#btnLogin').prop('disabled', true);
	         	$('#btnLogin').addClass('spinner');
				$('#btnLogin').css({"cursor": "not-allowed"});
	        },
            success:function(data) {
            	myObj = JSON.parse(data);
            	$('#btnLogin').prop('disabled', false);
            	$('#btnLogin').removeClass('spinner');
				$('#btnLogin').css({"cursor": "pointer"});
				$('#errEmail').hide();
				$('#errPass').hide();
				
            	if(myObj.response == 1) {
            		alert("Login successful");
            	}

            	else if (myObj.response == 0) {
            		$('#errPass').show();
            	}

            	else if(myObj.response == -1) {
            		$('#errEmail').show();
            	}

            	else {
            		alert(myObj.comment);
            	}            	
            }
        });
	});
});