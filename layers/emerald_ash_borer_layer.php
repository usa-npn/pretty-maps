<?php

require_once('pest_layer.php');


class EmeraldAshBorerLayer extends PestLayer{
	
	
	
    public function __construct($long_forecast=false){
        $title = "Emerald Ash Borer Forecast";
        
        $legend_width = 350;
        $legend_height= 184;
        
        $legend_x_start = 1145;
        $legend_y_start = 610;
        
        $output_path = "eab";        
        $curl_url = "https://" . DOMAIN . "/v0/agdd/pestMap?species=Emerald%20Ash%20Borer&preserveExtent=true";

        
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast);
        $this->subtitle = "Base: 50°F, Start: Jan 1";
        $this->legend_path = $this->base_legend_path . "legend-eab" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-eab.png";   
 
    }

}