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
    
        private $run_once;
	
        public function __construct($run_once=false){
            $this->run_once = $run_once;
        }
        
        public function shouldRunOnce(){
            return $this->run_once;
        }
	
	public function runDaily(){
            /*
             * SpringIndexAnomalyLayer must sit in this array before SliderLayer.
             * SliderLayer depends on SpringIndexAnomalyLayer producing it's overlay for it.
             */
            
            $arr = array(
                new SpringIndexLeafLayer(),
                new SpringIndexBloomLayer(),
                new SpringIndexLeafAnomalyLayer(),
                new SpringIndexBloomAnomalyLayer(),
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

            
            
            $this->generateMaps($arr);
            
            
	}
        
        public function runWeekly(){
            $arr = array(
                new SpringIndexLeafAnomalyLayer(new DateTime()),
                new SpringIndexBloomAnomalyLayer(new DateTime()),
                new AgddAnomaly32Layer(new DateTime())
            );
            
            $this->generateMaps($arr);
        }
        
        public function runOnce(){
            $arr = array(
                new SpringIndexLeafAnomalyLayer(new DateTime('2018-01-01')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-01')),
                new AgddAnomaly32Layer(new DateTime('2018-01-01')),
                
                new SpringIndexLeafAnomalyLayer(new DateTime('2018-01-08')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-08')),
                new AgddAnomaly32Layer(new DateTime('2018-01-08')),
                
                new SpringIndexLeafAnomalyLayer(new DateTime('2018-01-15')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-15')),
                new AgddAnomaly32Layer(new DateTime('2018-01-15')),            
                
                new SpringIndexLeafAnomalyLayer(new DateTime('2018-01-22')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-22')),
                new AgddAnomaly32Layer(new DateTime('2018-01-22')),
                
                new SpringIndexLeafAnomalyLayer(new DateTime('2018-01-29')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-29')),
                new AgddAnomaly32Layer(new DateTime('2018-01-29')),

                new SpringIndexLeafAnomalyLayer(new DateTime('2018-02-05')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-05')),
                new AgddAnomaly32Layer(new DateTime('2018-02-05')),
                
                new SpringIndexLeafAnomalyLayer(new DateTime('2018-02-12')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-12')),
                new AgddAnomaly32Layer(new DateTime('2018-02-12')),

                new SpringIndexLeafAnomalyLayer(new DateTime('2018-02-19')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-19')),
                new AgddAnomaly32Layer(new DateTime('2018-02-19')),
                
                new SpringIndexLeafAnomalyLayer(new DateTime('2018-02-26')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-26')),
                new AgddAnomaly32Layer(new DateTime('2018-02-26'))             
                
            );
            
            $this->generateMaps($arr);
        }
        
        private function generateMaps($arr){
            foreach($arr as $layer){
		$layer->downloadBaseImage();
                $layer->buildImage();
            }            
        }
}


