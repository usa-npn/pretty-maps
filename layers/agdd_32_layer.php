<?php

require_once('basic_layer.php');

class Agdd32Layer extends BasicLayer{
	
	
	public function __construct(){
            $title = "Accumulated Growing Degree Days, 32F Base Temp, " . date('F j, Y');
            
            $legend_width = 567;
            $legend_height=40;
            
            $legend_x_start = 900;
            $legend_y_start = 760;
            
            $output_path = 'agdd-32f.png';
            $curl_url = "http://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=gdd:agdd&width=1500&height=800&time="  . date_format(new DateTime(), "Y-m-d") . "&format=image/png&transparent=true";

            parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path,$curl_url);
            
            $this->legend_path = $this->base_legend_path . "legend-agdd" . $this->extension;
            $this->overlay_path = $this->base_overlay_path . "overlay-agdd-32.png";
	}
}