
$(function() {


    $('#articles article .summary').click(function () {

        var details = $(this).parent().find('.details');

        if(details.length>0) {

            $(this).find('.toggle').toggleClass('fa-caret-square-o-down');
            $(this).find('.toggle').toggleClass('fa-caret-square-o-up');
            details.slideToggle();

        }else{



        }


    });


});