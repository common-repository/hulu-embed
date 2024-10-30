<?php

/*
Plugin Name: Hulu Embed
Plugin URI: http://abwaters.com/2008/03/15/hulu-embed-wordpress-plugin/
Description: Plugin to embed hulu videos
Date: 03/15/2008
Author: Bryan Waters
Author URI: http://abwaters.com
Version: 1.0

Copyright 2008 Bryan Waters
This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

*/

add_filter('the_content','hulu_content');

function hulu_content($content) {
    $regex = '/\[hulu:(.*?)]/i';
	preg_match_all( $regex, $content, $matches );
	for($i=0;$i<count($matches[0]);$i++) {
		$elems = explode(" ", $matches[1][$i]);
		$width = 510 ;
		$height = 295 ;
		$url = $elems[0] ;
		if( count($elems) > 1 ) $width = $elems[1] ;
		if( count($elems) > 2 ) $width = $elems[2] ;
		$replace = "<object width='$width' height='$height'><param name='movie' value='$url'></param><embed src='$url' type='application/x-shockwave-flash'  width='$width' height='$height'></embed></object>" ;
		$content = str_replace($matches[0][$i], $replace, $content);
	}
	return $content;
}
?>