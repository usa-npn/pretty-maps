<?php

require_once('pest_layer.php');


class LilacBorerLayer extends PestLayer{
	
	
	
    public function __construct($long_forecast=false){
        $title = "Lilac Borer Forecast";
        
        $legend_width = 342;
        $legend_height= 91;
        
        $legend_x_start = 1120;
        $legend_y_start = 675;
        
        $output_path = "lilac-borer";        
        $curl_url = "https://" . DOMAIN . "/v0/agdd/pestMap?species=Lilac%20Borer&preserveExtent=true";

        
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast);
        $this->subtitle = "Window for Managing Adults";
        $this->legend_path = $this->base_legend_path . "legend-lilac-borer" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-lilac-borer.png";   
 
    }

}