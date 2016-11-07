

<button class="filter" data-filter="all"><?=$MESSAGES['articles']['all']?></button>


<?php foreach($MESSAGES['articles']['types'] as $key=>$value): ?>

    <button class="filter" data-filter=".<?=$key?>"><?=$value[1]?></button>

<?php endforeach; ?>



<!--<label>Sort:</label>
<button class="sort" data-sort="myorder:asc">Asc</button>
<button class="sort" data-sort="myorder:desc">Desc</button>-->





<button class="newsletter" data-lists="17,18">
    <?=$MESSAGES['newsletter']['button']?>
    <i class="fa fa-envelope-o" aria-hidden="true"></i>
</button>





<?php

    $articles = Nette\Neon\Neon::decode(file_get_contents('data/articles.neon'));

    $i=0;
    foreach($articles as $article):


        $type=$MESSAGES['articles']['types'][$article['type']][0];

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



    <article class="mix <?=$article['type']?>" data-myorder="<?=$i?>" style="display: block;">

        <!--<a href="<?/*=$article['url']*/?>" target="_blank">
            <?/*=$article['title'][$LANGUAGE]*/?> <i>(<?/*=$type*/?>, <?/*=$site*/?> <i class="fa fa-external-link"></i>)</i>-->


        <?php


        if(isset($article['event'])){
            $where = $article['event'];
        }else{
            $where = $site;
        }




        $more = array();


        if($article['type']=='talk'){
            $more[] = '<i class="fa fa-comment-o" aria-hidden="true" title="'.$type.'"></i>';
        }else
        if($article['type']=='article'){
            $more[] = '<i class="fa fa-file-text-o" aria-hidden="true" title="'.$type.'"></i>';
        }
        //$more[] = $type;
        $more[] = $article['date'];
        $more[] = $where;


        $more = implode(' | ',$more);





        ?>

            <div class="summary">

                <?php if(!isset($article['content'])){ ?>

                    <i class="fa fa-external-link icon" title="<?=$site?>"></i>
                    <a href="<?=$article['url']?>" target="_blank">
                        <h3><?=$article['title'][$LANGUAGE]?></h3>
                        <i class="more"><?=$more?></i>
                    </a>

                <?php }else{ ?>

                    <i class="fa fa-caret-square-o-down icon toggle"></i>
                    <h3><?=$article['title'][$LANGUAGE]?></h3>
                    <i class="more"><?=$more?></i>


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
        $i++;
    endforeach;

    ?>



