$(document).ready(function(){

	//Header
	var letter;
		$.ajax({
            type:'GET',
            data:{
                action:'user',
            },
            url:'includes/function.php',
            success:function(data) {
            	var myObj = JSON.parse(data);
				
            	if(myObj.response == 1) {
            		$('div.picture').css({"background-image": myObj.bc});
            		letter = myObj.fName.charAt(0);
            		$('p.fChar').append(letter.toUpperCase());
            		$('p.name').append(myObj.fName.substr(0,1).toUpperCase()+myObj.fName.substr(1));
            		$('p.email').append(myObj.email);
            		$('#email').append(myObj.email);
            	}

            	else {
            		alert("Error");
            	}            	
            }
        });

    var currUrl = window.location.href;

    if(currUrl == "http://localhost/cvpg-priosys/home.php") {
    	$('#linkProject').css({"font-weight":"700"});
    }

    $(document).click(function(e){
		let $target = $(e.target);


		if(!$target.closest('div.buttonProfile').length){
			$('.dropdownProfile').hide();
		}
	});

    $('div.buttonProfile').click(function(){
    	$('div.dropdownProfile').toggle();

    	$('.menu li').click(function(){
			if ($(this).attr('id') == "logout") {
				window.location = "logout.php";
			}
			$('.menu li').off('click');

		});
    });

    //Home
    $.ajax({
            type: "GET",
            data: {
                action: "project"
            },
            url: "includes/function.php",
            dataType: "html",
            success: function (data) {

            	if(data == 0) {
            		$('#noProject').show();
            	}

            	else {
            		$("div.content").html(data);
        			console.log("have project");
            	}

            }
        });

});   