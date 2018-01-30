<?php 

extract(shortcode_atts(array("carousel_title" => '', "scroll_speed" => 'medium', 'easing' => 'easeInExpo', 'autorotate' => ''), $atts));
	
$carousel_html = null;
$carousel_html .= '
<div class="carousel-wrap">
<div class="carousel-heading">
	<div class="container">
		<h2>'. $carousel_title .'</h2>
	</div>
</div>
<div class="carousel-heading carousel-buttons centered">
	<div class="container">
		<a class="carousel-prev" href="#"><i class="icon-angle-left"></i></a>
		<a class="carousel-next" href="#"><i class="icon-angle-right"></i></a>
	</div>
</div>
		
<ul class="row carousel" data-scroll-speed="' . $scroll_speed . '" data-easing="' . $easing . '" data-autorotate="' . $autorotate . '">';

echo $carousel_html . do_shortcode($content) . '</ul></div>';


?>