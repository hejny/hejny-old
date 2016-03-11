<?php

$folders = glob('data/gallery/*');

foreach($folders as $folder):

    $images = glob($folder.'/*');

    $gallery=basename($folder);
    $submenu[$gallery]=$MESSAGES['galleries'][$gallery];
    echo('<h3 id="gallery-'.$gallery.'">'.$MESSAGES['galleries'][$gallery].'</h3>');

    foreach($images as $image):


        ?>
        <img src="graphic/galleryimg.php?gallery=<?=urlencode($gallery)?>&amp;image=<?=urlencode(basename($image))?>"

            class="galleryimg"
            width="150" height="150"
        />

        <!--onclick=""-->

        <?php


    endforeach;
endforeach;

?>
<script>

    $(function(){

        $('.galleryimg').click(function(){


            var src=$(this).attr('src');


            window_open('<img src="'+src+'&amp;big" />');
            /*$(this).animate({
                "width": "500px",
                "height": "500px"

            }, "slow" );*/


        });


    });

</script>

