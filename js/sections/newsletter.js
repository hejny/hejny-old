
$(function() {


    var newsletter_window = $('#newsletter-window');

    newsletter_window.find("form").submit(function (e) {

        e.preventDefault();

        var sp_email = newsletter_window.find("form").find('input[name="sp_email"]').val();
        var sp_name = newsletter_window.find("form").find('input[name="sp_name"]').val();

        sp_name=sp_name.trim().split(' ');
        sp_firstname = sp_name[0];
        sp_lastname = sp_name[1];

        var sp_lists=[];
        newsletter_window.find('.sendpress-list').parent().removeClass('error').removeClass('success');
        newsletter_window.find('.sendpress-list').each(function(){

            if($(this).is(':checked')) {

                sp_lists.push({

                    url: $(this).attr('data-url'),
                    list: parseInt($(this).attr('data-list'))

                });

                $(this).parent().addClass('loading');

            }


        });



        r(sp_lists);


        var pending=0;
        sp_lists.forEach(function(sp_target){


            pending++;
            $.ajax({
                url: sp_target.url,
                type: "post",
                dataType: 'json',
                data: {

                    sendpress: 'post',
                    sp_list: sp_target.list,
                    sp_email: sp_email,
                    sp_firstname: sp_firstname,
                    sp_lastname: sp_lastname,

                },
                complete: function (response) {

                    pending--;
                    if(pending==0){
                        setTimeout(function(){
                            newsletter_window.hide();
                        },2000);
                    }

                    try {
                        response = JSON.parse(response.responseText);
                        if (response.success === false) {

                            throw new Error('Success from SendPress is not true!');

                        }

                        console.log('Added '+response.email+' to list '+response.list.join(''));
                        newsletter_window.find('input[data-list="'+sp_target.list+'"]').parent().removeClass('loading').addClass('success');

                    }
                    catch(err) {

                        console.warn(err);
                        newsletter_window.find('input[data-list="'+sp_target.list+'"]').parent().removeClass('loading').addClass('error');


                    }


                }

            });

        });





        return false;
    });


    newsletter_window.find('.close').click(function(){
        newsletter_window.hide();
    });


    /*$(document).click(function() {
        newsletter_window.hide();//stop().fadeOut();

    });
    newsletter_window.click(function(e) {
        e.stopPropagation(); // This is the preferred method.
        return false;        // This should not be used unless you do not want
                             // any click events registering inside the div
    });*/







    $('button.newsletter').click(function (e) {

        e.preventDefault();

        var lists = $(this).attr('data-lists');
        lists = lists.split(',');
        r(lists);


        newsletter_window.find('.sendpress-list').parent().removeClass('error').removeClass('success').removeClass('loading');
        newsletter_window.find('.sendpress-list').each(function(){

            var $this = $(this);
            var list = $this.attr('data-list');
            r(list);
            $this.prop('checked', lists.indexOf(list)!==-1);

        });



        setTimeout(function(){
            newsletter_window.show();//.stop().slideDown();
        },50);




        var width = newsletter_window.outerWidth();




        var $this = $(this);
        var offset = $this.offset();

        newsletter_window.css('position', 'absolute');
        newsletter_window.css('top', offset.top-(-$this.outerHeight())+10);

        var left = offset.left-(width*0.8)+$this.outerWidth()/2;
        if(left<0)left=0;
        newsletter_window.css('left',left);


        //r($newsletter_window);
        //window_open($newsletter_window);


        return false;

    });


});
