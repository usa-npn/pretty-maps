<?php

require_once('map_maker.php');


$maker = new MapMaker(false);

//$maker->runSmoothAnimations();

// $maker->runYearlySix();

$maker->runDaily();

if(date('D', time()) === 'Mon'){
    $maker->runWeekly();
}

if($maker->shouldRunOnce()){
    $maker->runOnce();
}