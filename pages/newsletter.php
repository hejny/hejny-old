

<section id="newsletter-window" style="display: none;">

    <i class="close fa fa-times" aria-hidden="true"></i>



    <p class="info"><?=$MESSAGES['newsletter']['info']?></p>

    <form method="post" action="">
        <input type="hidden" name="sp_list" value="8"/>
        <input type="hidden" name="sendpress" value="post" />
        <div id="form-wrap">
            <p class="field-group">
                <label for="email"><?=$MESSAGES['newsletter']['email']?>:* </label>
                <input type="email" value="@" name="sp_email"/>
            </p>
            <p class="field-group">
                <label for="email"><?=$MESSAGES['newsletter']['name']?>: </label>
                <input type="text" value="" name="sp_name"/>
            </p>


            <fieldset>
                <legend><?=$MESSAGES['newsletter']['taa']?></legend>

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
            </fieldset>


            <fieldset>

                <legend><?=$MESSAGES['newsletter']['projects']?></legend>
                <?php foreach($projects as $project):


                    $url = $project['sendpress_url'];
                    $list = $project['sendpress_list'];


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
