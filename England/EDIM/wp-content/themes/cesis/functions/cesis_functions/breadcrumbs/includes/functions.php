<?php



	if ( ! defined('ABSPATH')) exit;  // if direct access

function cesis_breadcrumb_shorten_string($string, $shorten_style='word', $wordcount=4, $ending='...'){

	if(empty($wordcount)){

		$wordcount = 4;
		}


		if($shorten_style == 'word')
			{
				$retval = $string;  //    Just in case of a problem
				$array = explode(" ", $string);
				if (count($array)<=$wordcount)
					{
					$retval = $string;
					}
				else
					{
					array_splice($array, $wordcount);
					$retval = implode(" ", $array).$ending;
					}

				return $retval;

			}
		else if($shorten_style == 'character')
			{
				if (strlen($string) > $wordcount)
					{
						$stringCut = substr($string, 0, $wordcount);

						return $stringCut.$ending;
					}
				else
					{
						return $string;
					}


			}



    }
