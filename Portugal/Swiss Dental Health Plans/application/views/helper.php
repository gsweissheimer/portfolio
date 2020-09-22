<?php

    $protocol = $_SERVER["SERVER_NAME"];

    
    switch ($protocol) {

        case 'localhost':

            define('baseUrl', 'http://localhost:8080/');

            break;
        
        default:

            define('baseUrl', 'http://swissdentalhealthplans.com/');

            break;

    }

    //define('baseUrl', 'http://localhost:8080/');


    if ( ! function_exists('base_url')) {

        function base_url($data,$path = false) {

            switch ($path) {
                
                case false:

                    echo baseUrl . $data;

                    break;
                
                case 'template':

                    echo baseUrl . 'html/template' . '/' . $data;

                    break;
                
                default:

                    echo baseUrl . 'assets/' . $path . '/' . $data;

                    // echo baseUrl . 'assets/' . $data;

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