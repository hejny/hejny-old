<?php
/**

     ██████╗ ██████╗  █████╗ ██████╗ ██╗  ██╗██╗ ██████╗
    ██╔════╝ ██╔══██╗██╔══██╗██╔══██╗██║  ██║██║██╔════╝
    ██║  ███╗██████╔╝███████║██████╔╝███████║██║██║
    ██║   ██║██╔══██╗██╔══██║██╔═══╝ ██╔══██║██║██║
    ╚██████╔╝██║  ██║██║  ██║██║     ██║  ██║██║╚██████╗
    ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚═╝     ╚═╝  ╚═╝╚═╝ ╚═════╝
    © Towns.cz

 * @fileOverview Functions for images

 */


//======================================================================================================================



namespace graphic;





function imgresize($img,$width,$height) {
    $new_image = imagecreatetruecolor($width, $height);
    imagealphablending($new_image,false);
    imagecopyresampled($new_image, $img, 0, 0, 0, 0, $width, $height, imagesx($img), imagesy($img));
    return($new_image);
}

//-------

function imgresizew($img,$width) {
    $ratio = $width / imagesx($img);
    $height = imagesy($img) * $ratio;
    return(imgresize($img,$width,$height));
}

//-------


function imgresizeh($img,$height) {
    $ratio = $height / imagesy($img);
    $width = imagesx($img) * $ratio;
    return(imgresize($img,$width,$height));
}


//-------

function imgresizec($img,$size) {

    $new_image = imagecreatetruecolor($size, $size);
    imagealphablending($new_image,false);

    $width = imagesx($img);
    $height = imagesy($img);

    //die($width.','.$height);

    if($width>$height){

        $crop=round(($width-$height)/2)*($size/$height);

        imagecopyresampled($new_image, $img, -$crop, 0, 0, 0, round($size*($width/$height)), $size, $width, $height);

    }else{

        $crop=round(($height-$width)/2)*($size/$width);

        imagecopyresampled($new_image, $img, 0, -$crop, 0, 0, $size, round($size*($height/$width)), $width, $height);

    }




    return($new_image);

}



