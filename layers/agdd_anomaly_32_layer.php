<?php

require_once('basic_layer.php');

class AgddAnomaly32Layer extends BasicLayer{
	
	
	public function __construct($date=null){
            $output_path = null;
            if($date == null){
                $date = new DateTime();
                $output_path = "agdd-anomaly-32f.png";
            }else{
                $output_path = "agdd-anomaly-32f-" . $date->format("Y-m-d") . ".png";
            }            
            
            $title = "Accumulated Growing Degree Days Anomaly, 32F Base Temp, " . $date->format('F j, Y');
            
            $legend_width = 782;
            $legend_height=40;
            
            $legend_x_start = 700;
            $legend_y_start = 760;
            
            $curl_url = "http://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=gdd:agdd_anomaly&width=1500&height=800&time="  . $date->format("Y-m-d") . "&format=image/png&transparent=true";
            parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url);
            
            $this->legend_path = $this->base_legend_path . "legend-agdd-anomaly" . $this->extension;
            $this->overlay_path = $this->base_overlay_path . "overlay-agdd-anomaly-32.png";
	}
}
