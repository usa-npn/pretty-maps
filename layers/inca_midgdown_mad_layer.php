<?php

require_once('inca_layer.php');

class IncaMidgdownMadLayer extends IncaLayer{
	
	
	public function __construct(){
            $output_path = "midgdown_mad.png";
            $date = new DateTime();
                
            $title = "Mid Greendown MAD (2001-2017)";
            
            $legend_width = 455;
            $legend_height=40;
            
            $legend_x_start = 1000;
            $legend_y_start = 760;
            
            $curl_url = "https://geoserver-dev.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=inca:midgdown_mad_nad83_02deg&width=1500&height=800&format=image/png&transparent=true";

            parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path,$curl_url);
            
            $this->legend_path = $this->base_legend_path . "legend-midgdown-mad" . $this->extension;
            $this->overlay_path = $this->base_overlay_path . "overlay-midgdown-mad.png";
	}
}