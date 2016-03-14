<?php
/**
 *
 * ██╗███╗   ██╗██████╗ ███████╗██╗  ██╗
 * ██║████╗  ██║██╔══██╗██╔════╝╚██╗██╔╝
 * ██║██╔██╗ ██║██║  ██║█████╗   ╚███╔╝
 * ██║██║╚██╗██║██║  ██║██╔══╝   ██╔██╗
 * ██║██║ ╚████║██████╔╝███████╗██╔╝ ██╗
 * ╚═╝╚═╝  ╚═══╝╚═════╝ ╚══════╝╚═╝  ╚═╝
 * © Towns.cz
 * @fileOverview This PHP file generates HTML skeleton for browser...
 */


//======================================================================================================================

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );

/*phpinfo();
die();*/


require('config.php');
require('lib/neon/neon.php');



//----------------------------------------load $LANGUAGE

$languages=array('en','cs');


$language_uri = substr($_SERVER['REQUEST_URI'],-2);
$language_headers = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));


if(in_array($language_uri,$languages)){

    $LANGUAGE=$language_uri;

}elseif(in_array($language_headers,$languages)){

    $LANGUAGE=$language_headers;

}else{

    $LANGUAGE=$languages[0];

}

//----------------------------------------redirect

$url=$config['base_url'].$LANGUAGE;
if('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']!=$url){
    header('Location: '.$url);
    exit;
}


//----------------------------------------load $MESSAGES

$file="/locale/$LANGUAGE.neon";
if(!file_exists($file)) {
    $LANGUAGE='cs';//todo maybe in future default language should be english
    $file=__DIR__ ."/locale/$LANGUAGE.neon";
}
$MESSAGES = Nette\Neon\Neon::decode(file_get_contents($file));
//print_r($MESSAGES);

//----------------------------------------





/*$MESSAGES=array(
    'about',
    'articles',
    'timeline'

);*/



$pages=array(
    'about'=>array(),
    'articles'=>array(),
    //'social'=>array(),
    'projects'=>array(),
    'gallery'=>array(),
    'contact'=>array(),

);


?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?=$MESSAGES['about']['name']?></title>

        <?php /*<link rel="icon" href="favicon.ico">*/ ?>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.2.3/css/simple-line-icons.css">
        <?php /*<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>*/ ?>
       <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
        <script src="main.js" async></script>
        <script>
            var timestamp=<?=time()?>;
        </script>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-70710834-1', 'auto');
            ga('send', 'pageview');

        </script>




    </head>
    <body>




    <main id="pages" >


        <?php


        /*style="background: url('<?php

        $files=glob('data/backgrounds/*');
        shuffle($files);
        echo($files[0]);

        ?>')"*/

        foreach($pages as $page=>&$submenu){

            echo('<article class="page" id="'.$page.'">');
            if($MESSAGES['pages'][$page])
            echo('<h2>'.$MESSAGES['pages'][$page].'</h2>');
            require("pages/$page.php");
            echo('</article>');


        }


        ?>


        <footer>
            @ Pavol Hejný
        </footer>

    </main>


    <nav id="menu">

        <a href="#about" id="menu-title">
            <img src="http://1.gravatar.com/avatar/3d98c15957c5f5dd227e53dbc7cbb60d?s=30&r=pg&d=mm">
            <h1>Pavol Hejný</h1>
        </a>

        <ul>
            <?php

            /*print_r($pages);*/

            foreach($pages as $page=>&$submenu){

                /*print_r($page);
                print_r($submenu);*/

                if(isset($MESSAGES['menu'][$page])) {
                    ?>
                    <li>
                    <a href="#<?= $page ?>"><?= $MESSAGES['menu'][$page] ?></a>


                    <!--<ul>
                        <?php /*foreach($submenu as $subpage=>$subname): */
                    ?>
                            <li><a href="#<?/*=$page.'-'.$subpage*/
                    ?>"><?/*=$subname*/
                    ?></a></li>
                        <?php /*endforeach; */
                    ?>
                    </ul>-->



                    </li>
                    <?php
                }

            }


            ?>


            <?php /*<li class="menu-list-item">
                <a href="#">Projekty</a>
            </li>


            <li class="menu-list-item">
                <a href="#">Články a přednášky</a>
            </li>

            <li class="menu-list-item">
                <a href="#">Blog</a>
            </li>*/ ?>
        </ul>

        <div id="languages" >
            <a href="./en"><img src="locale/en.png"></a>
            <a href="./cs"><img src="locale/cs.png"></a>

        </div>
    </nav>







    <div class="overlay" style="display: none;"></div>
    <div class="popup-window" style="display: none;">
        <div class="content"></div>
    </div>





    <?php /* */ ?>


    </body>
    </html>
