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

    /**
     * Generate an array of string dates between 2 dates
     *
     * @param string $start Start date
     * @param string $end End date
     * @param string $format Output format (Default: Y-m-d)
     *
     * @return array
     */
    function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        $array = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach($period as $date) { 
            $array[] = $date->format($format); 
        }

        return $array;
    }
	
	public function runDailySix(){
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
            );

            $this->generateMaps($arr);
            
    }

    public function runDailySixLateBloom(){
	    $arr = array(
		new SpringIndexLateBloomLayer(),
	    );

	    $this->generateMaps($arr);
    }

    public function runDailySixReturnInterval(){
        $arr = array(
            new SpringIndexLeafReturnIntervalLayer(),
            new SpringIndexBloomReturnIntervalLayer(),
            new SpringIndexLeafReturnIntervalLayer(new DateTime()),
            new SpringIndexBloomReturnIntervalLayer(new DateTime())
        );
        $this->generateMaps($arr);
    }

    public function runDailyAgdd(){
        
        $arr = array(
            new Agdd32Layer(),
            new AgddAnomaly32Layer(),
        );

        $this->generateMaps($arr);
        
    }

    // public function forTheresa(){
        
    //     $arr = array(
    //         /*
    //         * For these pest layers, the parameter you can set to true
    //         * indicates if it's for current day or 6 day forecast. Since
    //         * we want both, we need to create two instances of each layer.
    //         */
                
    //         new WinterMothLayer()
    //     );

    //     $this->generateMaps($arr);
    // }
    //
    public function runALBv2() {
	    $arr = array(new AsianLonghornedBeetleLayerV2(),
		    new AsianLonghornedBeetleLayerV2(true)
	    );

	    $this->generateMaps($arr);
    }
    
    public function runDailyPestMaps(){
        
        $arr = array(
            /*
            * For these pest layers, the parameter you can set to true
            * indicates if it's for current day or 6 day forecast. Since
            * we want both, we need to create two instances of each layer.
            */
                
            new AppleMaggotLayer(),
            new AppleMaggotLayer(true),
            //new AsianLonghornedBeetleLayer(),
            //new AsianLonghornedBeetleLayer(true),
            new BagwormLayer(),
            new BagwormLayer(true),
            new BronzeBirchBorerLayer(),
            new BronzeBirchBorerLayer(true),
            new EasternTentCaterpillarLayer(),
	    new EasternTentCaterpillarLayer(true),
            //new EmeraldAshBorerLayer(),
            //new EmeraldAshBorerLayer(true), 
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

    public function runDailyWinterWheat(){
        
        $arr = array(
            new WinterWheatLayer(false),
            new WinterWheatLayer(true)
        );

        $this->generateMaps($arr);
    }

    public function runDailyRedBrome(){
        
        $arr = array(
            new RedBromeFloweringLayer(false),
            new RedBromeFloweringLayer(true),
            new RedBromeSenscenceLayer(false),
            new RedBromeSenscenceLayer(true)
        );

        $this->generateMaps($arr);
    }

     public function runDailyEAB(){

        $arr = array(
            new EmeraldAshBorerAdultLayer(false),
            new EmeraldAshBorerEggHatchLayer(false),
        );

        $this->generateMaps($arr);
    }

    public function runDailySLF(){

        $arr = array(
            new SpottedLanternFlyAdultLayer(false),
            new SpottedLanternFlyEggHatchLayer(false),
        );

        $this->generateMaps($arr);
    }

    public function runDailyJPB(){

        $arr = array(
            new JapaneseBeetleAdultLayer(false),
            new JapaneseBeetleEggHatchLayer(false),
        );

        $this->generateMaps($arr);
    }
    
    public function runWeeklyAnomaly(){
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

    public function runInca() {
        $arr = array(
            new IncaMidgupMedianLayer(),
            new IncaMidgdownMedianLayer(),
            new IncaEviAreaMedianLayer(),
            new IncaMidgupMadLayer(),
            new IncaMidgdownMadLayer(),
            new IncaEviAreaMadLayer(),
            new IncaMidgupTsslopeLayer(),
            new IncaMidgdownTsslopeLayer(),
            new IncaEviAreaTsslopeLayer()
        );
        $this->generateMaps($arr);
    }

    public function runDailyBuffelgrassAnimation() {
        $layers = [];
        $current_year = date("Y");
        $startDate = date("Y-m-d", strtotime("6 months ago"));
        $endDate = date("Y-m-d", strtotime("now"));
        $bgDates = $this->getDatesFromRange($current_year . '-01-01', $endDate);
        // $bgDates = $this->getDatesFromRange($startDate, $endDate);
        foreach($bgDates as $bgDate) {
            array_push($layers, new BuffelgrassLayer(new DateTime($bgDate)));
        }
        $this->generateMaps($layers);
        $currentDayImage = OUTPUT_PATH . "buffelgrass-" . date("Y-m-d", strtotime("now")) . ".png";
        $previousWeekImage = OUTPUT_PATH . "buffelgrass-" . date("Y-m-d", strtotime("7 days ago")) . ".png";
        copy($currentDayImage, OUTPUT_PATH . "current-day-forecast-buffelgrass.png");
        copy($previousWeekImage, OUTPUT_PATH . "previous-week-forecast-buffelgrass.png");
        //exec('convert -limit memory 256MiB -delay 25 -loop 0 -layers optimize ' . OUTPUT_PATH . 'buffelgrass-' . $current_year . '*.png ' . OUTPUT_PATH . 'buffelgrass.gif');
    }

    public function runDailySixAnomalyAnimation() {
        $layers = [];
        $startDate = date("Y-m-d", strtotime("15 days ago"));
        $endDate = date("Y-m-d", strtotime("now"));
        // $sixDates = $this->getDatesFromRange('2019-01-01', '2019-03-01');
        $sixDates = $this->getDatesFromRange('2025-01-01', $endDate);
        foreach($sixDates as $sixDate) {
            // array_push($layers, new SpringIndexLeafLayer(new DateTime($sixDate)));
            array_push($layers, new SpringIndexLeafAnomalyLayer(new DateTime($sixDate)));
            array_push($layers, new SpringIndexBloomAnomalyLayer(new DateTime($sixDate)));
        }
        $this->generateMaps($layers);
        $current_year = date("Y");
        exec('convert -limit memory 256MiB -delay 25 -loop 0 -layers optimize ' . OUTPUT_PATH . 'six-leaf-index-anomaly-' . $current_year . '*.png ' . OUTPUT_PATH . 'six-leaf-index-daily-anomaly-' . $current_year . '.gif');
        exec('convert -limit memory 256MiB -delay 25 -loop 0 -layers optimize ' . OUTPUT_PATH . 'six-bloom-index-anomaly-' . $current_year . '*.png ' . OUTPUT_PATH . 'six-bloom-index-daily-anomaly-' . $current_year . '.gif');
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


