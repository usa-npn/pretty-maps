<?php

require_once('pest_layer.php');


class BagwormLayer extends PestLayer{
	
	
	
    public function __construct($long_forecast=false){
        $title = "Bagworm Forecast";
        
        $legend_width = 350;
        $legend_height= 135;
        
        $legend_x_start = 1145;
        $legend_y_start = 610;
        
        $output_path = "bagworm";        
        $curl_url = "https://" . DOMAIN . "/v0/agdd/pestMap?species=Bagworm&preserveExtent=true";

        
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast);
        $this->subtitle = "Base: 50°F, Start: Mar 1";
        $this->legend_path = $this->base_legend_path . "legend-bagworm" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-bagworm.png";   
 
    }

}