<?php
  class notifications {

     private $title;
     private $message;
     private $action;
     private static $_instance; //The single instance

     /*
   	Get an instance of the Database
   	@return Instance
   	*/
   	public static function getInstance() {
   		if(!self::$_instance) { // If no instance then make one
   			self::$_instance = new self();
   		}
   		return self::$_instance;
   	}

     function __construct() {
     }

     private function error() {
        $value = '<div class="alert alert-danger alert-dismissible alertnobr">';
        $value .= '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        $value .= '  <h4><i class="icon fa fa-ban"></i> '.$this->title.'</h4>';
        $value .= $this->message;
        $value .= '</div>';
        return $value;
     }

     private function success() {
       $value = '<div id="notification" class="alert alert-success alert-dismissible alertnobr">';
       $value .= '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
       $value .= '  <h4><i class="icon fa fa-check"></i> '.$this->title.'</h4>';
       $value .= $this->message;
       $value .= '</div>';
       return $value;
     }

     private function warning() {
       $value = '<div class="alert alert-warning alert-dismissible alertnobr">';
       $value .= '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
       $value .= '  <h4><i class="icon fa fa-warning"></i> '.$this->title.'</h4>';
       $value .= $this->message;
       $value .= '</div>';
       return $value;
     }

     public function execute($vfAction,$vfTitle,$vfMsg) {
      $this->title = $vfTitle;
      $this->message = $vfMsg;
      $this->action = $vfAction;
      $func = $this->action;
      return $this->$func();
     }

     public function teste() {
       return $this->action;
     }

  }
?>
