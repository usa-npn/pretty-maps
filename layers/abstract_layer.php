<?php

/**
 * Abstract layer class to initialize all the variables
 * and define all the extensible functions.
 */
abstract class AbstractLayer{
	
	protected $dir;
        //Folder where the project is located
	protected $base_image_path;
        //Folder where all the legends files are stored
        protected $base_legend_path;
        //Folder where all the overlay files we download are stored (temporarily)
        protected $base_overlay_path;
	protected $extension;
	
        //Path to the font file used to write all the text on the images
	protected $font;

	protected $image_width;
	protected $image_height;
	
        //Allows for manually adjusting where the overlays land on the map
	protected $x_shift;
        protected $y_shift;
	
	protected $title;
        //So far, this subtite only applies for the pest maps.
        protected $subtitle;
	
	protected $url_string;
	protected $attr_string;
	protected $usgs_string;
        protected $generated_on_string;
	
	protected $npn_logo_path;
        protected $usgs_logo_path;
	
	protected $legend_path;
	protected $legend_width;
        protected $legend_height;
	protected $legend_x_start;
        protected $legend_y_start;
        
        protected $background_path;
	protected $overlay_path;
        
        protected $curl_url;
        
        //Where to actually spit the finished file out at.
        protected $output_path;
        
        /*
         * In at least one context it's useful to be able to get the base image
         * before the class is initialized so we use this static function. It
         * kind of obsoleted the base_image_path instance var once this was
         * written, but I am keeping both because it is easier to read/write
         * the instance var in the code.
         */        
        public static function getBaseImagePath(){
            return dirname(substr(__FILE__, 0, strrpos(__FILE__, PATH_SEPERATOR))) . PATH_SEPERATOR;
        }
	
	public function __construct($width, $height, $x_shift, $y_shift, $title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path, $curl_url){
            
                $this->dir = dirname(substr(__FILE__, 0, strrpos(__FILE__, PATH_SEPERATOR)));
                $this->base_image_path = AbstractLayer::getBaseImagePath();
                $this->extension = '.png';
                $this->base_legend_path = $this->base_image_path . "/assets/legends/";
                $this->base_overlay_path = $this->base_image_path . "/overlays/";
                
                $this->title = $title;
                $this->subtitle = "";
                
                $this->font = $this->dir . '/assets/Frutiger-Bold.ttf';
                
                $this->url_string = "www.usanpn.org";
                $this->attr_string = "Based on NOAA NCEP RTMA and NDFD Products";
                $this->usgs_string = "Major funding provided by"; 
                $this->generated_on_string = "Generated on " . date('F j, Y');
                
                $this->npn_logo_path  = $this->base_image_path . "assets/npn-logo" . $this->extension;
                $this->usgs_logo_path = $this->base_image_path . "assets/usgs-logo" . $this->extension;
                $this->background_path  = $this->base_image_path . "assets/background" . $this->extension;
            
		$this->width = $width;
		$this->height = $height;
		$this->x_shift = $x_shift;
		$this->y_shift = $y_shift;
		$this->legend_width = $legend_width;
                $this->legend_height = $legend_height;
		$this->legend_x_start = $legend_x_start;
                $this->legend_y_start = $legend_y_start;
                
                $this->output_path = $output_path;
                
                $this->curl_url = $curl_url;
                
	}
        
        public abstract function downloadBaseImage();
        
        public abstract function buildImage();
        
        protected abstract function drawUSGSLogo($im);
        
        protected abstract function drawNPNLogo($im);
        
        protected abstract function drawGeneratedDateText($im);
        
        protected abstract function drawTitleText($im);
        
        protected abstract function drawSubTitleText($im);
        
        protected abstract function drawNPNURL($im);
        
        /*
         * These 'hooks' allow for stuff to be "done" by child classes
         * at various points druing the main image generation process
         * found in the BasicLayer class. Since that is extensible as well,
         * any other child classes of either AbstractLayer or BasicLayer
         * need to keep these hooks in mind.
         */
        protected function postProcess($im){
        }
        
        protected function preMarkup($im){            
        }
	
	
	
	
}