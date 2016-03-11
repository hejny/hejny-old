    <?php

    $articles = Nette\Neon\Neon::decode(file_get_contents('data/articles.neon'));

    foreach($articles as $article):


        $type=$MESSAGES['articles']['types'][$article['type']];
    ?>


    <a href="<?=$article['url']?>" class="article" target="_blank">
        <?=$article['title']?> <i>(<?=$type?>)</i>
    </a>



    <?php
    endforeach;
    ?>
