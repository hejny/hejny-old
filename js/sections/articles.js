
$(function() {


    $('#articles article .summary').click(function () {



        var details = $(this).parent().find('.details');
        //r(details);


        if(details.length>0) {

            $(this).find('.toggle').toggleClass('fa-caret-square-o-down');
            $(this).find('.toggle').toggleClass('fa-caret-square-o-up');
            details.slideToggle();

        }else{



        }


    });





    $('#articles').mixItUp({
        /*animation: {
            animateChangeLayout: true, // Animate the positions of targets as the layout changes
            animateResizeTargets: true, // Animate the width/height of targets as the layout changes
            effects: 'fade rotateX(-40deg) translateZ(-100px)'
        },*/
        layout: {
            containerClass: 'list' // Add the class 'list' to the container on load
        }
    });

});