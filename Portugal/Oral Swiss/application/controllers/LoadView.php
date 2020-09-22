<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoadView extends CI_Controller {
	
	public function index() {

		$this->data['active']          = 'home';
		$this->data['active_submenu']  = '';

		$this->load->view('index', $this->data);
		
	}

	public function construcao() {		

		$this->load->view('construcao');
		
	}

	public function odontologia() {

		$this->data['active']          = 'odt';
		$this->data['active_submenu']  = '';

		$this->load->view('odontologia', $this->data);
		
	}

	public function alinhadores() {

		$this->data['active']          = 'odt';
		$this->data['active_submenu']  = 'ali';
		$this->data['alias']           = 'alinhadores';
		
		$this->load->view('produtos', $this->data);
		
	}

	public function cdeo() {

		$this->data['active']          = 'odt';
		$this->data['active_submenu']  = 'cdeo';
		$this->data['alias']           = 'cdeo';

		$this->load->view('produtos', $this->data);
		
	}

	public function dsd() {

		$this->data['active']          = 'odt';
		$this->data['active_submenu']  = 'dsd';
		$this->data['alias']           = 'dsd';

		$this->load->view('produtos', $this->data);
		
	}

	public function facetas() {

		$this->data['active']          = 'odt';
		$this->data['active_submenu']  = 'fac';
		$this->data['alias']           = 'fac';

		$this->load->view('produtos', $this->data);
		
	}

	public function coroas() {

		$this->data['active']          = 'odt';
		$this->data['active_submenu']  = 'cor';
		$this->data['alias']           = 'cor';

		$this->load->view('produtos', $this->data);
		
	}

	public function implantes() {

		$this->data['active']          = 'odt';
		$this->data['active_submenu']  = 'imp';
		$this->data['alias']           = 'imp';

		$this->load->view('produtos', $this->data);
		
	}

	public function proteses() {

		$this->data['active']          = 'odt';
		$this->data['active_submenu']  = 'pro';
		$this->data['alias']           = 'pro';

		$this->load->view('produtos', $this->data);
		
	}

	public function servicos() {

		$this->data['active']          = 'odt';
		$this->data['active_submenu']  = 'ser';
		$this->data['alias']           = 'ser';

		$this->load->view('servicos', $this->data);
		
	}

	public function casos_clinicos() {

        $this->data['active']          = 'casos';
        $this->data['active_submenu']  = '';
		$this->load->view('casos_clinicos', $this->data);
		
	}

	public function nossas_clinicas() {

        $this->data['active']          = 'clinic';
        $this->data['active_submenu']  = '';
		$this->load->view('nossas_clinicas', $this->data);
		
	}

	public function blog() {

		$this->data['active']          = 'blog';
        $this->data['active_submenu']  = '';
		$this->load->view('blog', $this->data);
		
	}

	public function blogDetail($cat,$post) {


		$this->data['active']          = 'blog';
        $this->data['active_submenu']  = '';
        $this->data['post_id']  = url_to_id($post);
		$this->load->view('blogDetail', $this->data);
		
	}

	public function sds() {

		$this->data['active']          = 'sds';
        $this->data['active_submenu']  = '';
		$this->load->view('sds', $this->data);
		
	}

    public function suporte() {

    	$this->data['active']          = 'suport';
        $this->data['active_submenu']  = '';
		$this->load->view('suporte', $this->data);
		
	}

    public function termosCondicoes() {

    	$this->data['active']          = '';
		$this->data['active_submenu']  = '';
		
		$this->load->view('termosCondicoes', $this->data);
		
	}

	/*-----------------------------------------------------------------projeto antigo----------------------------------------------------------------------------------*/

		
	/*public function wync() {

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
		
	public function contact() {

		$this->load->view('contact');
		
	}
	}*/
	

}
