<?php

require_once('basic_layer.php');


class EmeraldAshBorerAdultLayer extends BasicLayer{
	
    public function __construct($long_forecast=false){
        $title = "Emerald Ash Borer Adult Forecast";
        
        $legend_width = 350;
        $legend_height= 407;
        
        $legend_x_start = 1145;
        $legend_y_start = 610;
        
        $output_path = "eab_adult.png";        
        $curl_url = "http://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=gdd:eab_adult&width=1500&height=800&ENV=doy:".(date('z')+1)."&time="  . date_format(new DateTime(), "Y-m-d") . "&format=image/png&transparent=true";

        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url);
        $this->subtitle = "Base: 50°F, Start: Jan 1";
        $this->legend_path = $this->base_legend_path . "legend-eab-adult" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-eab-adult.png";   
 
    }

    protected function drawUSGSLogo($im){
        $usgs_logo = imagecreatefrompng($this->usgs_logo_path);
        $usgs_logo_x_offset = 1325;
        $usgs_logo_y_offset = 550;
        $dst_usgs_logo_width = 150;
        $dst_usgs_logo_height = 55;
        $src_usgs_logo_width = 800;
        $src_usgs_logo_height = 295;
        imagecopyresized($im, $usgs_logo, $usgs_logo_x_offset, 
                    $usgs_logo_y_offset, 0, 0, $dst_usgs_logo_width, $dst_usgs_logo_height, $src_usgs_logo_width, $src_usgs_logo_height);        
        imagedestroy($usgs_logo);
    
    }
        
    protected function drawUALogo($im){
        $ua_logo = imagecreatefrompng($this->ua_logo_path);
        $ua_logo_x_offset = 1265;
        $ua_logo_y_offset = 549;
        $dst_ua_logo_width = 60;
        $dst_ua_logo_height = 55;
        $src_ua_logo_width = 60;
        $src_ua_logo_height = 55;
        imagecopyresized($im, $ua_logo, $ua_logo_x_offset, 
                    $ua_logo_y_offset, 0, 0, $dst_ua_logo_width, $dst_ua_logo_height, $src_ua_logo_width, $src_ua_logo_height);        
        imagedestroy($ua_logo);
    }

    protected function drawSubTitleText($im) {
        $title_x_start = 25;
        $title_y_start = 723;
        $subtitle_font_size = 16;
        imagettftext($im, $subtitle_font_size, 0, $title_x_start, $title_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->subtitle);       
    }

    protected function drawNPNURL($im) {
        $url_x_start = 25;
        $url_y_start = 760;
        $url_font_size = 12;
        imagettftext($im, $url_font_size, 0, $url_x_start, $url_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->url_string);        
    }

    protected function drawGeneratedDateText($im){
        $generated_on_x_start = 25;
        $generated_on_y_start = 743;
        $generated_on_font_size = 12;
        imagettftext($im, $generated_on_font_size, 0, $generated_on_x_start, $generated_on_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->generated_on_string);
        }

    protected function drawTitleText($im) {
        $title_x_start = 25;
        $title_y_start = 700;
        $title_font_size = 18;
        imagettftext($im, $title_font_size, 0, $title_x_start, $title_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->title);
    } 

    protected function drawNPNLogo($im){
        $npn_logo = imagecreatefrompng($this->npn_logo_path);
        $npn_logo_x_offset = 25;
        $npn_logo_y_offset = 580;
        $dst_npn_logo_width = 322;//325;
        $dst_npn_logo_height = 100;
        $src_npn_logo_width = 322;//3000;
        $src_npn_logo_height = 100;//914;
    
        imagecopyresized($im, $npn_logo, $npn_logo_x_offset, $npn_logo_y_offset, 0, 0, $dst_npn_logo_width, $dst_npn_logo_height, $src_npn_logo_width, $src_npn_logo_height);
        imagedestroy($npn_logo);        
    } 

}