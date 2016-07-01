

<section id="newsletter-window" style="display: none;">


    <form method="post" action="">
        <input type="hidden" name="sp_list" value="8"/>
        <input type="hidden" name="sendpress" value="post" />
        <div id="form-wrap">
            <p name="email">
                <label for="email"><?=$MESSAGES['newsletter']['email']?>: </label>
                <input type="email" value="@" name="sp_email"/>
            </p>
            <p name="firstname">
                <label for="email"><?=$MESSAGES['newsletter']['name']?>: </label>
                <input type="text" value="" name="sp_name"/>
            </p>


            <p>
                <label class="sendlist">
                    <i class="loading-icon fa fa-cog fa-spin fa-fw" aria-hidden="true"></i>
                    <i class="success-icon fa fa-check-circle" aria-hidden="true"></i>
                    <i class="error-icon fa fa-exclamation-circle" aria-hidden="true"></i>
                    <input type="checkbox" data-url="http://blog.pavolhejny.com/blog/" class="sendpress-list" data-list="8">
                    <?=$MESSAGES['articles']['types']['talk'][1]?>
                </label>
                <label class="sendlist">
                    <i class="loading-icon fa fa-cog fa-spin fa-fw" aria-hidden="true"></i>
                    <i class="success-icon fa fa-check-circle" aria-hidden="true"></i>
                    <i class="error-icon fa fa-exclamation-circle" aria-hidden="true"></i>
                    <input type="checkbox" data-url="http://blog.pavolhejny.com/blog/" class="sendpress-list" data-list="10">
                    <?=$MESSAGES['articles']['types']['article'][1]?>
                </label>

            </p>

            <fieldset>

                <legend><?=$MESSAGES['newsletter']['projects']?></legend>
                <?php foreach($projects as $project):

                    if($project['sendpress']){

                        //print_r($project['sendpress']);echo('<hr>');

                        if(is_numeric($project['sendpress'])){


                            $url = 'http://blog.pavolhejny.com/blog/';
                            $list = $project['sendpress'];

                        }elseif(is_array($project['sendpress'])){

                            $url = $project['sendpress']['url'];
                            $list = $project['sendpress']['list'];

                        }

                    }else{
                        $url = false;
                        $list = false;

                    }



                    if($url && $list):

                        ?>

                        <label class="sendlist">
                            <i class="loading-icon fa fa-cog fa-spin fa-fw" aria-hidden="true"></i>
                            <i class="success-icon fa fa-check-circle" aria-hidden="true"></i>
                            <i class="error-icon fa fa-exclamation-circle" aria-hidden="true"></i>
                            <input type="checkbox" class="sendpress-list" data-url="<?=$url?>" data-list="<?=$list?>">
                            <?=$project['name'][$LANGUAGE]?>
                        </label>

                    <?php endif;endforeach; ?>

            </fieldset>


            <p class="submit">
                <input value="<?=$MESSAGES['newsletter']['submit']?>" class="sendpress-submit" type="submit" id="submit" name="submit">
            </p>


        </div>
    </form>



</section>
