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

$language_names=array(
  'en'=>'English',
  'cs'=>'Čeština'
);
$languages=array('en','cs');




if(substr($_SERVER['HTTP_HOST'],-3)==='.cz'){
	$LANGUAGE='cs';
}elseif(substr($_SERVER['HTTP_HOST'],-4)==='.com'){
	$LANGUAGE='en';
}else{
    //echo('other lang');
	$LANGUAGE='cs';
}



//----------------------------------------redirect

if($_SERVER['REQUEST_URI']!='/' && $_SERVER['HTTP_HOST']!='localhost'){
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/');
    exit;
}
/*$url=$config['base_url'];
if('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']!=$url){
    header('Location: '.$url);
    exit;
}*/


//----------------------------------------load $MESSAGES

$file=__DIR__ ."/locale/$LANGUAGE.neon";
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

ini_set('zlib.output_compression_level', 4);
ob_start("ob_gzhandler");

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?=$MESSAGES['about']['name']?></title>



        <link rel="shortcut icon" href="http://1.gravatar.com/avatar/3d98c15957c5f5dd227e53dbc7cbb60d?s=64&r=pg&d=mm ?>" />




        <?php /*<link rel="icon" href="favicon.ico">*/ ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.2.3/css/simple-line-icons.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


        <?php /*<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>*/ ?>
       <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
        <script>
            var timestamp=<?=time()?>;
        </script>



        <?php

        $files = array_merge(glob('css/*.css'),glob('css/*/*.css'));

        foreach($files as $file){

            echo("<link rel=\"stylesheet\" href=\"".addslashes($file)."\" type=\"text/css\">\n");

        }




        $files = array_merge(glob('js/*.js'),glob('js/*/*.js'));

        foreach($files as $file){

            echo("<script type=\"text/javascript\" src=\"".addslashes($file)."\"></script>\n");

        }
        ?>





        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-70710834-1', 'auto');
            ga('send', 'pageview');

        </script>




        <script>
            (function(h,e,a,t,m,p) {
                m=e.createElement(a);m.async=!0;m.src=t;
                p=e.getElementsByTagName(a)[0];p.parentNode.insertBefore(m,p);
            })(window,document,'script','https://u.heatmap.it/log.js');
        </script>





    </head>
    <body>


    <?php
        require("pages/projects-init.php");
        require("pages/newsletter.php");
    ?>


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
            &copy; <?=date('Y')?> Pavol Hejný
        </footer>

    </main>


    <nav id="menu">

        <a href="#about" id="menu-title">
            <img src="http://1.gravatar.com/avatar/3d98c15957c5f5dd227e53dbc7cbb60d?s=30&r=pg&d=mm" alt="<?=$MESSAGES['about']['name']?>">
            <h1><?=$MESSAGES['about']['name']?></h1>
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

			<a href="http://pavolhejny.com" class="<?='en'==$LANGUAGE?'selected':''?>"><img src="locale/en.png" alt="en flag" title="<?=$language_names['en']?>"></a>

            <a href="http://pavolhejny.cz" class="<?='cs'==$LANGUAGE?'selected':''?>"><img src="locale/cs.png" alt="cs flag" title="<?=$language_names['cs']?>"></a>



        </div>
    </nav>







    <div class="overlay" style="display: none;"></div>
    <div class="popup-window" style="display: none;">
        <div class="content"></div>
        <div class="close"><i class="fa fa-times-circle"></i></div>

    </div>



    <a href="#about" class="scrollup"><i class="fa fa-arrow-up"></i></a>



    <?php /* */ ?>


    </body>
    </html>


<?php

    ob_end_flush();

?>
