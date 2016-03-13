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



    <?php
    endforeach;
    ?>



