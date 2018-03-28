<?php

require_once('pest_layer.php');


class AppleMaggotLayer extends PestLayer{
	
	
	
    public function __construct($long_forecast=false){
        $title = "Apple Maggot Forecast";
        
        $legend_width = 340;
        $legend_height= 90;
        
        $legend_x_start = 1155;
        $legend_y_start = 675;
        
        $output_path = "apple-maggot";        
        $curl_url = "https://" . DOMAIN . "/v0/agdd/pestMap?species=Apple%20Maggot&preserveExtent=true";

        
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast);
        $this->subtitle = "Window for Managing Adults";
        $this->legend_path = $this->base_legend_path . "legend-apple-maggot" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-apple-maggot.png";   
 
    }

}