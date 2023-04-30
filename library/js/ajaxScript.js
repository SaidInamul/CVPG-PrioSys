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

    // $(document).click(function(e){
	// 	let $target = $(e.target);

    //     if (!$target.closest('.searchBar').length){
    //         $('.searchBar').css({"outline":"solid 1px rgba(0, 0, 0, 10%);"});
    //         $('#cancelSearch').hide();
    //     }
	// });

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
            	}

            }
        });

    $('#cancelSearch').css({"cursor":"pointer"});

    $('.searchBar').children('#cancelSearch').click(function(e){

        e.stopPropagation();

        $(this).siblings('input').val('');
        $(this).parent().css({"outline":"solid 1px rgba(0, 0, 0, 10%)"});
        $(this).hide();

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
                    $('.empty').hide();
                    $('.content').show();
                }

                else {
                    $("div.content").html(data);
                    $('.empty').hide();
                    $('.content').show();
                }

            }
        });
    });

    $('#search').blur(function(){
        $(this).parent().css({"outline":"solid 1px rgba(0, 0, 0, 10%)"});
        $(this).off('keyup');
    });


    $('.searchBar').click(function(){
        $(this).css({"outline":"solid 3.5px rgba(58, 108, 217, 0.5)"});
        $(this).removeClass('reject');

        $(this).find('input').focus().keyup(function(e){

            e.stopPropagation();

            let key = (e.keyCode ? e.keyCode : e.which);

            if($(this).val() == '' && key == '13'){
                $(this).next('#cancelSearch').hide();

                $(this).parent().css({"outline":"solid 3.5px rgba(217, 58, 58, 0.5)"});
                $(this).parent().addClass('reject');
            }

            else if ($(this).val() != '') {
                $(this).next('#cancelSearch').show();
                $(this).parent().removeClass('reject');
                
                if(key == '13'){
                    $(this).off('keyup');
                    e.stopPropagation();

                    $(this).parent().addClass('disabledSearch');
                    $(this).parent().css({"cursor":"not-allowed"});
                    $(this).prop('disabled', true);

                    $.ajax({
                        type:'GET',
                        data:{
                            inputSearch:$(this).val(),
                            action:'search',
                        },
                        url:'includes/function.php',
                        beforeSend:function(){
                            
                            $('.loading').show();
                        },
                        success:function(data) {
                            goToResult(data);          
                        }
                    });

                }
            }
            
        });
    });

    function goToResult(data){
        $('.searchBar').removeClass('disabledSearch')
        $('input').prop('disabled',false);
        $('.searchBar').css({"cursor":"pointer"});
        $('.loading').hide(); 
        if(data == 0) {
            $('.content').hide();
            $('#noProject').hide();
            $('.empty').show();
        }

        else {
            $("div.content").html(data);
            $('.empty').hide();
            $('.content').show();
        }               
    }

    const modal = document.querySelector("#modal");
    const closeModal = document.querySelector("#close");
    $('#addProject').add('#addProject2').add('#addProject3').click(function(){
        console.log("button add project clicked");

        modal.showModal();
        $('.enterData').val('');
        $('textarea').val('');
        $('#pStatus').val('Modifying').attr('disabled',true);
        $('#title').removeClass('reject');
        $('#title').focus();
        $('#title').css({"outline":"solid 3.5px rgba(58, 108, 217, 0.5)"});

    });

    $('#close').click(function(){
        modal.setAttribute("closing", "");
        modal.addEventListener("animationend",()=>{
            modal.removeAttribute("closing");
            modal.close();},
            {once:true});
    });

    $('#save').click(function(){
        let title = $('#title').val();
        if(title == '') {
            console.log("Title can not empty");
            $('#title').css({"outline":"solid 3.5px rgba(217, 58, 58, 0.5)"});
            $('#title').addClass('reject')
        }
        else {
            console.log("Good");
        }
    });

});   