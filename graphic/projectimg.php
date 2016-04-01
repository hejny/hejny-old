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


$width=round(262*1.6);

$project=$_GET['project'];
$project=str_replace(array('/','.',':'),'',$project);



$file='';

$file_cache='../cache/'.$project.'-small.jpg';
$file_png='../data/projects/'.$project.'.png';
$file_jpg='../data/projects/'.$project.'.jpg';

if(file_exists($file_png))
    $file=$file_png;
elseif(file_exists($file_jpg))
    $file=$file_jpg;


//--------------------------------------------------------------------------------------



if(!file_exists($file_cache) or isset($_GET['notmp']) or filesize($file_cache)<10) {
    //_________________________________________

    $src = imagecreatefromstring(file_get_contents($file));
    $dest = graphic\imgresizew($src, $width);

    imagejpeg($dest,$file_cache,80);
    chmod($file,0777);

    //_________________________________________
}

header("Cache-Control: max-age=".(3600*24*100));
header('Content-Type: image/jpg');
readfile($file_cache);


