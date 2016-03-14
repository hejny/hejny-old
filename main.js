

//============================================================================================


$(function() {
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

            history.pushState(null, null, this.hash);
            hashChanged(this.hash);

            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top-50
                }, 666);

                return false;
            }
        }
    });
});



function scroll_to(hash){

    hash_to(hash);

    $('html,body').animate({
        scrollTop: $(hash).offset().top-50
    }, 666);

}


function hash_to(hash){

    history.pushState(null, null, hash);
    hashChanged(hash);

}

//============================================================================================


function window_open(html){

    $('.popup-window').find('.content').html(html);

    $('.overlay').show();
    $('.popup-window').show();

}



function window_close(){
    $('.overlay').hide();
    $('.popup-window').hide();
}


$(function(){

    $('.overlay').click(function(){

        window_close();

    });

    $('.popup-window').click(function(){

        window_close();

    });

});


//============================================================================================

/*if ("onhashchange" in window) { // event supported?
 window.onhashchange = function () {
 hashChanged(window.location.hash);
 }
 }
 else { // event not supported:

var storedHash = window.location.hash;
window.setInterval(function () {
    if (window.location.hash != storedHash) {
        storedHash = window.location.hash;
        hashChanged(storedHash);
    }
}, 100);
}
*/

$(function(){
    hashChanged(window.location.hash);
});


function hashChanged(hash){

    //alert(hash);

    $('.project-selected').removeClass('project-selected', 200);

    var id1=$('.project-selected').attr('id');
    var id2=$(hash).attr('id');

    if(id1!=id2){
        if($(hash).hasClass('project')){

            $(hash).addClass('project-selected',200);

        }
    }else{
        history.pushState(null, null, '#');
    }

}


//============================================================================================



$(function(){

    var top= $('.projects-placeholder').offset().top-(-50);
    $('.projects-top').css('top','+='+top);
    $('.projects-top').show();

});

//============================================================================================


/*
$(function(){


    $('.project').each(function(){



        var start = $(this).attr('start'),
            end = $(this).attr('end');


        console.log(timestamp,start);

        $(this)
            .css('position','absolute')
            .css('top',(timestamp-start)/(3600*24))
            .css('left',Math.round(Math.round()*100)+'%')
        ;



    })







});*/
