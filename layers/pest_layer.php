<?php

require_once('abstract_layer.php');

/*
 * Parent class to any of the individual pest layers.
 * Does as custom implementation of downloadBaseImage
 * since this class accesses raw PNG files based on a response from our
 * custom web service, while the other "Basic" layers ask Geoserver for data/images.
 */
class PestLayer extends BasicLayer{
	
	
	
    public function __construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $long_forecast, $width=1500, $height=800, $x_shift=53, $y_shift=7, $background_path="assets/background", $attr_string="Based on NOAA NCEP RTMA and NDFD Products", $provisional = false){
                    
            parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url, $width, $height, $x_shift, $y_shift, $background_path, $attr_string, $provisional);
            
            /*
             * These classes, defined here, handle the special fact that
             * the pest layers might be for today or for six days in the future.
             * As such, each of the below variables may change depending on how
             * the object was initialized.
             */
            $this->amendTitle($long_forecast);
            $this->amendCURLURL($long_forecast);
            $this->amendOutputPath($long_forecast);
                       
    }
    
    protected function amendOutputPath($long_forecast){
        if($long_forecast){
            $this->output_path .= "-six-day.png";
        }else{
            $this->output_path .= "-current-day.png";
        }
    }
    
    protected function amendTitle($long_forecast){
        
        $today = new DateTime();
        $date = $today;
        
        if($long_forecast){
            $plus_six = $today->add(new DateInterval('P6D'));
            $date = $plus_six;
        }        
        $this->title .= ", " . date_format($date, 'F j, Y');
    }
    
    protected function amendCURLURL($long_forecast){
        
        $today = new DateTime();
        $date = $today;
        
        if($long_forecast){
            $plus_six = $today->add(new DateInterval('P6D'));
            $date = $plus_six;
        }                
        
        $this->curl_url .= "&date=" . date_format($date, "Y-m-d");
    
    }



    /**
     * The call to the service requests data from our custom web serive
     * which in the response includes a URL to a PNG, which is the file we need
     * to download and display in this script.
     */
    public function downloadBaseImage() {
        $ch = curl_init();
        $fp = fopen ($this->overlay_path, 'w+');
        
        curl_setopt($ch, CURLOPT_URL, $this->curl_url);
        /**
         * Disabling SSL verification here because:
         * A) We're only ever communicating with our own server so we know
         * it's presumably legit
         * B) My local PHP env (and probably the CLI on the server) doesn't know
         * about any of the CA's so it's more trouble than it's worth enabling
         * those.
         */
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $json  = curl_exec($ch);
        $data = json_decode($json);        
        $img_url = $data->clippedImage;
        curl_close($ch);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $img_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_FILE, $fp); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        
        $new_img = $this->resizePNG($this->overlay_path, 1401, 781);        
        imagepng($new_img, $this->overlay_path, 9);
        
    }
    
    /**
     * Custom implementation of this function because on the pest maps, the
     * legend goes where the USGS logo would go otherwise. With this we are 
     * bumping the logo up above the legend.
     */
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
    
    protected function drawUALogo($im) {
	$ua_logo = imagecreatefrompng($this->ua_logo_path);
	$ua_logo_x_offset = 1265;
	$ua_logo_y_offset = 549;
	$dst_ua_logo_width = 60;
	$dst_ua_logo_height = 55;
	$src_ua_logo_width = 350;
	$src_ua_logo_height = 322;
	imagecopyresized($im, $ua_logo, $ua_logo_x_offset, 
                $ua_logo_y_offset, 0, 0, $dst_ua_logo_width, $dst_ua_logo_height, $src_ua_logo_width, $src_ua_logo_height);        
	imagedestroy($ua_logo);
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
	$generated_on_y_start = 743;
	$generated_on_font_size = 12;
	imagettftext($im, $generated_on_font_size, 0, $generated_on_x_start, $generated_on_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->generated_on_string);
    }


    protected function drawNPNURL($im) {
        $url_x_start = 25;
        $url_y_start = 760;
        $url_font_size = 12;
        imagettftext($im, $url_font_size, 0, $url_x_start, $url_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->url_string);        
    }
    
    protected function drawTitleText($im) {
        $title_x_start = 25;
        $title_y_start = 700;
        $title_font_size = 18;
        imagettftext($im, $title_font_size, 0, $title_x_start, $title_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->title);
    }    
    
    protected function drawSubTitleText($im) {
        $title_x_start = 25;
        $title_y_start = 723;
        $subtitle_font_size = 16;
        imagettftext($im, $subtitle_font_size, 0, $title_x_start, $title_y_start, imagecolorallocate($im, 0, 0, 0), $this->font, $this->subtitle);       
    }
    
    
    /**
     * The service's the pest layers interact with don't allow to pass in desired
     * width/height. This creates a problem because the overlay image is actually
     * bigger than the base map. This function will resize the overlay PNG prepping
     * it for the actual combination.
     * 
     * This is all complicated by the fact that it's difficult to preserve the 
     * image's opacity when copying it. Note that the flags being set and 
     * the order of operations here is very important
     * otherwise the results look bad or don't work at all. 
     */
    protected function resizePNG($file, $w, $h) {
        list($width, $height) = getimagesize($file);
        $src = imagecreatefrompng($file);
        $dst = imagecreatetruecolor($w, $h);

        imagealphablending($dst, false);
        imagesavealpha($dst, false);    
        imagecolortransparent($dst, imagecolorallocatealpha($dst, 0, 0, 0, 127));

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
                    
        return $dst;
    }

    

}