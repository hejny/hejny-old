


/*! modernizr 3.3.1 (Custom Build) | MIT *
 * http://modernizr.com/download/?-mq !*/
!function(e,n,t){function o(e,n){return typeof e===n}function a(){var e,n,t,a,i,s,r;for(var d in l)if(l.hasOwnProperty(d)){if(e=[],n=l[d],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(a=o(n.fn,"function")?n.fn():n.fn,i=0;i<e.length;i++)s=e[i],r=s.split("."),1===r.length?Modernizr[r[0]]=a:(!Modernizr[r[0]]||Modernizr[r[0]]instanceof Boolean||(Modernizr[r[0]]=new Boolean(Modernizr[r[0]])),Modernizr[r[0]][r[1]]=a),f.push((a?"":"no-")+r.join("-"))}}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):c?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function s(){var e=n.body;return e||(e=i(c?"svg":"body"),e.fake=!0),e}function r(e,t,o,a){var r,l,d,f,c="modernizr",p=i("div"),h=s();if(parseInt(o,10))for(;o--;)d=i("div"),d.id=a?a[o]:c+(o+1),p.appendChild(d);return r=i("style"),r.type="text/css",r.id="s"+c,(h.fake?h:p).appendChild(r),h.appendChild(p),r.styleSheet?r.styleSheet.cssText=e:r.appendChild(n.createTextNode(e)),p.id=c,h.fake&&(h.style.background="",h.style.overflow="hidden",f=u.style.overflow,u.style.overflow="hidden",u.appendChild(h)),l=t(p,e),h.fake?(h.parentNode.removeChild(h),u.style.overflow=f,u.offsetHeight):p.parentNode.removeChild(p),!!l}var l=[],d={_version:"3.3.1",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){l.push({name:e,fn:n,options:t})},addAsyncTest:function(e){l.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=d,Modernizr=new Modernizr;var f=[],u=n.documentElement,c="svg"===u.nodeName.toLowerCase(),p=function(){var n=e.matchMedia||e.msMatchMedia;return n?function(e){var t=n(e);return t&&t.matches||!1}:function(n){var t=!1;return r("@media "+n+" { #modernizr { position: absolute; } }",function(n){t="absolute"==(e.getComputedStyle?e.getComputedStyle(n,null):n.currentStyle).position}),t}}();d.mq=p,a(),delete d.addTest,delete d.addAsyncTest;for(var h=0;h<Modernizr._q.length;h++)Modernizr._q[h]();e.Modernizr=Modernizr}(window,document);


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

var lastTop=0;

windowResize = function() {

    //console.log($('.timeline').css('display'));

    if(!Modernizr.mq('(max-width: 800px)')){

        //console.log('resizing');

        var top = $('.projects-placeholder').offset().top - (-50);
        $('.projects-top').css('top', '+=' + (top-lastTop));
        $('.projects-top').show();

        lastTop=top;

    }else{

        //console.log('non resizing');

    }


//============================================================================================


    /*$('.image-group').each(function () {


        $(this).css('text-align-last', 'left');

        var positions = [];
        var status = 0;
        var i = 0;
        //0: first item
        //1: first row
        //2: normal row

        $(this).find('.gallery-img').each(function () {



            var left = Math.floor($(this).position().left);


            if (status == 0) {

                positions.push(left);
                status = 1;

            } else if (status == 1) {


                if (positions[positions.length - 2] > left) {
                    status = 2;
                } else {
                    positions.push(left);
                }


            }


            if (status == 2) {

                if (positions[i] != left) {


                    //console.log(positions[i], left);


                    $(this).css('margin-left', (positions[i] - left) + "px");

                    status = 3;


                }


                i++;
                if (i >= positions.length)i = 0;

            }


        });


        if (status == 1) {
            $(this).css('text-align-last', 'center');
        }

    });*/

};

//============================================================================================


$(function(){

    windowResize();

    setInterval(function(){
        windowResize();
    },600);



    $('.scrollup').hide();

    $(window).scroll(function () {


        //console.log($(this).scrollTop());
        if ($(this).scrollTop() > 300) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    /*$('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });*/







});


$( window ).resize(function() {

    windowResize();

});
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
