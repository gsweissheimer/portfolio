<?php
/**
 * @package     DevSolutions Icon Selector
 * @author      Sami Maxhuni
 * @version     1.0.0
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;
// Don't duplicate me!
if( !class_exists( 'ReduxFramework_dev_iconselect' ) ) {
    /**
     * Main ReduxFramework_custom_field class
     *
     * @since       1.0.0
     */
    class ReduxFramework_dev_iconselect extends ReduxFramework {

        /**
         * Field Constructor.
         *
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value ='', $parent ) {
            $ndir = "dir";
            $ndir .= "name";

            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;
            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', $ndir( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
            }
            // Set default args for this field to avoid bad indexes. Change this to anything you use.
            $defaults = array(
                'options'               => array(
                    'suffix'            => 'fa',
                    'prefix'            => 'fa-',
                    'class'             => 'dev-social-icon',
                    'url'               => '#',
                    'icons_link'        => $this->extension_dir.'include/fontawesome/css/font-awesome-social.css',
                    'icons_link_url'    => $this->extension_url.'include/fontawesome/css/font-awesome-social.css',
                ),
                'default'           => array(),
                'stylesheet'        => '',
                'output'            => true,
                'enqueue'           => true,
                'enqueue_frontend'  => true
            );


            //$this->field = wp_parse_args( $this->field, $defaults );
            $this->field = $this->meks_wp_parse_args( $this->field, $defaults );

        }

        public function checkActive($current, $array){
            if(!empty($array) AND is_array($array)):
                if(array_key_exists($current, $array)):
                    return 'active';
                endif;
            endif;
        }

        public function meks_wp_parse_args( &$a, $b ) {
            $a = (array) $a;
            $b = (array) $b;
            $result = $b;
            foreach ( $a as $k => &$v ) {
                if ( is_array( $v ) && isset( $result[ $k ] ) ) {
                    $result[ $k ] = $this->meks_wp_parse_args( $v, $result[ $k ] );
                } else {
                    $result[ $k ] = $v;
                }
            }
            return $result;
        }

        /**
         * Field Render Function.
         *
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {

            // HTML output goes here

            $output  = '';

            if(is_null($this->field['options']['icons_link']) && is_null($this->field['options']['icons_link_url'])){
                _e('Please assign icons_link, icons_link_url','cesis');
                die();
            }


            $fa = new Dev_FontAwesome;
            //Get array
            $icons = $fa->getArray($this->field['options']['icons_link'], $this->field['options']['prefix']);
            $icon_name = $fa->readableName($icons);

            $output .= '<div id="'.esc_attr($this->field['id']).'" class="dev-selecticon-extension">';
                $output .= '<input id="filter" class="filter" type="text" value="" placeholder="Search...">';
                $output .= '<div id="dev-list-icons-preview" class="dev-list-icons-preview">';
                    $output .= '<ul>';
                        $i = 1;
                        $row = 0;
                        if(is_array($icon_name) && !empty($icon_name)):
                            foreach($icon_name as $key => $ic):
                                $output .= '<li title="'.$ic.'" class="dev-'.$i.' '.$this->checkActive($key, $this->value).' " data-class-name="'.$this->field['options']['class'].'" data-suffix="'.$this->field['options']['suffix'].'" data-container-name="'.$this->field['name'] . $this->field['name_suffix'].'['.strtolower($key).']" data-title="'.ucfirst($ic).'" data-name="'.strtolower($key).'" data-id="'.$i.'" data-url="'.$this->field['options']['url'].'">';
                                    $output .= '<i title="'.$ic.'" alt="'.$ic.'" class="'.$this->field['options']['suffix'].' '.$key.'"></i>';
                                $output .= '</li>';
                                $i++;
                                $row++;
                            endforeach;
                        endif;
                    $output .= '</ul>';
                $output .= '</div>';


                // Container
                $output .= '<ul class="dev-selecticon-details">';
                $output .= '<input type="hidden" name="'.$this->field['name'] . $this->field['name_suffix'].'" value="">';
                    if(!empty($this->value) && is_array($this->value)):
                        foreach($this->value as $icon):
                            $output .= '<li id="social-'.$icon['font-id'].'" class="clearfix">';

                                $output .= '<div class="dev-icon-name-wrapper clearfix">';
                                    $output .= '<div class="dev-icon-name-left">';
                                        $output .= '<div class="dev-icon-preview">';
                                            $output .= '<i class="'.$icon['font-suffix'].' '.$icon['font-icon'].'"></i>';
                                        $output .= '</div>';

                                        $output .= '<div class="dev-icon-name">';
                                            $output .= $icon['font-title'];
                                        $output .= '</div>';
                                    $output .= '</div>';

                                    $output .= '<div class="dev-icon-name-right">';
                                        $output .= '<div class="dev-icon-enabled">';
                                            $output .= '<label>Enabled';
                                                $output .= '<input type="checkbox" value="true" '.checked('true', $icon['font-enable'], false).'>';
                                            $output .= '</label>';
                                        $output .= '</div>';
                                    $output .= '</div>';

                                $output .= '</div>';

                                $output .= '<div class="dev-icon-wrapper clearfix">';
                                    $output .= '<div class="dev-icon-link-url">';
                                        $output .= '<label class="dev-icon-url-label">'.__('Link URL', 'cesis').'</label>';
                                        $output .= '<input class="dev-icon-url-text" type="text" value="'.$icon['font-url'].'">';
                                    $output .= '</div>';



                                    $output .= '<div class="dev-icon-reset">';
                                        $output .= '<a class="button" value="Remove">Remove</a>';
                                    $output .= '</div>';

                                $output .= '</div>';

                                // Hidden Inputs
                                $output .= '<input type="hidden" id="font-id" name="'.$this->field['name'] . $this->field['name_suffix'].'['.$icon['font-icon'].'][font-id]" value="'.$icon['font-id'].'">';
                                $output .= '<input type="hidden" id="font-class" name="'.$this->field['name'] . $this->field['name_suffix'].'['.$icon['font-icon'].'][font-class]" value="'.$icon['font-class'].'">';
                                $output .= '<input type="hidden" id="font-suffix" name="'.$this->field['name'] . $this->field['name_suffix'].'['.$icon['font-icon'].'][font-suffix]" value="'.$icon['font-suffix'].'">';
                                $output .= '<input type="hidden" id="font-icon" name="'.$this->field['name'] . $this->field['name_suffix'].'['.$icon['font-icon'].'][font-icon]" value="'.$icon['font-icon'].'">';
                                $output .= '<input type="hidden" id="font-title" name="'.$this->field['name'] . $this->field['name_suffix'].'['.$icon['font-icon'].'][font-title]" value="'.$icon['font-title'].'">';
                                $output .= '<input type="hidden" id="font-url" name="'.$this->field['name'] . $this->field['name_suffix'].'['.$icon['font-icon'].'][font-url]" value="'.$icon['font-url'].'">';
                                $output .= '<input type="hidden" id="font-enable" name="'.$this->field['name'] . $this->field['name_suffix'].'['.$icon['font-icon'].'][font-enable]" value="'.$icon['font-enable'].'">';

                            $output .= '</li>';
                        endforeach;
                    endif;
                $output .= '</ul>';

                // Javascript Template
                $output .= '<script type="text/template" id="dev-icon-box-template">';
                    $output .= '<li id="social-<%=id %>" class="<%=classn %> clearfix">';

                        $output .= '<div class="dev-icon-name-wrapper clearfix">';
                            $output .= '<div class="dev-icon-name-left">';
                                $output .= '<div class="dev-icon-preview">';
                                    $output .= '<i class="<%=suffix %> <%=name %>"></i>';
                                $output .= '</div>';

                                $output .= '<div class="dev-icon-name">';
                                    $output .= '<%=title %>';
                                $output .= '</div>';
                            $output .= '</div>';

                            $output .= '<div class="dev-icon-name-right">';
                                $output .= '<div class="dev-icon-enabled">';
                                    $output .= '<label>Enabled';
                                        $output .= '<input type="checkbox" value="1" checked="checked">';
                                    $output .= '</label>';
                                $output .= '</div>';
                            $output .= '</div>';

                        $output .= '</div>';

                        $output .= '<div class="dev-icon-wrapper clearfix">';
                            $output .= '<div class="dev-icon-link-url">';
                                $output .= '<label class="dev-icon-url-label">'.__('Link URL', 'cesis').'</label>';
                                $output .= '<input class="dev-icon-url-text" type="text" value="<%=url %>">';
                            $output .= '</div>';


                            $output .= '<div class="dev-icon-reset">';
                                $output .= '<a class="button" value="Remove">Remove</a>';
                            $output .= '</div>';

                        $output .= '</div>';

                        // Hidden Inputs
                        $output .= '<input type="hidden" id="font-id" name="<%=hidden %>[font-id]" value="<%=id %>">';
                        $output .= '<input type="hidden" id="font-class" name="<%=hidden %>[font-class]" value="<%=classn %>">';
                        $output .= '<input type="hidden" id="font-suffix" name="<%=hidden %>[font-suffix]" value="<%=suffix %>">';
                        $output .= '<input type="hidden" id="font-icon" name="<%=hidden %>[font-icon]" value="<%=name %>">';
                        $output .= '<input type="hidden" id="font-title" name="<%=hidden %>[font-title]" value="<%=title %>">';
                        $output .= '<input type="hidden" id="font-url" name="<%=hidden %>[font-url]" value="<%=url %>">';
                        $output .= '<input type="hidden" id="font-enable" name="<%=hidden %>[font-enable]" value="<%=enable %>">';

                    $output .= '</li>';
                $output .= '</script>';
            $output .= '</div>';

            echo $output;
        }

        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {
            $extension = ReduxFramework_extension_dev_iconselect::getInstance();

            // Its Importatn if you want to work well icon insert
            wp_enqueue_script('underscore');
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-sortable');


            wp_enqueue_script(
                'redux-field-dev-iconselect-js',
                $this->extension_url . 'field_dev_iconselect.js',
                array( 'jquery' ),
                time(),
                true
            );
            wp_enqueue_style(
                'redux-field-dev-iconselect-css',
                $this->extension_url . 'field_dev_iconselect.css',
                time(),
                true
            );


            if(!is_null($this->field['options']['icons_link_url'])){
                wp_enqueue_style(
                    'redux-field-dev-icnselect-'.$this->field['id'],
                    $this->field['options']['icons_link_url'],
                    true
                );
            }

        }

        /**
         * Output Function.
         *
         * Used to enqueue to the front-end
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function output() {
            if ( $this->field['enqueue_frontend'] ) {
                if(!is_null($this->field['options']['icons_link_url'])){
                    wp_enqueue_style(
                        'redux-field-dev-icnselect-'.$this->field['id'].'-font-end',
                        $this->field['options']['icons_link_url'],
                        true
                    );
                }
            }
        }

    }
}


if( ! class_exists('Dev_FontAwesome') ){
    class Dev_FontAwesome{
        /**
         * Font Awesome
         *
         * @param string $path font awesome css file path
         * @param string $class_prefix change this if the class names does not start with `fa-`
         * @return array
         */
        public static function getArray($path, $class_prefix = 'fa-'){
            if( ! file_exists($path) )
                return false;//if path is incorect or file does not exist, stop.

            $nfgc = 'file_ge';
            $nfgc .= 't_contents';
            $css = $nfgc($path);
            $pattern = '/\.('. $class_prefix .'(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
            preg_match_all($pattern, $css, $matches, PREG_SET_ORDER);

            $icons = array();
            foreach ($matches as $match) {
                $icons[$match[1]] = $match[2];
            }
            return $icons;
        }
        //------------------------------------//--------------------------------------//

        /**
         * Sort array by key name
         *
         * @param array $array font awesome array. Create it using `getArray` method
         * @return array
         */
        public function sortByName($array){

            if( ! is_array($array) )
                return false;//Do not proceed if is not array
            ksort( $array );
            return $array;
        }
        //------------------------------------//--------------------------------------//

        /**
         * Get only HTML class key(class) => value(class)
         *
         * @param array $array font awesome array. Create it using `getArray` method
         * @return array
         */
        public function onlyClass($array){

            if( ! is_array($array) )
                return false;//Do not proceed if is not array
            $temp = array();
            foreach ($array as $class => $unicode) {
                $temp[$class] = $class;
            }
            return $temp;
        }
        //------------------------------------//--------------------------------------//

        /**
         * Get only the unicode key
         *
         * @param array $array font awesome array. Create it using `getArray` method
         * @return array
         */
        public function onlyUnicode($array){

            if( ! is_array($array) )
                return false;//Do not proceed if is not array
            $temp = array();
            foreach ($array as $class => $unicode) {
                $temp[$unicode] = $unicode;
            }
            return $temp;
        }
        //------------------------------------//--------------------------------------//

        /**
         * Readable class name. Ex: fa-video-camera => Video Camera
         *
         * @param array $array font awesome array. Create it using `getArray` method
         * @param string $class_prefix change this if the class names does not start with `fa-`
         * @return array
         */
        public function readableName($array, $class_prefix = 'fa-'){

            if( ! is_array($array) )
                return false;//Do not proceed if is not array
            $temp = array();
            foreach ($array as $class => $unicode) {
                $temp[$class] = ucfirst( str_ireplace(array($class_prefix, '-'), array('', ' '), $class) );
            }
            return $temp;
        }
    }//class
}//class_exists
