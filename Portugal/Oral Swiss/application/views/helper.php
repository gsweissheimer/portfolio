<?php

    $protocol = $_SERVER["SERVER_NAME"];

    switch ($protocol) {

        case 'localhost':

            define('baseUrl', 'http://localhost:8080/');

            break;
        
        default:

            define('baseUrl', 'https://oralswiss.com/');//https://swissdentalconsulting.com/

            break;

    }


    if ( ! function_exists('base_url')) {

        function base_url($data,$path = false) {

            switch ($path) {
                
                case false:

                    echo baseUrl . $data;

                    break;
                
                default:

                    echo baseUrl . 'assets/' . $path . '/' . $data;

                    break;
            }
            
        }
        
    }

    if ( ! function_exists('site_url')) {

        function site_url($data) {            

            echo baseUrl . '/' . $data;          
          
            
        }
        
    }


    if ( ! function_exists('doctor_url')) {

        function doctor_url($css=false) {
            
            $path = $_SERVER['REQUEST_URI'];

            switch ($path) {
                
                case "/":

                    if(!$css) {

                        echo baseUrl . 'assets/img/doctora.png';

                    } else {
                    
                        echo 'width: 83%;vertical-align: bottom';

                    }

                    break;
                
                default:

                $img_one = baseUrl . 'assets/img/doctora.png';

                $img_two = baseUrl . 'assets/img/doctor.png';

                $default_image = array($img_one,$img_two);

                $css_one = 'width: 83%;vertical-align: bottom';

                $css_two = 'width: 80%;vertical-align: bottom';

                $default_css = array($css_one,$css_two);

                    if(!$css) {

                        echo $default_image[rand(0,1)];

                    } else {

                        echo $default_css[rand(0,1)];

                    }

                    break;
            }
            
        }
        
    }
    
    if ( ! function_exists('sanitizeString')) {
        function sanitizeString($string) {
    
            $string = strip_tags($string);
    
            // matriz de entrada
            $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º','*','@','ˆ',']','[','.',' ' );
    
            // matriz de saída
            $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','','','','','','','','','','','','','','','','','','','','','','','','','','','','-');
    
            // devolver a string
            return str_replace($what, $by, strtolower($string));
        }
    }



    if ( ! function_exists('dump')) {

        function dump($data,$var=false) {

            switch ($var) {
                
                case true:

                    echo '<pre>';
                    echo var_dump($data);
                    echo '</pre>';

                    break;
                
                    case false:
    
                        echo '<pre>';
                        echo var_dump($data);
                        echo '</pre>';
                        die;
    
                        break;
                
                default:

                    echo '<pre>';
                    echo var_dump($data);
                    echo '</pre>';
                    die;

                    break;
            }
            
        }
        
    }

    if ( ! function_exists('isMobile')) {

        function isMobile() {
            $is_mobile = false;

            //Se tiver em branco, não é mobile
            if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
                $is_mobile = false;

            //Senão, se encontrar alguma das expressões abaixo, será mobile
            } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
                    $is_mobile = true;

            //Senão encontrar nada, não será mobile
            } else {
                $is_mobile = false;
            }

            return $is_mobile;
        }

    }




?>