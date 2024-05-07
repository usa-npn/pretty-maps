<?php

require_once('pest_layer.php');


class AsianLonghornedBeetleLayerV2 extends PestLayer{
	
	
	
    public function __construct($long_forecast=false){
        $title = "Asian Longhorned Beetle Forecast";
        
        $legend_width = 350;
        $legend_height= 127;
        
        $legend_x_start = 1145;
        $legend_y_start = 610;
        
        $output_path = "asian-longhorned-beetle-v2";        
        $curl_url = "http://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=gdd:asian_longhorned_beetle,gdd:states&CQL_FILTER=INCLUDE;NAME%20IN%20(%27Ohio%27,%27Pennsylvania%27,%27New%20York%27,%27Connecticut%27,%27Rhode%20Island%27,%27Massachusetts%27,%27South%20Carolina%27,%27Missippi%27)&styles=gdd:alb2,gdd:hatch&width=1500&height=800&time="  . date_format(new DateTime(), "Y-m-d") . "&format=image/png&transparent=true";

        
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast);
        $this->subtitle = "Base: 50°F, Upper: 86°F, Start: Jan 1";
        $this->legend_path = $this->base_legend_path . "legend-asian-longhorned-beetle" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-asian-longhorned-beetle.png";   
 
    }

}