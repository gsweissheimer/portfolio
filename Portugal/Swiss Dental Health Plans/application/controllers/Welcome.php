<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends WebController {

	public function index() {

		$this->loadView('index');
		
	}

	public function why() {

		$this->loadView('why');
		
	}

	public function solutions() {

		$this->loadView('solutions');
		
	}

	public function contact() {

		$this->loadView('contato');
		
	}

	public function units() {

		$this->loadView('units');
		
	}

	public function unitsD($clinic) {

		$this->loadView('unitsD');
		
	}

	public function sds() {

		$this->loadView('sds');
		
	}

	public function tes() {

		$this->loadView('tes');
		
	}

}
