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
                new SliderLayer(),
		        new SpringIndexBloomAnomalyLayer(),
                new Agdd32Layer(),
                new AgddAnomaly32Layer(),
                
                /*
                 * For these pest layers, the parameter you can set to true
                 * indicates if it's for current day or 6 day forecast. Since
                 * we want both, we need to create two instances of each layer.
                 */
            
                            
                new AppleMaggotLayer(),
                new AppleMaggotLayer(true),
                new AsianLonghornedBeetleLayer(),
                new AsianLonghornedBeetleLayer(true),
                new BagwormLayer(),
                new BagwormLayer(true),
                new BronzeBirchBorerLayer(),
                new BronzeBirchBorerLayer(true),
                new EasternTentCaterpillarLayer(),
                new EasternTentCaterpillarLayer(true),
                new EmeraldAshBorerLayer(),
                new EmeraldAshBorerLayer(true), 
                new GypsyMothLayer(),
                new GypsyMothLayer(true),   
                new HwaLayer(),
                new HwaLayer(true),
                new MagnoliaScaleLayer(),
                new MagnoliaScaleLayer(true),
                new LilacBorerLayer(),
                new LilacBorerLayer(true),
                new PineNeedleScaleLayer(),
                new PineNeedleScaleLayer(true),
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

        public function runSmoothAnimations() {
            $arr = array(
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-01')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-02')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-03')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-04')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-05')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-06')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-07')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-08')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-09')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-10')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-11')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-12')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-13')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-14')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-15')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-16')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-17')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-18')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-19')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-20')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-21')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-22')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-23')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-24')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-25')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-26')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-27')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-28')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-29')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-30')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-01-31')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-01')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-02')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-03')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-04')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-05')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-06')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-07')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-08')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-09')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-10')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-11')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-12')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-13')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-14')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-15')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-16')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-17')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-18')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-19')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-20')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-21')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-22')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-23')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-24')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-25')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-26')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-27')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-02-28')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-01')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-02')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-03')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-04')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-05')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-06')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-07')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-08')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-09')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-10')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-11')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-12')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-13')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-14')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-15')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-16')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-17')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-18')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-19')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-20')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-21')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-22')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-23')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-24')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-25')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-26')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-27')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-28')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-29')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-30')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-03-31')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-01')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-02')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-03')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-04')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-05')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-06')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-07')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-08')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-09')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-10')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-11')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-12')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-13')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-14')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-15')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-16')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-17')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-18')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-19')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-20')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-21')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-22')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-23')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-24')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-25')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-26')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-27')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-28')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-29')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-04-30')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-01')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-02')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-03')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-04')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-05')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-06')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-07')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-08')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-09')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-10')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-11')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-12')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-13')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-14')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-15')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-16')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-17')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-18')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-19')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-20')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-21')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-22')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-23')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-24')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-25')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-26')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-27')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-28')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-29')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-30')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-05-31')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-01')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-02')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-03')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-04')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-05')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-06')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-07')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-08')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-09')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-10')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-11')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-12')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-13')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-14')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-15')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-16')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-17')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-18')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-19')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-20')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-21')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-22')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-23')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-24')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-25')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-26')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-27')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-28')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-29')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-06-30')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-07-01')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-07-02')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-07-03')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-07-04')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-07-05')),
                new SpringIndexBloomAnomalyLayer(new DateTime('2018-07-06'))           
            );
            
            $this->generateMaps($arr);
        }

        public function runYearlySix(){
            $arr = array(
                new SpringIndexLeafLayerPrism(new DateTime('1981-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1982-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1983-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1984-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1985-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1986-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1987-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1988-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1989-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1990-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1991-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1992-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1993-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1994-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1995-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1996-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1997-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1998-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('1999-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2000-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2001-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2002-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2003-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2004-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2005-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2006-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2007-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2008-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2009-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2010-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2011-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2012-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2013-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2014-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2015-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2016-01-01')),
                new SpringIndexLeafLayerPrism(new DateTime('2017-01-01'))
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


