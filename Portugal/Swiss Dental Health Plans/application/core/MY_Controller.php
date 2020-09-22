<?php 
class WebController extends CI_Controller{

	var $data;
	
	public function __construct(){
		parent::__construct(); 
		$ci =& get_instance();
		//$ci->load->model("Get_model");
		$ci->load->helper("garden_helper");

	}

	public function loadView($views){
		//$this->load->view('partial/header',$this->data);
		//$this->load->view('partial/menu',$this->data);
		if(is_array($views)){
			foreach ($views as $view) {
				$this->load->view($view,$this->data);
			}
		}else{
			$this->load->view($views,$this->data);
		}
		//$this->load->view('partial/footer',$this->data);
	}

}
?>

                       