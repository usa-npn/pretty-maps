<?php

require_once('basic_layer.php');


class JapaneseBeetleEggHatchLayer extends BasicLayer{
	
    public function __construct($long_forecast=false){
        $title = "Japanese Beetle Egg Hatch Forecast";
        
        $legend_width = 260;
        $legend_height= 303;
        
        $legend_x_start = 1230;
        $legend_y_start = 490;
        
        $output_path = "japanese_beetle_egg_hatch.png";        
        $curl_url = "http://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=gdd:japanese_beetle_egg_hatch&width=1500&height=800&ENV=doy:".(date('z')+1)."&time="  . date_format(new DateTime(), "Y-m-d") . "&format=image/png&transparent=true";

        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, 1500, 800, 37, 0, "assets/background", "Based on PRISM and NMME Products", false);
        $this->subtitle = "Threshold: 1,543 GDD(F), Base: 50F, Start: Jan 1";
        $this->legend_path = $this->base_legend_path . "legend-jpb-adult" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "overlay-jpb-adult.png";   
 
    }

    protected function drawUSGSLogo($im){
    }

    protected function drawOSULogo($im){
        $osu_logo = imagecreatefrompng($this->osu_logo_path);
        $osu_logo_x_offset = 1395;
        $osu_logo_y_offset = 400;
        $dst_osu_logo_width = 85;
        $dst_osu_logo_height = 90;
        $src_osu_logo_width = 85;
        $src_osu_logo_height = 90;
        imagecopyresized($im, $osu_logo, $osu_logo_x_offset,
                    $osu_logo_y_offset, 0, 0, $dst_osu_logo_width, $dst_osu_logo_height, $src_osu_logo_width, $src_osu_logo_height);
        imagedestroy($osu_logo);

    }

    protected function drawUSDANIFALogo($im){
        $usdanifa_logo = imagecreatefrompng($this->usda_nifa_logo_path);
        $usdanifa_logo_x_offset = 1335;
        $usdanifa_logo_y_offset = 410;
        $dst_usdanifa_logo_width = 55;
        $dst_usdanifa_logo_height = 55;
        $src_usdanifa_logo_width = 55;
        $src_usdanifa_logo_height = 55;
        imagecopyresized($im, $usdanifa_logo, $usdanifa_logo_x_offset,
                    $usdanifa_logo_y_offset, 0, 0, $dst_usdanifa_logo_width, $dst_usdanifa_logo_height, $src_usdanifa_logo_width, $src_usdanifa_logo_height);
        imagedestroy($usdanifa_logo);

    }

    protected function drawUALogo($im){
        $ua_logo = imagecreatefrompng($this->ua_logo_path);
        $ua_logo_x_offset = 1265;
        $ua_logo_y_offset = 410;
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