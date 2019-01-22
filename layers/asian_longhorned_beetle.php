<?php

require_once('pest_layer.php');


class AsianLonghornedBeetleLayer extends PestLayer{
	
	
	
    public function __construct($long_forecast=false){
        $title = "Asian Longhorned Beetle Forecast";
        
        $legend_width = 341;
        $legend_height= 92;
        
        $legend_x_start = 1155;
        $legend_y_start = 675;
        
        $output_path = "asian-longhorned-beetle";        
        $curl_url = "https://" . DOMAIN . "/v0/agdd/pestMap?species=Asian%20Longhorned%20Beetle&preserveExtent=true";

        
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast);
        $this->subtitle = "Window for Managing Adults";
        $this->legend_path = $this->base_legend_path . "legend-asian-longhorned-beetle" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-asian-longhorned-beetle.png";   
 
    }

}