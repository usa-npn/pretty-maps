<?php

require_once('abstract_layer.php');

/*
 * Parent class to any of the individual return interval layers.
 * accomidates custom legend / logo placement.
 */
class ReturnIntervalLayer extends BasicLayer{
	
    public function __construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $width=1500, $height=800, $x_shift=37, $y_shift=0, $background_path="assets/background", $attr_string="Based on NOAA NCEP RTMA and NDFD Products", $provisional = false){		
		parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path,$curl_url);
    }
    
    /**
     * Custom implementation to align logos correctly with ri legend
     */
    protected function drawUSGSLogo($im){
        $usgs_logo = imagecreatefrompng($this->usgs_logo_path);
        $usgs_logo_x_offset = 1325;
        $usgs_logo_y_offset = 740;
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
        $ua_logo_y_offset = 739;
        $dst_ua_logo_width = 60;
        $dst_ua_logo_height = 55;
        $src_ua_logo_width = 350;
        $src_ua_logo_height = 322;
        imagecopyresized($im, $ua_logo, $ua_logo_x_offset, 
                    $ua_logo_y_offset, 0, 0, $dst_ua_logo_width, $dst_ua_logo_height, $src_ua_logo_width, $src_ua_logo_height);        
        imagedestroy($ua_logo);
    }

}