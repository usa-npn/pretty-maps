<?php

require_once('basic_layer.php');


class WinterWheatLayer extends BasicLayer{
	
	
	
    public function __construct($long_forecast=false){
        $today = new DateTime();
        $date = $today;

        if($long_forecast){
            $output_path = "winter-wheat-six-day.png";
            $plus_six = $today->add(new DateInterval('P6D'));
            $date = $plus_six;
        }else{
            $output_path = "winter-wheat-current-day.png";
        }

        $title = "Winter Wheat Development Forecast, " . $date->format("Y-m-d");
        
        $legend_width = 325;#308;
        $legend_height= 275;
        
        $legend_x_start = 1170;
        $legend_y_start = 522;
        
        $curl_url = "http://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&width=1500&height=800&srs=EPSG:3857&layers=gdd:winter_wheat&time="  . $date->format("Y-m-d") . "&format=image/png&transparent=true";     

        
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url);
        $this->subtitle = "Base: 50°F, Start: Jan 1";
        $this->legend_path = $this->base_legend_path . "legend-winter-wheat" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-winter-wheat.png";   
 
    }

    protected function drawUSGSLogo($im){
        $usgs_logo = imagecreatefrompng($this->usda_logo_path);
        $usgs_logo_x_offset = 1405;
        $usgs_logo_y_offset = 445;
        $dst_usgs_logo_width = 93;
        $dst_usgs_logo_height = 93;
        $src_usgs_logo_width = 93;
        $src_usgs_logo_height = 93;
        imagecopyresized($im, $usgs_logo, $usgs_logo_x_offset, 
                    $usgs_logo_y_offset, 0, 0, $dst_usgs_logo_width, $dst_usgs_logo_height, $src_usgs_logo_width, $src_usgs_logo_height);        
        imagedestroy($usgs_logo);
    
    }
        
    protected function drawUALogo($im){
        $ua_logo = imagecreatefrompng($this->ua_logo_path);
        $ua_logo_x_offset = 1335;
        $ua_logo_y_offset = 465;
        $dst_ua_logo_width = 60;
        $dst_ua_logo_height = 55;
        $src_ua_logo_width = 60;
        $src_ua_logo_height = 55;
        imagecopyresized($im, $ua_logo, $ua_logo_x_offset, 
                    $ua_logo_y_offset, 0, 0, $dst_ua_logo_width, $dst_ua_logo_height, $src_ua_logo_width, $src_ua_logo_height);        
        imagedestroy($ua_logo);
    }

    // protected function drawSubTitleText($im) {
    //     $title_x_start = 25;
    //     $title_y_start = 723;
    //     $subtitle_font_size = 16;
    //     imagettftext($im, $subtitle_font_size, 0, $title_x_start, $title_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->subtitle);       
    // }

    protected function drawNPNURL($im) {
        $url_x_start = 25;
        $url_y_start = 750;
        $url_font_size = 12;
        imagettftext($im, $url_font_size, 0, $url_x_start, $url_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->url_string);        
    }

    protected function drawGeneratedDateText($im){
        $generated_on_x_start = 25;
        $generated_on_y_start = 737;
        $generated_on_font_size = 12;
        imagettftext($im, $generated_on_font_size, 0, $generated_on_x_start, $generated_on_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->generated_on_string);
    }

}