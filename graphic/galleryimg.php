<?php
/**

████████╗██████╗ ███████╗███████╗██████╗  ██████╗  ██████╗██╗  ██╗
╚══██╔══╝██╔══██╗██╔════╝██╔════╝██╔══██╗██╔═══██╗██╔════╝██║ ██╔╝
██║   ██████╔╝█████╗  █████╗  ██████╔╝██║   ██║██║     █████╔╝
██║   ██╔══██╗██╔══╝  ██╔══╝  ██╔══██╗██║   ██║██║     ██╔═██╗
██║   ██║  ██║███████╗███████╗██║  ██║╚██████╔╝╚██████╗██║  ██╗
╚═╝   ╚═╝  ╚═╝╚══════╝╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚═════╝╚═╝  ╚═╝
© Towns.cz

 * @fileOverview Functions for rendring trees and rocks

 */


//======================================================================================================================

require_once('graphic.lib.php');

//----------------------------------------------------------------------------------------------------------------------

if(isset($_GET['big'])){

    $size=round(1200);
    $crop=false;

}else{

    $size=round(128);
    $crop=true;

}


$image=$_GET['image'];
$gallery=$_GET['gallery'];


$file='../data/gallery/'.$gallery.'/'.$image;

$file_cache='../cache/'.md5($file.$size).'.jpg';//todo better


//--------------------------------------------------------------------------------------



if(!file_exists($file_cache) or isset($_GET['notmp']) or filesize($file_cache)<10) {
    //_________________________________________

    $src = imagecreatefromstring(file_get_contents($file));

    if($crop){
        $dest = graphic\imgresizec($src, $size);
    }else{
        $dest = graphic\imgresizew($src, $size);
    }


    imagejpeg($dest,$file_cache,80);
    chmod($file_cache,0777);

    //_________________________________________
}

/**/

header("Cache-Control: max-age=".(3600*24*100));
header('Content-Type: image/jpg');
readfile($file_cache);


/**/