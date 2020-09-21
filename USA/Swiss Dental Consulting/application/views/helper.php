<?php

    $protocol = $_SERVER["SERVER_NAME"];

    switch ($protocol) {

        case 'localhost':

            define('baseUrl', 'http://localhost:8080/');

            break;
        
        default:

            define('baseUrl', 'https://swissdentalconsulting.com/');

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


    if ( ! function_exists('redirectT')) {

        function redirectT($url, $permanent = false)  {
            header('Location: ' . $url, true, $permanent ? 301 : 302);
        
            exit();
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




?>