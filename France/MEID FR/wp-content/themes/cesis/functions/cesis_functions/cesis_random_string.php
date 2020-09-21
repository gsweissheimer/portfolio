<?php
//random string

if(!function_exists('RandomString')){
function RandomString($length) {
	$key = null;
  $keys = array_merge(range(0,9), range('a', 'z'));
  for($i=0; $i < $length; $i++) {
  $key .= $keys[array_rand($keys)];
}
	return $key;
}
}
