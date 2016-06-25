    <?php

    $articles = Nette\Neon\Neon::decode(file_get_contents('data/articles.neon'));

    foreach($articles as $article):


        $type=$MESSAGES['articles']['types'][$article['type']];

        $site=parse_url($article['url']);
        $site=$site['host'];
        $site=str_replace('www.','',$site);
        $site=str_replace(
             array('itnetwork')
            ,array('ITnetwork')
            ,$site);
        //$site=ucfirst($site);


        if(isset($article['embed'])){

            if(is_string($article['embed'])){
                $article['embed']=array($article['embed']);
            }


            $article['content'] = '';
            foreach($article['embed'] as $url){
                $article['content'] .= '<iframe src="'.$url.'" scrolling="no" allowfullscreen> </iframe>';
            }



        }








    ?>



    <article>

        <!--<a href="<?/*=$article['url']*/?>" target="_blank">
            <?/*=$article['title'][$LANGUAGE]*/?> <i>(<?/*=$type*/?>, <?/*=$site*/?> <i class="fa fa-external-link"></i>)</i>-->




            <div class="summary">

                <?php if(!isset($article['content'])){ ?>

                    <a href="<?=$article['url']?>" target="_blank">
                        <h3><?=$article['title'][$LANGUAGE]?></h3>
                        <i>(<?=$type?>, <?=$site?> <i class="fa fa-external-link"></i>)</i>
                    </a>

                <?php }else{ ?>

                    <h3><?=$article['title'][$LANGUAGE]?></h3>
                    <i>(<?=$type?>, <?=$site?>)</i>
                    <i class="fa fa-caret-square-o-up toggle"></i>

                <?php } ?>


            </div>

            <?php if(isset($article['content'])){ ?>
                <p class="details">

                    <?=$article['content']?>

                </p>
            <?php } ?>


        </a>



    </article>





    <?php
    endforeach;
    ?>



