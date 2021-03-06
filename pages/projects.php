<?php

$timeline_start=mktime(0, 0, 0, 1, 1,date("Y"));


function time2top($time){
    global $timeline_start;
    return(($timeline_start-$time)/(3600*24*2));
}


$projects_keys=array();


//print_r($projects);
$i=-1;
$t=0;
$zi=500;

foreach($projects as $project):

    $projects_keys[]=$project['key'];


    if($project['roles']['ph']=='creator')
        $role='';
    else
        $role=$MESSAGES['projects']['roles'][$project['roles']['ph']];


    $startend=date2lang($project['_start']);
    if($project['_end']) {
        if ($project['_start'] != $project['_end']) {
            $startend .= ' - ' . date2lang($project['_end']);
        }

    }else{
        $startend.=' - '.$MESSAGES['projects']['times']['now'];
    }




    $file='graphic/projectimg.php?project='.$project['key'];
    $file=false;

    /*$style=
        "z-index:2;".
        ($file?"background: url('$file');":'').
        "background-size: auto 100%;".
        "display: inline-block;".
        //"border: 3px solid {$project['color']};".*/

    $top_start=time2top($project['start']);//($timeline_start-$project['start'])/(3600*24*2)+800;
    $top_end=time2top($project['end']);////($timeline_start-$project['end'])/(3600*24*2)+800;


    if($top_end>$top_start-50)$top_end=$top_start-50;


    $zi-=5;
    $t++;
    $left=150*$i;

    if($i==-1){
        $i=1;
    }else{
        $i=-1;
    }



    $style=
        "z-index:".($zi+1000).";".
        //($file?"background: url('$file');":'').
        //"background-size: cover;".
        //"background-repeat: no-repeat;".
        //"background-color: {$project['color']};".
        "position: absolute;".
        "top: ".round($top_start)."px;".
        "left: calc(50% + ".round($left/*-(($t%4)<2?-20:20)*/)."px - 131px);".
        //"border: 3px solid {$project['color']};".
        "display: none;";


    $left_t=round($left+(262/2)-(($t%5-2)*20));


    $style_t=
        "z-index:".($zi-100).";".
        "position: absolute;".
        "display:none;".
        "width:3px;".
        //"background-color: {$project['color']};".
        "top: ".round($top_end+5)."px;".
        "height: ".round(abs($top_end-$top_start))."px;".
        "left: calc(50% + ".$left_t."px - 131px);".
        "";



    $style_te=
        "z-index:".($zi-90+500).";".
        "position: absolute;".
        "display:none;".
        "width:22px;".
        "height:22px;".
        "border-radius:30px;".
        //($file?"background: url('$file');":'').
        "background-size: 100% auto;".
        "background-color: #ffffff;".
        //"border: 3px solid #ff0000;".
        "top: ".round($top_end+2)."px;".
        "left: calc(50% + ".$left_t."px - 143px);".
        "";

    $style_ted=
        "z-index:".($zi-89+500).";".
        "position: absolute;".
        "display:none;".
        "width:30px;".
        "height:30px;".

        //"padding:-10px;".
        //"border-radius:10px;".
        //"color: #00ff00;".
        //"color: {$project['color']};".
        //"background-color: #ff0000;".
        "font-size: 30px;".
        "top: ".round($top_end-4)."px;".
        "left: calc(50% + ".$left_t."px - 143px);".
        "";


    //$submenu[$project['key']]=$project['name'][$LANGUAGE];



    $is_web=isset($project['url']);
    $is_gallery=isset($MESSAGES['galleries'][$project['key']]);
    ?>


    <div class="project-folder">

        <div id="projects-<?=$project['key']?>" onclick="$(this).removeClass('project-selected', 200);hash_to('#projects-<?=$project['key']?>')" class="project projects-top" style="<?=$style?>" >
            <div>
                <h3><?=$project['name'][$LANGUAGE]?></h3><br>
                <?php if($role): ?><i><?=$role?></i><?php endif; ?>
                <i><?=$startend?></i>

                <div class="more">

                    <?php if($is_web || $is_gallery || $project['sendpress_list']): ?>
                        <p class="project-buttons">
                            <?php if($is_web): ?>
                                <a href="<?=$project['url']?>" target="<?=$target?>" class="button" >
                                    <?=$project['url_']?> <i class="fa fa-external-link"></i>
                                </a>
                            <?php endif; ?>

                            <?php if($is_gallery): ?>
                                <a href="#gallery-<?=$project['key']?>" class="button">
                                    <?=$MESSAGES['buttons']['gallery']?> <i class="fa fa-arrow-down"></i>
                                </a>
                            <?php endif; ?>


                            <?php if($project['sendpress_list']): ?>
                                <button class="newsletter" data-lists="<?=$project['sendpress_list']?>">
                                    <?=$MESSAGES['newsletter']['button']?>
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </button>
                            <?php endif; ?>


                        </p>
                    <?php endif; ?>


                    <?php if(count($project['roles'])>1): ?>
                        <table>
                            <?php foreach($project['roles'] as $person=>$role): ?>
                                <tr>
                                    <th><?=$MESSAGES['projects']['roles'][$role];?>:</th>
                                    <td>
                                        <a
                                            href="<?=$MESSAGES['projects']['collaborators'][$person]['url'];/*todo to calaborators*/?>"
                                            target="_blank"
                                        >
                                            <?=$MESSAGES['projects']['collaborators'][$person]['name'];?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>

                    <p class="project-description">
                        <?=$project['description'][$LANGUAGE]?>
                    </p>








                </div>



            </div>


        </div>


        <a href="#projects-<?=$project['key']?>" >
            <div class="timeline projects-top projects-pipe" style="<?=$style_t?>" ></div>
            <div class="timeline_end projects-top projects-circle-bg" style="<?=$style_te?>" ></div>
            <div class="timeline_end projects-top projects-circle" style="<?=$style_ted?>" >
                <i class="fa <?=$statuses[$project['status']]?>"></i>
            </div>
        </a>

    </div>



    <?php

    /**/



endforeach;



$zi=450;

for($year=2006;$year<=date("Y");$year++):

    $zi--;

    $start=mktime(0, 0, 0, 1, 1, $year);
    $end=mktime(0, 0, 0, 1, 1, $year+1);

    $top_start=time2top($start);//($timeline_start-$start)/(3600*24*2)+800;
    $top_end=time2top($end);//($timeline_start-$end)/(3600*24*2)+800;

    $style_y=
        "z-index:".($zi).";".
        "position: absolute;".
        "display:none;".
        "height:30px;".
        "width: ".round(abs($top_end-$top_start))."px;".
        ($year!=date("Y")?"border-left: 2px solid #777777;":'').
        //"border-right: 2px solid #777777;".
        "top: ".round($top_end+5-($top_end-$top_start)/2)."px;".
        "right: calc(50vw - 450px - 30px);".
        "transform: rotate(90deg);".
        "color:#999999;".
        "font-size:1.5em;".
        //"vertical-align:middle;".
        "";

    ?>
    <div class="year projects-top" style="<?=$style_y?>" ><?=$year?></div>
    <?php


endfor;

//----------------------------------------------------------------placeholder



$style_placeholder=
    "display:block;".
    "width: 100%;".
    "height:".round(time2top(mktime(0, 0, 0, 6, 15, 2006)))."px;".
    //"background-color: #ffffff;".
    //"border-right: 2px solid #777777;".
    "";
?>


<div class="projects-placeholder" style="<?=$style_placeholder?>" ></div>
