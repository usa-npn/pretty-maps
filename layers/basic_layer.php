<?php

require_once('abstract_layer.php');

/**
 * This is the main class that does most of the work, and the parent class to
 * most of the children classes.
 */
class BasicLayer extends AbstractLayer{

    public function __construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $width=1500, $height=800, $x_shift=37, $y_shift=0, $background_path="assets/background", $attr_string="Based on NOAA NCEP RTMA and NDFD Products", $provisional = false){		
		parent::__construct($width, $height, $x_shift, $y_shift, $title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $background_path, $attr_string, $provisional);
    }
    
    function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
        // creating a cut resource 
        $cut = imagecreatetruecolor($src_w, $src_h); 

        // copying relevant section from background to the cut resource 
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 
         
        // copying relevant section from watermark to the cut resource 
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

        // insert cut resource to destination image 
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
    } 

        
    public function buildImage() {
        
        //Creates a black rectangle as the background/cnavas
	$im = imagecreatetruecolor($this->width, $this->height);
	$white = imagecolorallocate($im, 255, 255, 255);
	$black = imagecolorallocate($im, 0, 0, 0);
	imagefilledrectangle ($im, 0, 0, $this->width, $this->height, $white);        

        //Draw the Google Map screenshot background onto the image.
	$bg = imagecreatefrompng($this->background_path);
	imagecopyresampled($im, $bg, 0, 0, 0, 0, $this->width, $this->height, $this->width, $this->height);
	imagedestroy($bg);

        //Copy the overlay data ontop of the map background
        //Note that the last parameter in imagecopymerge controls opacity        
	$layer = imagecreatefrompng($this->overlay_path);
    $this->imagecopymerge_alpha($im, $layer, $this->x_shift, $this->y_shift, 0, 0, $this->width, $this->height, 65);    
    // imagecopymerge($im, $layer, $this->x_shift, $this->y_shift, 0, 0, $this->width, $this->height, 65);
	imagedestroy($layer);
        
        //Run any child class implementations of this hook before anything else
        //is added. This is mainly for the SpringIndexAnomalyLayer/SliderLayer
        //inter-relationship
        $this->preMarkup($im);
        
        //These are implemented here, but these all have custom implementations
        //for the pest layer.
        $this->drawNPNLogo($im);
        $this->drawTitleText($im);
        $this->drawSubTitleText($im);  
        // $this->drawProvisionalText($im);
        $this->drawGeneratedDateText($im);
        $this->drawNPNURL($im);
        
        //Writes the text at the bottom attributing NCEP
	$attr_x_start = 10;
	$attr_y_start = 795;
	$attr_font_size = 9;
	imagettftext($im, $attr_font_size, 0, $attr_x_start, $attr_y_start, $black, $this->font, $this->attr_string);


        //Draw the legend on to the image
	$legend = imagecreatefrompng($this->legend_path);
	imagecopyresized($im, $legend, $this->legend_x_start, $this->legend_y_start, 0, 0, $this->legend_width, $this->legend_height, $this->legend_width, $this->legend_height);
	imagedestroy($legend);

        $this->drawUSGSLogo($im);
        
         $this->drawUALogo($im);

        imagepng ($im, OUTPUT_PATH . $this->output_path, 9);

        //This isn't actually used. Started to implement it, didn't need it
        //Thought it might be useful later.
        $this->postProcess($im);
        imagedestroy($im);
   
    }
    
    protected function drawUSGSLogo($im){
	$usgs_logo = imagecreatefrompng($this->usgs_logo_path);
	$usgs_logo_x_offset = 1325;
	$usgs_logo_y_offset = 700;
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
	$ua_logo_y_offset = 699;
	$dst_ua_logo_width = 60;
	$dst_ua_logo_height = 55;
	$src_ua_logo_width = 350;
	$src_ua_logo_height = 322;
	imagecopyresized($im, $ua_logo, $ua_logo_x_offset, 
                $ua_logo_y_offset, 0, 0, $dst_ua_logo_width, $dst_ua_logo_height, $src_ua_logo_width, $src_ua_logo_height);        
	imagedestroy($ua_logo);
    }
    
    protected function drawNPNLogo($im){
	$npn_logo = imagecreatefrompng($this->npn_logo_path);
	$npn_logo_x_offset = 25;
    $npn_logo_y_offset = 600;
    
    $dst_npn_logo_width = 322;//325;
	$dst_npn_logo_height = 100;
	$src_npn_logo_width = 322;//3000;
    $src_npn_logo_height = 100;//914;
	// $dst_npn_logo_width = 325;
	// $dst_npn_logo_height = 100;
	// $src_npn_logo_width = 3000;
	// $src_npn_logo_height = 914;
	imagecopyresized($im, $npn_logo, $npn_logo_x_offset, $npn_logo_y_offset, 0, 0, $dst_npn_logo_width, $dst_npn_logo_height, $src_npn_logo_width, $src_npn_logo_height);
	imagedestroy($npn_logo);        
    }

    public function downloadBaseImage() {
        $ch = curl_init();
        $fp = fopen ($this->overlay_path, 'w+');
        curl_setopt($ch, CURLOPT_URL, $this->curl_url);
        curl_setopt($ch, CURLOPT_FILE, $fp); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch); 
        curl_close($ch);
        fclose($fp);
    }
    
    protected function drawNPNURL($im) {
        $url_x_start = 25;
        $url_y_start = 740;
        $url_font_size = 12;
        imagettftext($im, $url_font_size, 0, $url_x_start, $url_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->url_string);        
    }
    
    protected function drawTitleText($im) {
        $title_x_start = 25;
        $title_y_start = 720;
        $title_font_size = 18;
        imagettftext($im, $title_font_size, 0, $title_x_start, $title_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->title);
    }
    
    /**
     * Sub-title and 'generated on' text currently only used in pest maps
     * so no implementation here.
     */
    protected function drawSubTitleText($im) {
        return;
    }

    // protected function drawProvisionalText($im) {
    //     if($this->provisional) {
    //         $title_x_start = 10;
    //         $title_y_start = 780;
    //         $subtitle_font_size = 12;
    //         imagettftext($im, $subtitle_font_size, 0, $title_x_start, $title_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, "Generated on " . date_format(new DateTime(), "Y-m-d") . " (results provisional)");    
    //     } else {
    //         return;
    //     }
    // }
    
    protected function drawGeneratedDateText($im){
        return;
    }
    


}
