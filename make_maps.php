<?php
// date_default_timezone_set('America/Phoenix');
require_once('map_maker.php');


$maker = new MapMaker(false);

// $maker->runYearlySix();

// if($maker->shouldRunOnce()){
//     $maker->runOnce();
// }

// only needed to be generated once
// can uncomment if need to regen
//$maker->runInca();

if(date('D', time()) === 'Mon'){
    $maker->runWeeklyAnomaly();
}


$maker->runDailyAgdd();

$maker->runDailySix();

$maker->runDailySixAnomalyAnimation();

$maker->runDailyBuffelgrassAnimation();
 
$maker->runALBv2();

$maker->runDailyPestMaps();
 
$maker->runDailyWinterWheat();
 
$maker->runDailySixReturnInterval();
 
$maker->runDailyEAB();

$maker->runDailyRedBrome();
 
$maker->runDailySLF();

$maker->runDailyJPB();
 
//$maker->runDailySixLateBloom();
