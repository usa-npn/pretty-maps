<?php

require_once('basic_layer.php');

class SpringIndexBloomReturnIntervalLayer extends ReturnIntervalLayer{
	
	
	public function __construct($date=null){
            $output_path = null;
            $title = null;
            if($date == null){
                $date = new DateTime();
                $output_path = "six-bloom-return-interval.png";
                $title = "Spring Bloom Index Return Interval, " . date('F j, Y');
            }else{
                $output_path = "six-bloom-return-interval-" . $date->format("Y") . ".png";
                $title = "Spring Bloom Index Return Interval, " . $date->format("Y");
            }
            
            $legend_width = 200;
            $legend_height= 368; //101
        
            $legend_x_start = 1275;
            $legend_y_start = 355; //610
            
            //$output_path = 'six-leaf-index.png';
            $curl_url = "http://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=si-x:bloom_return_interval&width=1500&height=800&format=image/png&transparent=true";

            parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path,$curl_url);
            
            $this->legend_path = $this->base_legend_path . "legend-return-interval" . $this->extension;
            $this->overlay_path = $this->base_overlay_path . "current-spring-index-return-interval-bloom.png";
	}
}