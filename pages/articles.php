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


    <a href="<?=$article['url']?>" class="article" target="_blank">
        <?=$article['title']?> <i>(<?=$type?>, <?=$site?>)</i>
    </a>
    <!--<article width="100%" height="500">
        <iframe width="100%" height="500" src="https://www.youtube.com/embed/_x2nvz6aQY4?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
    </article>-->



    <?php
    endforeach;
    ?>



