<?php

$folders = glob('data/gallery/*');



function sortGalleries($a, $b) {
    global $projects_keys;


    $aa=basename($a);
    $bb=basename($b);

    $aaa=array_search($aa,$projects_keys);
    $bbb=array_search($bb,$projects_keys);
    //$aaa=isset($projects[$aa])?$projects[$aa]['start']:0;
    //$bbb=isset($projects[$bb])?$projects[$bb]['start']:0;

    if(!is_numeric($aaa))$aaa=999;
    if(!is_numeric($bbb))$bbb=999;

    //echo("($aaa,$bbb)");

    if($aaa==$bbb){
        return 0;
    }elseif($aaa<$bbb){
        return -1;
    }elseif($aaa>$bbb){
        return 1;
    }

}
usort($folders, 'sortGalleries');



foreach($folders as $folder):

    $gallery=basename($folder);



    $images = glob($folder.'/*');

    //shuffle($images);


    $submenu[$gallery]=$MESSAGES['galleries'][$gallery];
    echo('<h3 id="gallery-'.$gallery.'">'.$MESSAGES['galleries'][$gallery].'</h3>');

    if(isset($projects_asoc[$gallery])){

    ?>

        <p><?=$projects_asoc[$gallery]['description'][$LANGUAGE]?></p>

    <?php } ?>

    <p>

        <?php if(isset($projects_asoc[$gallery]['url'])): ?>
        <a href="<?=$projects_asoc[$gallery]['url']?>" target="_blank"  class="button">
            <?=$projects_asoc[$gallery]['url_']?> <i class="fa fa-external-link"></i>
        </a>
        <?php endif; ?>

        <?php if(isset($projects_asoc[$gallery])): ?>
        <button onclick="scroll_to('#projects-<?=$gallery?>')"><?=$MESSAGES['buttons']['project']?> <i class="fa fa-arrow-up"></i>
        </button>
        <?php endif; ?>


        <?php if(count($images)>6): ?>
            <button
                onclick="$('#gallery-<?=$gallery?>-image-group').find('.more').toggle();if($(this).find('i').hasClass('fa-caret-square-o-down')){$(this).find('i').removeClass('fa-caret-square-o-down').addClass('fa-caret-square-o-up');}else{$(this).find('i').removeClass('fa-caret-square-o-up').addClass('fa-caret-square-o-down');}"
            ><?=$MESSAGES['buttons']['gallery_more']?> <i class="fa fa-caret-square-o-down"></i>
            </button>
        <?php endif; ?>



        <?php if($projects_asoc[$gallery]['sendpress_list']): ?>
            <button class="newsletter" data-lists="<?=$projects_asoc[$gallery]['sendpress_list']?>">
                <?=$MESSAGES['newsletter']['button']?>
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
            </button>
        <?php endif; ?>




    </p>

    <?php



    echo('<div class="image-group" id="gallery-'.$gallery.'-image-group"><p>');



    $i=0;
    foreach($images as $image):


        if($i==6){echo('</p><p class="more" style="display: none;">');}

        ?>
        <img src="graphic/galleryimg.php?gallery=<?=urlencode($gallery)?>&amp;image=<?=urlencode(basename($image))?>"

            class="gallery-img"
            width="128" height="128"
             alt="<?=urlencode(basename($image))?> - <?=$gallery?>"
        />

        <?php


        $i++;


    endforeach;
    echo('</p></div>');
    /**/


endforeach;

?>