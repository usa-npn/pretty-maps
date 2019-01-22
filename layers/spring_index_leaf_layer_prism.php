<?php

require_once('basic_layer.php');

class SpringIndexLeafLayerPrism extends BasicLayer{
	
	
	public function __construct($date=null){
            $title = "Spring Index Leaf, " . $date->format('Y');
            
            $legend_width = 784;
            $legend_height=40;
            
            $legend_x_start = 700;
            $legend_y_start = 760;
            
            $output_path = 'six-leaf-index' . $date->format('Y') . '.png';
            //$curl_url = "http://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=si-x:average_leaf_ncep&width=1500&height=800&time=" . date_format(new DateTime(), "Y-m-d") . "&format=image/png&transparent=true";
            $curl_url = "https://geoserver.usanpn.org/geoserver/wms?service=WMS&request=GetMap&bbox=-14000000,2700000,-7000000,6450000&srs=EPSG:3857&layers=si-x:average_leaf_prism&width=1500&height=800&time=" . $date->format("Y-m-d") . "&format=image/png&transparent=true";

            parent::__construct($title, $legend_width, $legend_height, $legend_x_start, $legend_y_start, $output_path,$curl_url);
            
            $this->legend_path = $this->base_legend_path . "legend-six" . $this->extension;
            $this->overlay_path = $this->base_overlay_path . "current-spring-index-leaf.png";
	}
}