<?php

require_once('abstract_layer.php');
require_once('basic_layer.php');

/**
 * This class handles the slider images that appears on the homepage. Because
 * it operates quite a bit differently, it implements it's own download and build
 * functions.
 */
class SliderLayer extends BasicLayer{

    private $sub_image_width;
    private $sub_image_height;
    
    /**
     * SpringIndexAnomalyLayer actually produces the overlay data for SliderLayer.
     * SpringIndexAnomalyLayer has to run it's functions before SliderLayer.
     * This static function allows SpringIndexAnomalyLayer to know which overlay
     * file to populate on behalf of SliderLayer.
     */
    public static function getBackgroundPath(){
        return AbstractLayer::getBaseImagePath() . 'assets/slider-template.png';
    }
	
    public function __construct(){
        
        $title = "Spring Leaf Index Anomaly";            

        $legend_width = 0;
        $legend_height=0;
        $legend_x_start = 0;
        $legend_y_start = 0;
        
        $width = 980;
        $height= 360;

        $output_path = "slider-anomaly-map_0.png";
        parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path,null, $width, $height);

        $this->legend_path = $this->base_legend_path . "legend-slider" . $this->extension;
        $this->overlay_path = $this->base_overlay_path . "current-spring-index-leaf-anomaly.png";
        $this->background_path = SliderLayer::getBackgroundPath();
        
        //?
        $this->grid_shift = 25;
        $this->sub_image_width = 580;
        $this->sub_image_height = 310;
    }
    
    
    public function downloadBaseImage(){
        return;
    }
    
    public function buildImage() {
        
        /*
         * Draw a big blue rectangle as the background.
         */
        $im = imagecreatetruecolor($this->width, $this->height);
        $black = imagecolorallocate($im, 0, 0, 0);
        $blue = imagecolorallocate($im, 128, 160, 199);
        imagefilledrectangle ($im, 0, 0, $this->width, $this->height, $blue);



        //Reference the gridded data PNG we download as part of SpringIndexAnomalyLayer's execution and paint that ontop of the map background
        $six = imagecreatefrompng($this->background_path);
        imagecopyresized($im, $six, 0, $this->grid_shift, 0, 0, $this->sub_image_width, $this->sub_image_height, 1500, 800);
        imagedestroy($six);        
        

        //Write the title
        $title_x_start = 10;
        $title_y_start = 310;
        $title_font_size = 14;
        imagettftext($im, $title_font_size, 0, $title_x_start, $title_y_start, $black, $this->font, $this->title);

        //Write the date (it's on a seperate line for this layer)
        $title_x_start = 10;
        $title_y_start = 330;
        $title_font_size = 10;
        imagettftext($im, $title_font_size, 0, $title_x_start, $title_y_start, $black, $this->font, date('F j, Y'));

        //Draw the legend on
        $legend = imagecreatefrompng($this->legend_path);
        $legend_x_offset=270;
        $legend_y_offset = 315;
        $legend_width=300;
        $legend_height=20;
        imagecopyresized($im, $legend, $legend_x_offset, $legend_y_offset, 0, 0, $legend_width, $legend_height, $legend_width, $legend_height);
        imagedestroy($legend);


        imagepng ($im, $this->output_path, 9);

        imagedestroy($im);
    }               
        
        
}