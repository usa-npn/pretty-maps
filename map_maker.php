<?php
require_once 'constants.php';

/**
 * What this does is adds all layer class files in the 'layers' directory to
 * the required_once function, so as to load the class defs.
 */
foreach (scandir(dirname(__FILE__) . PATH_SEPERATOR . "layers") as $filename) {
    $path = dirname(__FILE__)  . PATH_SEPERATOR .  'layers'  . PATH_SEPERATOR .  $filename;
    if (is_file($path)) {
        require_once $path;
    }
}


class MapMaker{
	
	
	public function run(){
            /*
             * SpringIndexAnomalyLayer must sit in this array before SliderLayer.
             * SliderLayer depends on SpringIndexAnomalyLayer producing it's overlay for it.
             */
            $arr = array(
                new SpringIndexLayer(), 
                new SpringIndexAnomalyLayer(),
                new SliderLayer(),
                new Agdd32Layer(),
                new AgddAnomaly32Layer(),
                
                /*
                 * For these pest layers, the parameter you can set to true
                 * indicates if it's for current day or 6 day forecast. Since
                 * we want both, we need to create two instances of each layer.
                 */
                new EmeraldAshBorerLayer(),
                new EmeraldAshBorerLayer(true),                
                new AppleMaggotLayer(),
                new AppleMaggotLayer(true),
                new HwaLayer(),
                new HwaLayer(true),
                new LilacBorerLayer(),
                new LilacBorerLayer(true),
                new WinterMothLayer(),
                new WinterMothLayer(true)

            );
            
            foreach($arr as $layer){
		$layer->downloadBaseImage();
                $layer->buildImage();
            }
            
            
	}
}


