<?php

require_once('pest_layer.php');


class HwaLayer extends PestLayer{
	
	
	
    public function __construct($long_forecast=false){
        $title = "Hemlock Woolly Adelgid Forecast";
        
        $legend_width = 410;
        $legend_height= 88;
        
        $legend_x_start = 1085;
        $legend_y_start = 675;
        
        $output_path = "hwa";        
        $curl_url = "https://" . DOMAIN . "/v0/agdd/pestMap?species=Hemlock%20Woolly%20Adelgid&preserveExtent=true";

        
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast);
        //This layer/species doesn't actually use a subtitle, so putting it empty here
        $this->subtitle = "";
        $this->legend_path = $this->base_legend_path . "legend-hwa" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-hwa.png";   
 
    }

}