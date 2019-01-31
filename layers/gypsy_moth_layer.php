<?php

require_once('pest_layer.php');


class GypsyMothLayer extends PestLayer{
	
	
	
    public function __construct($long_forecast=false){
        $title = "Gypsy Moth Forecast";
        
        $legend_width = 350;
        $legend_height= 136;
        
        $legend_x_start = 1145;
        $legend_y_start = 610;
        
        $output_path = "gypsy-moth";        
        $curl_url = "https://" . DOMAIN . "/v0/agdd/pestMap?species=Gypsy%20Moth&preserveExtent=true";

        
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast);
        $this->subtitle = "Base: 37.4°F, Upper: 104°F, Start: Jan 1";
        $this->legend_path = $this->base_legend_path . "legend-gypsy-moth" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-gypsy-moth.png";   
 
    }

}