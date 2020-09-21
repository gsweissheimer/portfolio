<?php
// excerpt / content related functions
if(!function_exists('cesis_content'))
{
function cesis_content(){
  $content = get_the_content();
  $content = do_shortcode( $content);
	$content = str_replace(array("\r\n", "\r"), "\n", $content);
	$lines = explode("\n", $content);
	$new_lines = array();
	foreach ($lines as $i => $line) {
    if(!empty($line))
        $new_lines[] = trim($line);
	}
	$content = implode($new_lines);
	return $content;
}
}
if(!function_exists('cesis_text_truncate'))
{
function cesis_text_truncate($text, $length) {
	$text = strip_tags($text, '<img /><style>');
	$length = abs((int)$length);
	$text = mb_substr($text,0,$length,"utf-8").'';

	return($text);
}
}
