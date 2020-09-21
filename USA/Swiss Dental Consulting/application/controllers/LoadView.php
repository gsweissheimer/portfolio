<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoadView extends CI_Controller {
	
	public function index() {

		$this->load->view('index');
		
	}
	
	public function wync() {

		$this->load->view('wync');
		
	}
	
	public function solutions() {

		$this->load->view('solutions');
		
	}
	
	public function kickoff() {

		$this->data['solutionTag']          = 'kickoff_';
		$this->data['banner_png']           = 'kickoff.png';
	
		$this->data['kickoff_class']        = "pricing-plan-2 blue-dark"; 
		$this->data['setup_class']          = "pricing-plan red-dark";
		$this->data['growth_class']         = "pricing-plan red-blood";
		$this->data['triumph_class']        = "pricing-plan red-dark";
		
		$this->data['kickoff_link']         = "#banner_solution";
		$this->data['setup_link']           = "setup.php";
		$this->data['growth_link']          = "growth.php";
		$this->data['triumph_link']         = "triumph.php";

		$this->load->view('solution',$this->data);
		
	}
	
	public function setup() {

		$this->data['solutionTag']          = 'setup_';
		$this->data['banner_png']           = 'setup.png';
		
		$this->data['kickoff_class']        = "pricing-plan red-blood"; 
		$this->data['setup_class']          = "pricing-plan-2 blue-dark";
		$this->data['growth_class']         = "pricing-plan red-blood";
		$this->data['triumph_class']        = "pricing-plan red-dark";
		
		$this->data['kickoff_link']         = "kickoff.php";
		$this->data['setup_link']           = "#banner_solution";
		$this->data['growth_link']          = "growth.php";
		$this->data['triumph_link']         = "triumph.php";

		$this->load->view('solution',$this->data);
		
	}
	
	public function growth() {

		$this->data['solutionTag']          = 'growth_';
		$this->data['banner_png']           = 'growth.png';

		$this->data['kickoff_class']        = "pricing-plan red-blood"; 
		$this->data['setup_class']          = "pricing-plan red-dark";
		$this->data['growth_class']         = "pricing-plan-2 blue-dark";
		$this->data['triumph_class']        = "pricing-plan red-dark";
		
		$this->data['kickoff_link']         = "kickoff.php";
		$this->data['setup_link']           = "setup.php";
		$this->data['growth_link']          = "#banner_solution";
		$this->data['triumph_link']         = "triumph.php";

		$this->load->view('solution',$this->data);
		
	}
	
	public function triumph() {

		$this->data['solutionTag']          = 'triumph_';
		$this->data['banner_png']           = 'triumph.png';
		
		$this->data['kickoff_class']        = "pricing-plan red-blood"; 
		$this->data['setup_class']          = "pricing-plan red-dark";
		$this->data['growth_class']         = "pricing-plan red-blood";
		$this->data['triumph_class']        = "pricing-plan-2 blue-dark";
		
		$this->data['kickoff_link']         = "kickoff.php";
		$this->data['setup_link']           = "setup.php";
		$this->data['growth_link']          = "growth.php";
		$this->data['triumph_link']         = "#banner_solution";

		$this->load->view('solution',$this->data);
		
	}
	
	public function contact() {

		$this->load->view('contact');
		
	}

}
