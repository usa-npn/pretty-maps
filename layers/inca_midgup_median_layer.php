<?php

require_once('inca_layer.php');

class IncaMidgupMedianLayer extends IncaLayer{
	
	
	public function __construct(){
            $output_path = "midgup_median.png";
            $thumb_output_path = "midgup_median_thumb.png";
            $date = new DateTime();
                
            $title = "Mid Greenup Median (2001-2017)";
            
            $legend_width = 493;
            $legend_height=40;
            
            $legend_x_start = 1000;
            $legend_y_start = 760;
            
            $curl_url = "https://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=inca:midgup_median_nad83_02deg&width=1500&height=800&format=image/png&transparent=true";

            parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $thumb_output_path, $curl_url);
            
            $this->legend_path = $this->base_legend_path . "legend-midgup-median" . $this->extension;
            $this->overlay_path = $this->base_overlay_path . "overlay-midgup-median.png";
	}
}