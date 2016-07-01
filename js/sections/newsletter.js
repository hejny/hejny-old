
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



        sp_lists.forEach(function(sp_target){


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




    $('button.mail').click(function () {


        var lists = $(this).attr('data-lists');
        lists = lists.split(',');
        r(lists);

        newsletter_window.show();



        var width = newsletter_window.outerWidth();




        var $this = $(this);
        var offset = $this.offset();

        newsletter_window.css('position', 'absolute');
        newsletter_window.css('top', offset.top-(-$this.outerHeight()));
        newsletter_window.css('left',offset.left-(width*0.8)+$this.outerWidth()/2-7);


        //r($newsletter_window);
        //window_open($newsletter_window);


    });


});
