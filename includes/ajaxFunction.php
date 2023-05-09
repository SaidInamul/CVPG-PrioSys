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

        const modal2 = document.querySelector("#modalDelete");
        const modal4 = document.querySelector("#modalEditRequirement");
        const modal7 = document.querySelector("#modalRemoveStakeholder");
        const modal5 = document.querySelector("#modalViewPM");
        const modal6 = document.querySelector("#modalViewSK");
        const modal8 = document.querySelector("#addedStakeholder");

        function openingModalProject(e,pid,m){

            $('.btnGrey').click(function(){
                m.setAttribute("closing", "");
                m.addEventListener("animationend",()=>{
                    m.removeAttribute("closing");
                    m.close();},
                    {once:true});
            });

            $('.btnRed').click(function(){
                window.location = "home.php";
            });

        }

        function openingModalMember(mid,m){

            $('.btnGrey').click(function(){
                m.setAttribute("closing", "");
                m.addEventListener("animationend",()=>{
                    m.removeAttribute("closing");
                    m.close();},
                    {once:true});
            });

            $('.btnRed').click(function(){
                window.location = "home.php";
            });

        }

        //Modal fetch data
        function fetchData(ID,currUrls) {

            //Stkaeholder page view data
            if(currUrls == "http://localhost/cvpg-priosys/PMStakeholder.php" || currUrls == "http://localhost/cvpg-priosys/SStakeholder.php") {
                $.ajax({
                    type:'POST',
                    data:{
                        uID:ID,
                        action:'fetchUserData',
                    },
                    url:'includes/function.php',
                    success:function(data) {
                        
                        var myObj = JSON.parse(data);

                        viewUser(myObj,ID, currUrls);
                    }
                });
            }

            //requirement page edit data
            else if (currUrls == "http://localhost/cvpg-priosys/PMrequirement.php") {
                $.ajax({
                    type:'POST',
                    data:{
                        rID:ID,
                        action:'fetchRequirementData',
                    },
                    url:'includes/function.php',
                    success:function(data) {
                        
                        var myObj = JSON.parse(data);

                        editRequirement(myObj,ID, currUrls);
                    }
                });
            } 
        }

        //Show modal for view user of the project
        function viewUser(data,mID, currUrls) {
            if(data.response == 1) {
                if(data.roleID == 2) {

                    console.log(data.uStatusAgreement);

                    modal6.showModal();

                    $(modal6).find('.picture2').css({"background-image": data.backgrounColor});
                    letter = data.uFirstName.charAt(0);
                    $(modal6).find('.fChar2').append(letter.toUpperCase());
                    $(modal6).find('b').append(data.uFirstName.substr(0,1).toUpperCase()+data.uFirstName.substr(1)+' '+data.uSecondName.substr(0,1).toUpperCase()+data.uSecondName.substr(1));
                    $(modal6).find('.email2').append(data.uEmail);

                    $(modal6).find('#companyName').append(data.uCompany);
                    $(modal6).find('#emailMember').append(data.uEmail);
                    $(modal6).find('#locationMember').append(data.uLocation);
                    $(modal6).find('#statusVoteMember').append(data.uStatusVote);
                    $(modal6).find('#roleMember').append(data.uRole);
                    $(modal6).find('#statusAggrementMember').append(data.uStatusAgreement);

                    blurButton(modal6);
                    closeModal(modal6,currUrls);
                    discardModal(modal6, mID, currUrls);

                }

                else if (data.roleID == 1) {

                    console.log(data.uStatusAgreement);

                    modal5.showModal();

                    $(modal5).find('.picture2').css({"background-image": data.backgrounColor});
                    letter = data.uFirstName.charAt(0);
                    $(modal5).find('.fChar2').append(letter.toUpperCase());
                    $(modal5).find('b').append(data.uFirstName.substr(0,1).toUpperCase()+data.uFirstName.substr(1)+' '+data.uSecondName.substr(0,1).toUpperCase()+data.uSecondName.substr(1));
                    $(modal5).find('.email2').append(data.uEmail);

                    $(modal5).find('#companyName').append(data.uCompany);
                    $(modal5).find('#emailMember').append(data.uEmail);
                    $(modal5).find('#locationMember').append(data.uLocation);
                    $(modal5).find('#statusVoteMember').append(data.uStatusVote);
                    $(modal5).find('#roleMember').append(data.uRole);
                    $(modal5).find('#statusAggrementMember').append(data.uStatusAgreement);

                    blurButton(modal5);
                    closeModal(modal5,currUrls);
                    discardModal(modal5, mID, currUrls);
                }
                
            }

            else if (data.response == 0) {
                console.log("Failed to fetch data user");
            }
        }

        //Show modal for edit requirement
        function editRequirement(data, rID, currUrls) {
            
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
            closeModal(modal4,currUrls);
            discardModal(modal4, rID, currUrls);
        }

        //Input interaction
        function focusInput(m) {
            $(m).find('#rid').focus(function(){
                $(this).css({"outline":"solid 3.5px rgba(58, 108, 217, 0.5)"});
            });

            $(m).find('#rName').focus(function(){
                $(this).css({"outline":"solid 3.5px rgba(58, 108, 217, 0.5)"});
            });
        }

        //blur inpput
        function blurInput(m) {
            $(m).find('#rid').blur(function(){
                $(this).css({"outline":"solid 1px rgba(0, 0, 0, 10%)"});
            });
            $(m).find('#rName').blur(function(){
                $(this).css({"outline":"solid 1px rgba(0, 0, 0, 10%)"});
            });
        }

        //blur button dialog
        function blurButton(m) {
            $(m).find('.blurBtn').blur();
        }

        //Modal function
        function closeModal(m,currUrls) {
            if(currUrls == "http://localhost/cvpg-priosys/PMrequirement.php") {
                $(m).find('.btnGrey').click(function(){
                    m.setAttribute("closing", "");
                    m.addEventListener("animationend",()=>{
                        m.removeAttribute("closing");
                        m.close();},
                        {once:true});
                });
            }

            else if (currUrls == "http://localhost/cvpg-priosys/PMStakeholder.php" || currUrls == "http://localhost/cvpg-priosys/SStakeholder.php"){
                $(m).find('.btnGrey').click(function(){
                    $(m).find('.fChar2').empty();
                    $(m).find('b').empty();
                    $(m).find('.email2').empty();
                    $(m).find('#companyName').empty();
                    $(m).find('#emailMember').empty();
                    $(m).find('#locationMember').empty();
                    $(m).find('#statusVoteMember').empty();
                    $(m).find('#roleMember').empty();
                    $(m).find('#statusAggrementMember').empty();
                    m.setAttribute("closing", "");
                    m.addEventListener("animationend",()=>{
                        m.removeAttribute("closing");
                        m.close();},
                        {once:true});
                });
            }

            // else if (currUrls == ) {

            // }
            
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

        function discardModal(m, ID, currUrls) {

            if(currUrls == "http://localhost/cvpg-priosys/PMStakeholder.php") {
                console.log("Trying to delete stakeholders")
            }

            else if (currUrls == "http://localhost/cvpg-priosys/PMrequirement.php") {
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
            
        }

        //Project page
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

        $('div.project').children('.option').click(function(e){
            e.stopPropagation();
            $(this).next().toggle();
            
            $(this).next().find('li').click(function(e){

                e.stopPropagation();

                var pID = $(this).parents('div.project').data('id')

                //Opening project from dropdown
                if($(this).attr('id') == 'open'){

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

                                window.location = "PMrequirement.php";
                            }

                            else if (data == 0){
                                window.location = "Srequirement.php";
                            }

                            else {
                                alert("Fail to open project");
                                window.locatioin = "home.php";
                            }

                        }
                    });

                }

                //Deleting project
                else if($(this).attr('id') == 'delete') {
                    modal2.showModal();
                    $('#closeModalMain').blur();
                    $(this).off('click');
                    $(this).parents('div.menus').hide();
                    openingModalProject($(this), $(this).parents('div.project').data('id'),modal2);

                }
            });
        });

        //Opening project
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
                        window.location = "PMrequirement.php";
                    }

                    else if (data == 0){
                        window.location = "Srequirement.php";
                    }

                    else {
                        alert("Fail to open project");
                        window.locatioin = "home.php";
                    }

                }
            });
        });

        var currUrls = window.location.href;

        //Requirement page
        //MouseHover table Requirement
        if (currUrls == "http://localhost/cvpg-priosys/PMrequirement.php" ) {
            PmSideRequirement(currUrls);
        }

        else if (currUrls == "http://localhost/cvpg-priosys/Srequirement.php") {
            SkSideRequirement(currUrls);
        }

        function PmSideRequirement(currUrls) {
            $('.rData tr').mouseenter(function(){
                $(this).addClass('hoverEffect');
            });

            $('.rData tr').mouseleave(function(){
                $(this).removeClass('hoverEffect');
            });

            $('tr').click(function(){

                var rID = $(this).data('id');

                $('.enterData2').css({"outline":"solid 1px rgba(0, 0, 0, 10%)"});

                fetchData(rID,currUrls);
            });
        }

        function SkSideRequirement(currUrls) {
            $('tr').css({"cursor":"default"});
        }

        //Stakeholder page
        //MouseHover table Stakeholder
        if (currUrls == "http://localhost/cvpg-priosys/PMStakeholder.php" || currUrls == "http://localhost/cvpg-priosys/SStakeholder.php") {
            stakeholderPage(currUrls);
        }

        function stakeholderPage(currUrls) {
            $('.sData tr').mouseenter(function(){
                $(this).addClass('hoverEffect');
            });

            $('.sData tr').mouseleave(function(){
                $(this).removeClass('hoverEffect');
            });

            $('tr').click(function(){

                var mID = $(this).data('id');

                fetchData(mID,currUrls);
            });
        }

        $('td').find('#inviteStakeholder').click(function(){
            console.log($(this).data('id'));
            modal8.showModal();
            blurButton(modal8);

            $(modal8).find('#check').click(function(){
                window.location = "http://localhost/cvpg-priosys/PMStakeholder.php";
            });
        });

    });
</script>