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
        $site=ucfirst($site);
    ?>



    <article>

        <a href="<?=$article['url']?>" target="_blank">
            <?=$article['title']?> <i>(<?=$type?>, <?=$site?>)</i>
        </a>
        <!--<p>
            <iframe width="100%" height="500" src="<?/*=$article['url']*/?>" frameborder="0" allowfullscreen></iframe>
        </p>-->


    </article>





    <?php
    endforeach;
    ?>



