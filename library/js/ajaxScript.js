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

    $('div.buttonProfile').click(function(){
    	$('div.dropdownProfile').toggle();

    	$('.menu li').click(function(){
			if ($(this).attr('id') == "logout") {
				window.location = "logout.php";
			}
			$('.menu li').off('click');

		});
    });

    $('#linkRequirement').click(function(){
        $('div.dropdownRequirement').toggle();

        $('.menu li').click(function(){
            if ($(this).attr('id') == "requirementPage") {
                // window.location = "requirement.php";
            }

            else if ($(this).attr('id') == "votingPage") {
            }

        });

        console.log("clicked");
    });

    //Home
    if(currUrl == "http://localhost/cvpg-priosys/home.php") {
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

        $.ajax({
            type: "GET",
            data: {
                action: "getTotalProject"
            },
            url: "includes/function.php",
            dataType: "html",
            success: function (data) {

                $('#totalProject').html(data);
            }
        });
    }

    //requirement PM
    if(currUrl == "http://localhost/cvpg-priosys/PMrequirement.php") {
        $('#linkRequirement').css({"font-weight":"700"});

        $.ajax({
            type: "POST",
            data: {
                action: "requirement"
            },
            url: "includes/function.php",
            dataType: "html",
            success: function (data) {

                if(data == 0) {
                    $('#noRequirement').show();
                }

                else {
                    $('div.content').hide();
                    $('div.requirement').show();
                    $("tbody.rData").html(data);
                }

            }
        });

        $.ajax({
            type: "POST",
            data: {
                action: "getProjectName"
            },
            url: "includes/function.php",
            dataType: "html",
            success: function (data) {

                $('#projectName').html(data);

            }
        });

    }

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
                            goToSearchResult(data);          
                        }
                    });

                }
            }
            
        });
    });

    function goToSearchResult(data){
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

    const modal = document.querySelector("#modalAddProject");
    const modal3 = document.querySelector("#modalAddRequirement");

    $('#addRequirement').add('#addRequirement2').add('#addRequiremen3').click(function(){
        modal3.showModal();
        $('.enterData2').val('');
        $('.enterData2').removeClass('reject');

        focusInput(modal3);
        blurInput(modal3);
        saveModal(modal3);
        closeModal(modal3);

    });

    function focusInput(m) {
        $(m).find('#rid').focus(function(){
            $(this).css({"outline":"solid 3.5px rgba(58, 108, 217, 0.5)"});
        });

        $(m).find('#rName').focus(function(){
            $(this).css({"outline":"solid 3.5px rgba(58, 108, 217, 0.5)"});
        });
    }

    function blurInput(m) {
        $(m).find('#rid').blur(function(){
            $(this).css({"outline":"solid 1px rgba(0, 0, 0, 10%)"});
        });
        $(m).find('#rName').blur(function(){
            $(this).css({"outline":"solid 1px rgba(0, 0, 0, 10%)"});
        });
    }


    $('#addProject').add('#addProject2').add('#addProject3').click(function(){
        modal.showModal();
        $('.enterData').val('');
        $('textarea').val('');
        $('#pStatus').val('Modifying').attr('disabled',true);
        $('#title').removeClass('reject');

        closeModal(modal);

    });

    $('#title').focus(function(){
        $(this).css({"outline":"solid 3.5px rgba(58, 108, 217, 0.5)"});
    });

    $('#title').blur(function(){
        $(this).css({"outline":"solid 1px rgba(0, 0, 0, 10%)"});
    });

    function closeModal(m) {
        $(m).find('.btnGrey').click(function(){
            m.setAttribute("closing", "");
            m.addEventListener("animationend",()=>{
                m.removeAttribute("closing");
                m.close();},
                {once:true});
        });
    }

    function saveModal(m) {

        if($(m).attr('id') == 'modalAddRequirement') {

            $(m).find('#save2').click(function(){
                var rid = $(this).parent().siblings('div').find('#rid');
                var rName = $(this).parent().siblings('div').find('#rName');

                if(rid.val() == '' && rName.val() == '') {
                    rid.css({"outline":"solid 3.5px rgba(217, 58, 58, 0.5)"});
                    rid.addClass('reject')
                    rName.css({"outline":"solid 3.5px rgba(217, 58, 58, 0.5)"});
                    rName.addClass('reject')
                }

                else if(rid.val() == '') {
                    rid.css({"outline":"solid 3.5px rgba(217, 58, 58, 0.5)"});
                    rid.addClass('reject')
                }

                else if (rName.val() == '') {
                    rName.css({"outline":"solid 3.5px rgba(217, 58, 58, 0.5)"});
                    rName.addClass('reject');
                }

                else {
                    $(this).prop('disabled', true).css({"cursor":"not-allowed"});
                    $(this).siblings('button').prop('disabled', true).css({"cursor":"not-allowed"});
                    $(this).siblings('.loading').show();

                    console.log("not empty");

                    $.ajax({
                        type:'POST',
                        data:{
                            rid:rid.val(),
                            rName:rName.val(),
                            action:'addRequirement',
                        },
                        url:'includes/function.php',
                        success:function(data) {
                              
                            if(data == 1) {
                                goToAddRequirementResult(data);
                            }

                            else {
                                console.log(data);
                            }
                            
                        }
                    });
                }
            });

        }
    }

    function goToAddRequirementResult(data) {
        window.location.reload();
    }

    $('#save').click(function(){
        var title = $('#title').val();
        var dev = $('#developer').val();
        var date = $('#projectStart').val();
        var pDesc = $('#projectDesc').val();

        if(title == '') {
            $('#title').css({"outline":"solid 3.5px rgba(217, 58, 58, 0.5)"});
            $('#title').addClass('reject')
        }
        else {

            $(this).prop('disabled', true);
            $(this).siblings('button').prop('disabled', true);
            $(this).parents('dialog').find('.loading').show();

            $.ajax({
                type:'GET',
                data:{
                    title:title,
                    dev:dev,
                    // status:status,
                    date:date,
                    pDesc:pDesc,
                    action:'addProject',
                },
                url:'includes/function.php',
                success:function(data) {
                      
                    if(data == 1) {
                        goToAddProjectResult(data);
                    }

                    else {
                        console.log(data);
                    }
                    
                }
            });
        }
    });

    function goToAddProjectResult(data) {
        $('#save').prop('disabled', false);
        $('#save').siblings('button').prop('disabled', false);
        $('#save').parents('dialog').find('.loading').hide();

        modal.setAttribute("closing", "");
        modal.addEventListener("animationend",()=>{
            modal.removeAttribute("closing");
            modal.close();},
            {once:true});

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

        $.ajax({
            type: "GET",
            data: {
                action: "getTotalProject"
            },
            url: "includes/function.php",
            dataType: "html",
            success: function (data) {
                $('#totalProject').html(data);
            }
        });
    }

});   