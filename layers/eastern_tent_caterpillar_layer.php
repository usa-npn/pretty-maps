<?php

require_once('pest_layer.php');


class EasternTentCaterpillarLayer extends PestLayer{
	
	
	
    public function __construct($long_forecast=false){
        $title = "Eastern Tent Caterpillar Forecast";
        
        $legend_width = 350;
        $legend_height= 159;
        
        $legend_x_start = 1145;
        $legend_y_start = 610;
        
        $output_path = "eastern-tent-caterpillar";        
        $curl_url = "https://" . DOMAIN . "/v0/agdd/pestMap?species=Eastern%20Tent%20Caterpillar&preserveExtent=true";

        
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast);
        $this->subtitle = "Base: 50°F, Start: Mar 1";
        $this->legend_path = $this->base_legend_path . "legend-eastern-tent-caterpillar" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-eastern-tent-caterpillar.png";   
 
    }

}