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

    echo('<div class="image-group" id="gallery-'.$gallery.'">');

    $images = glob($folder.'/*');

    //shuffle($images);


    $submenu[$gallery]=$MESSAGES['galleries'][$gallery];
    echo('<h3>'.$MESSAGES['galleries'][$gallery].'</h3>');

    /**/if(isset($projects_asoc[$gallery])){

        ?>

        <p><?=$projects_asoc[$gallery]['description'][$LANGUAGE]?></p>

        <p>

            <a href="<?=$projects_asoc[$gallery]['url']?>" target="_blank"  class="button">
                <?=$MESSAGES['buttons']['web']?> <i class="fa fa-external-link"></i>
            </a>

            <button onclick="scroll_to('#projects-<?=$gallery?>')"><?=$MESSAGES['buttons']['project']?> <i class="fa fa-arrow-up"></i></button>

        </p>

        <?php

    }


    foreach($images as $image):


        ?>
        <img src="graphic/galleryimg.php?gallery=<?=urlencode($gallery)?>&amp;image=<?=urlencode(basename($image))?>"

            class="gallery-img"
            width="120" height="120"
             alt="<?=urlencode(basename($image))?> - <?=$gallery?>"
        />

        <?php


    endforeach;
    echo('</div>');
    /**/


endforeach;

?>