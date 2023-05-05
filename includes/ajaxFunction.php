<script type="text/javascript">

    $(document).ready(function() {

        // $(document).click(function(e){
        //     let $target = $(e.target);


        //     if(!$target.closest('.dropdown').length){
        //         $('.menu').removeClass('menu-open');
        //     }

        // });

        // $('td').find('.select').on('click', function(){
        //     $(this).siblings('.menu').addClass('menu-open');

        //     $(this).siblings('.menu').find('li').click(function(){
        //         var option = $(this).attr('id'); 
        //         console.log(option);
        //         if(option != '4') {
        //             $(this).parents('td').siblings('.btnRow').find('#btnConfirmGroup').addClass('Confirm');
        //             $('.menu').removeClass('menu-open');
        //             $(this).parent().siblings().find('.selected').html($(this).text());
        //             $('.menu li').off('click');
                    
        //             $(this).parents('td').siblings('.btnRow').find('#btnConfirmGroup').on('click', function(e) {
        //                 var RID = $(this).data('id');

        //                 $.ajax({
        //                     type: "GET",
        //                     data: {
        //                         RID: RID,
        //                         option: option,
        //                         action: "Move"
        //                     },
        //                     url: "data.php",
        //                     success: function (data) {
        //                         alert(data);
        //                     }
        //                 });
        //             });
        //         }
                
        //         else {
        //             alert("can not choose N/A");
        //         }

        //     });
        // });

      	// $('td').find('#btnResetGroup').on('click', function() {
        // 	var RID = $(this).data("id");

        // 	$.ajax({
        //         type: "GET",
        //         data: {
        //         	RID: RID,
        //             action: "Reset"
        //         },
        //         url: "data.php",
        //         success: function (data) {
        //             alert(data);
        //         }
        //     });
        // });

        $('div.project').children('#projectCaption').html(function(index,currentText) {
            var maxLength = 73;
            var text = 'See more...';

            if (currentText.length > maxLength) {
                return currentText.substr(0,maxLength) + '. ' + text.fontcolor('#236BF6');
            }

            else {
                return currentText + ' ' + text.fontcolor("#236BF6");
            }

        });

        const modal2 = document.querySelector("#modalDelete");

        $('div.project').children('.option').click(function(e){
            e.stopPropagation();
            $(this).next().toggle();
            
            $(this).next().find('li').click(function(e){

                e.stopPropagation();

                var pID = $(this).parents('div.project').data('id')

                if($(this).attr('id') == 'open'){
                    // window.location = "home.php";

                    $.ajax({
                        type: "POST",
                        data: {
                            pID: pID,
                            action: "openProject"
                        },
                        url: "includes/function.php",
                        dataType: "html",
                        success: function (data) {

                            if(data == 1) {
                                // $('#noProject').show();

                                window.location = "PMrequirement.php";
                            }

                            else if (data == 0){
                                // $("div.content").html(data);

                                window.location = "Srequirement.php";
                            }

                            else {
                                alert("Fail to open project");
                                window.locatioin = "home.php";
                            }

                        }
                    });

                }

                else if($(this).attr('id') == 'delete') {
                    modal2.showModal();
                    $('#closeModalMain').blur();
                    $(this).off('click');
                    $(this).parents('div.menus').hide();
                    openingModal($(this), $(this).parents('div.project').data('id'));

                }
            });
        });

        function openingModal(e,id){
            console.log(id);

            $('#closeModalMain').click(function(){
                modal2.setAttribute("closing", "");
                modal2.addEventListener("animationend",()=>{
                    modal2.removeAttribute("closing");
                    modal2.close();},
                    {once:true});
            });

            $('#deleteProject').click(function(){
                window.location = "home.php";
            });

        }

        $('div.project').click(function(){
            $(this).css({"outline-color":"rgba(58, 108, 217, 0.5)", "outline-style":"solid", "outline-width":"3.5px"});

            var pID = $(this).data('id')

            $.ajax({
                type: "POST",
                data: {
                    pID: pID,
                    action: "openProject"
                },
                url: "includes/function.php",
                dataType: "html",
                success: function (data) {

                    if(data == 1) {
                        // $('#noProject').show();

                        window.location = "PMrequirement.php";
                    }

                    else if (data == 0){
                        // $("div.content").html(data);

                        window.location = "Srequirement.php";
                    }

                    else {
                        alert("Fail to open project");
                        window.locatioin = "home.php";
                    }

                }
            });
        });

        function fetchRequirementData(rID) {
            $.ajax({
                type:'POST',
                data:{
                    rID:rID,
                    action:'fetchRequirementData',
                },
                url:'includes/function.php',
                success:function(data) {
                    
                    var myObj = JSON.parse(data);

                    editRequirement(myObj,rID);
                }
            });
        }

        function editRequirement(data, rID) {
            const modal4 = document.querySelector("#modalEditRequirement");

            modal4.showModal();

            $('.enterData2').removeClass('reject');

            if(data.response == 1) {
                $('#rid').val(data.rid);
                $('#rName').val(data.rName);
            }

            else if(data.response == 0) {
                $('#rid').val('Failed to fetch RID');
                $('#rName').val('Failed to fetch name');
            }

            focusInput(modal4);
            blurInput(modal4);
            saveModal(modal4, rID);
            closeModal(modal4);
            discardModal(modal4, rID);
        }

        $('tr').click(function(){

            var rID = $(this).data('id');

            $('.enterData2').css({"outline":"solid 1px rgba(0, 0, 0, 10%)"});

            fetchRequirementData(rID);
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

        function closeModal(m) {
            $(m).find('.btnGrey').click(function(){
                m.setAttribute("closing", "");
                m.addEventListener("animationend",()=>{
                    m.removeAttribute("closing");
                    m.close();},
                    {once:true});
            });
        }

        function saveModal(m, rID) {
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

                    $.ajax({
                        type:'POST',
                        data:{
                            rID:rID,
                            rid:rid.val(),
                            rName:rName.val(),
                            action:'editRequirement',
                        },
                        url:'includes/function.php',
                        success:function(data) {
                              
                            if(data == 1) {
                                window.location.reload();
                            }

                            else {
                                alert('fail to update requirement');
                                window.location.reload();
                            }
                            
                        }
                    });
                }
            });
        }

        function discardModal(m, rID) {
            $(m).find('#deleteRequirement').click(function(){
                $(this).prop('disabled', true).css({"cursor":"not-allowed"});
                $(this).siblings('button').prop('disabled', true).css({"cursor":"not-allowed"});
                $(this).siblings('.loading').show();

                $.ajax({
                    type:'POST',
                    data:{
                        rID:rID,
                        action:'deleteRequirement',
                    },
                    url:'includes/function.php',
                    success:function(data) {
                          
                        if(data == 1) {
                            window.location.reload();
                        }

                        else {
                            alert('fail to delete requirement');
                            window.location.reload();
                        }
                        
                    }
                });
            });
        }

    });
</script>