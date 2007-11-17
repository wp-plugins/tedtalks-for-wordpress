<?php
/*
Plugin Name: TedTalks for WordPress
Plugin URI: http://www.robertanselm.com/2.0/
Description: A filter for WordPress that displays ted.com videos based on the Youtube WordPress plugin by Joern Zaefferer. Copy and paste the TedTalks "Embed Video" code to a text editor and look for the .flv filename of the flashvideo. (eg.: JOHNMAEDA-2007_high.flv ). In WordPress type: [TEDTALKS JOHNMAEDA-2007_high.flv].
Version: 1.0
Author: Robert Anselm
Author URI: http://www.robertanselm.com/2.0/

Instructions

Copy this file you unzipped into the wp-content/plugins folder of WordPress, 
then go to Administration > Plugins, it should be in the list. Activtate it 
and every occurence of the expression [TEDTALKS file] will as
an embedded flash player. Replace "file" with the TEDTALKS .flv filename.
Copy and paste the TedTalks "Embed Viedo" code to a text editor and look
for the .flv filename of the flashvideo. (eg.: JOHNMAEDA-2007_high.flv ).
In WordPress type: [TEDTALKS JOHNMAEDA-2007_high.flv].

*/

define("TEDTALKS_WIDTH", 432);
define("TEDTALKS_HEIGHT", 285);
define("TEDTALKS_REGEXP", "/\[TEDTALKS ([[:print:]]+)\]/");


define("TEDTALKS_TARGET", "<object type=\"application/x-shockwave-flash\" data=\"http://static.videoegg.com/ted/flash/loader.swf\" width=\"".TEDTALKS_WIDTH."\" height=\"".TEDTALKS_HEIGHT."\" id=\"VE_Player\" align=\"middle\"><param name=\"movie\" value=\"http://static.videoegg.com/ted/flash/loader.swf\"><PARAM NAME=\"FlashVars\" VALUE=\"bgColor=FFFFFF&file=http://static.videoegg.com/ted/movies/###TED###&autoPlay=false&fullscreenURL=http://static.videoegg.com/ted/flash/fullscreen.html&forcePlay=false&logo=&allowFullscreen=true\"><param name=\"quality\" value=\"high\"><param name=\"allowScriptAccess\" value=\"always\"><param name=\"bgcolor\" value=\"#FFFFFF\"><param name=\"scale\" value=\"noscale\"><param name=\"wmode\" value=\"window\"><embed src=\"http://static.videoegg.com/ted/flash/loader.swf\" FlashVars=\"bgColor=FFFFFF&file=http://static.videoegg.com/ted/movies/###TED###&autoPlay=false&fullscreenURL=http://static.videoegg.com/ted/flash/fullscreen.html&forcePlay=false&logo=&allowFullscreen=true\" quality=\"high\" allowScriptAccess=\"always\" bgcolor=\"#FFFFFF\" scale=\"noscale\" wmode=\"window\" width=\"".TEDTALKS_WIDTH."\" height=\"".TEDTALKS_HEIGHT."\" name=\"VE_Player\" align=\"middle\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"></object>" );


function tedtalks_plugin_callback($match)
{
	$output = TEDTALKS_TARGET;
	$output = str_replace("###TED###", $match[1], $output);
	return ($output);
}

function tedtalks_plugin($content)
{
	return (preg_replace_callback(TEDTALKS_REGEXP, 'tedtalks_plugin_callback', $content));
}

add_filter('the_content', 'tedtalks_plugin');
add_filter('comment_text', 'tedtalks_plugin');

?>
