<?php

require_once('basic_layer.php');

class BuffelgrassLayer extends BasicLayer{
	
	
	public function __construct($date=null){
            $output_path = null;
            if($date == null){
                $date = new DateTime();
                $output_path = "buffelgrass.png";
            }else{
                $output_path = "buffelgrass-" . $date->format("Y-m-d") . ".png";
            }

            $title = "Bufflegrass Green-up Forecast, " . $date->format("Y-m-d");
            
            $legend_width = 420;
            $legend_height=95;
            
            $legend_x_start = 1075;
            $legend_y_start = 570;
            
            // conus $curl_url = "http://geoserver-dev.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=precipitation:buffelgrass_prism&width=1500&height=800&time="  . $date->format("Y-m-d") . "&format=image/png&transparent=true";
            $curl_url = "http://geoserver-dev.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-12781315,3675016,-12139802,4439700&srs=EPSG:3857&layers=precipitation:buffelgrass_prism&width=526&height=626&time="  . $date->format("Y-m-d") . "&format=image/png&transparent=true";

            parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path,$curl_url, 1500, 800, 537, 115, "assets/arizona-background", "Based on data from PRISM Climate Group, Oregon State University, http://prism.oregonstate.edu, Results provisional", false);
            
            $this->legend_path = $this->base_legend_path . "legend-buffelgrass" . $this->extension;
            $this->overlay_path = $this->base_overlay_path . "overlay-buffelgrass.png";

    }
    
    /**
     * Pest maps have subtitle and date generated, so we have to make the NPN logo
     * and all other text sit higher, so it doesn't get cramped into the lower
     * left hand corner.
     */
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
        
    
        protected function drawGeneratedDateText($im){
        $generated_on_x_start = 25;
        $generated_on_y_start = 723;
        $generated_on_font_size = 12;
        imagettftext($im, $generated_on_font_size, 0, $generated_on_x_start, $generated_on_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->generated_on_string);
        }
    
    
        protected function drawNPNURL($im) {
            $url_x_start = 25;
            $url_y_start = 740;
            $url_font_size = 12;
            imagettftext($im, $url_font_size, 0, $url_x_start, $url_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->url_string);        
        }
        
        protected function drawTitleText($im) {
            $title_x_start = 25;
            $title_y_start = 700;
            $title_font_size = 18;
            imagettftext($im, $title_font_size, 0, $title_x_start, $title_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->title);
        }    
        
        // protected function drawSubTitleText($im) {
        //     $title_x_start = 25;
        //     $title_y_start = 723;
        //     $subtitle_font_size = 16;
        //     imagettftext($im, $subtitle_font_size, 0, $title_x_start, $title_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->subtitle);       
        // }

}