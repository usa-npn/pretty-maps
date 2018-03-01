<?php

require_once('basic_layer.php');

class SpringIndexLeafAnomalyLayer extends BasicLayer{
	
	
	public function __construct($date=null){
            $output_path = null;
            if($date == null){
                $date = new DateTime();
                $output_path = "six-leaf-index-anomaly.png";
            }else{
                $output_path = "six-leaf-index-anomaly-" . $date->format("Y-m-d") . ".png";
            }
            $title = "Spring Leaf Index Anomaly, " . $date->format('F j, Y');            
            
            $legend_width = 784;
            $legend_height=40;
            
            $legend_x_start = 700;
            $legend_y_start = 760;
            
            
            $curl_url = "http://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=si-x:leaf_anomaly&width=1500&height=800&time=" . $date->format("Y-m-d") . "&format=image/png&transparent=true";
            
            parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path,$curl_url);
            
            $this->legend_path = $this->base_legend_path . "legend-anomaly" . $this->extension;
            $this->overlay_path = $this->base_overlay_path . "current-spring-index-leaf-anomaly.png";
	}
        
        protected function postProcess($im) {
            
        }

        /*
         * What this does is copy a version of the SI-x anomaly layer without
         * any of the logos/text to a separate output file for use by SliderLayer,
         * later in the script's execution.
         */
        protected function preMarkup($im) {
            imagepng ($im, SliderLayer::getBackgroundPath(), 9);
        }
        
}