<?php

if ( ! function_exists('set_enters')) {
	function set_enters($data) {
		$data = nl2br($data);
		//dump($data);
		return $data;
	}
}

if ( ! function_exists('dump'))
{
	function dump($data,$die=false)
	{
		echo "<pre>";
		print_r($data);
		if ($die == false) {
			echo "</pre>";
			die;
		} else {
			echo "</pre>";
		}
		
	}
}

if ( ! function_exists('limit_text'))
{
	function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }
}

if (! function_exists('url_to_id'))
{
	function url_to_id($url)
	{
		$id = explode("-", $url);
		return end($id);
	}
}

if ( ! function_exists('selected'))
{
	function selected($requestUri)	{
	    $current_file_name = $_SERVER['REQUEST_URI'];
	    $current_file_name = explode("/",$current_file_name);
	    array_shift($current_file_name);


	    if (in_array($requestUri, $current_file_name))
	        echo 'selected';
	}
}

if ( ! function_exists('get_link'))
{
	function get_link($uri = '')
	{
		return "{$uri}";
	}
}

if ( ! function_exists('youtube_id'))
{
	function get_youtube_id($url = '')
	{
		$parts = parse_url($url);
	    if(isset($parts['query'])){
	        parse_str($parts['query'], $qs);
	        if(isset($qs['v'])){
	            return $qs['v'];
	        }else if(isset($qs['vi'])){
	            return $qs['vi'];
	        }
	    }
	    if(isset($parts['path'])){
	        $path = explode('/', trim($parts['path'], '/'));
	        return $path[count($path)-1];
	    }
	    return false;
		// parse_str( parse_url( $uri, PHP_URL_QUERY ), $my_array_of_vars );
		// return $my_array_of_vars['v'];
	}
}

if (! function_exists('page_is'))
{
	function page_is($class_name = '')
	{
		$CI =& get_instance();
		return $CI->router->fetch_class() === $class_name;
	}
}


if ( ! function_exists('sanitizeString')) {
	function sanitizeString($string) {

	    // matriz de entrada
	    $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º','*','@','ˆ',']','[','.',' ' );

	    // matriz de saída
	    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','','','','','','','','','','','','','','','','','','','','','','','','','','','','-');

	    // devolver a string
	    return str_replace($what, $by, strtolower($string));
	}
}

function round_up($number, $precision = 2)
{
    $fig = (int) str_pad('1', $precision, '0');
    return (ceil($number * $fig) / $fig);
}