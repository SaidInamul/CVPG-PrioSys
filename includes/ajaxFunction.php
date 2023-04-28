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

        $('div.project').children('.option').click(function(e){
            e.stopPropagation();
            $(this).next().toggle();
            $(this).next().find('li').click(function(e){
                e.stopPropagation();
                console.log($(this).attr('id'));
                $(this).off('click');
                $(this).parents('div.menus').hide();
            });
        });

        $('div.project').click(function(){
            $(this).css({"outline-color":"rgba(58, 108, 217, 0.5)", "outline-style":"solid", "outline-width":"3.5px"});
            console.log($(this).data('id'));

        });
    });
</script>