<?php

require_once('pest_layer.php');


class EmeraldAshBorerAdultLayer extends PestLayer{
	
	
	
    public function __construct($long_forecast=false){
        $title = "Emerald Ash Borer Adult Forecast";
        
        $legend_width = 350;
        $legend_height= 184;
        
        $legend_x_start = 1145;
        $legend_y_start = 610;
        
        $output_path = "eab_adult";        
        //$curl_url = "https://" . DOMAIN . "/v0/agdd/pestMap?species=Emerald%20Ash%20Borer&preserveExtent=true";
        // $curl_url = "http://geoserver.usanpn.org/geoserver/gdd/wms?service=WMS&version=1.1.0&request=GetMap&layers=gdd%3Aeab_adult&bbox=-125.020833333%2C24.520833333%2C-66.520833333%2C49.395833332&width=768&height=330&ENV=doy:220&srs=EPSG%3A404000&format=application/openlayers"
        $curl_url = "http://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=gdd:eab_adult&width=1500&height=800&ENV=doy:220&time="  . date_format(new DateTime(), "Y-m-d") . "&format=image/png&transparent=true";

        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast);
        $this->subtitle = "Base: 50°F, Start: Jan 1";
        $this->legend_path = $this->base_legend_path . "legend-eab" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-eab.png";   
 
    }

}