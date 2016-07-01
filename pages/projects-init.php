<?php



function date2time($date){
    //return(123);
    if(!$date)return time();
    list($month,$year)=explode('.',$date);
    return mktime(0,0,0,$month,1,$year);
}


function date2lang($date){
    global $MESSAGES;
    list($month,$year)=explode('.',$date);

    return $MESSAGES['projects']['times']['months'][$month-1].' '.$year;
}


$statuses = array(
    'done' => 'fa-check-circle-o',
    'working' => 'fa-circle-o',
    //'working' => 'fa-spinner',
    'stopped' => 'fa-stop-circle-o',
    'paused' => 'fa-pause-circle-o'
);

//------------------------------------------------------------------------------------

$projects_asoc = Nette\Neon\Neon::decode(file_get_contents('data/projects.neon'));

$projects=array();
foreach($projects_asoc as $name=>&$project){

    $project['key']=$name;

    $project['_start']=$project['start'];
    $project['_end']=$project['end'];

    $project['start']=date2time($project['start']);
    $project['end']=date2time($project['end']);


    if(isset($project['url'])){
        $target='_blank';

        if(substr($project['url'],0,4)!=='http'){
            $project['url']='http://'.$project['url'];
        }


        $project['url_']=str_replace(
            array('http://','https://'),
            '',
            $project['url']
        );

        $project['url_']=explode('/',$project['url_'],2);
        $project['url_']=$project['url_'][0];
        //$project['url_']=ucfirst($project['url_']);



    }else{

        unset($project['url']);

    }



    $projects[]=$project;
}

function sortProjects($a, $b) {

    /*$aa=$a['start'];
    if($a['end'])$aa=($aa+$a['end'])/2;

    $bb=$b['start'];
    if($b['end'])$bb=($bb+$b['end'])/2;*/

    $aa=$a['start'];
    $bb=$b['start'];


    if($aa==$bb){
        return 0;
    }elseif($aa<$bb){
        return 1;
    }elseif($aa>$bb){
        return -1;
    }

}
usort($projects, 'sortProjects');



?>