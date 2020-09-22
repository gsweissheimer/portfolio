<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	ini_set("allow_url_fopen", 1);
    header('Content-Type: application/json; charset=utf-8');

class Send extends CI_Controller {

	
	public function sendForm() {

		$return					= new stdClass();

        $host     = "smtp-pt.securemail.pro";
        $mailFrom = "info@oralswiss.com";
        $mailTo   = $mailFrom;
		$pass     = 'teste@gmail.com*';
		$port     = 25;

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
		$message = "<br/>Contacto - Site Oral Swiss".
			"<br/><br/>Nome: ".$name.
			"<br/>Email: ".$email.
			"<br/>Telemóvel: ".$phone.
            "<br/>Mensagem: ".$this->input->post('description').
            "<br/><br/>Este é um e-mail automático, para entrar em contato com ".$name.', favor usar o e-mail '.$email;


		/*$ci = get_instance();
		$ci->load->library('email');*/
		$this->load->library('email');

		/*$config['protocol'] = "smtp";
		$config['SMTPAuth'] = true;
		$config['smtp_host'] = $host;
		$config['smtp_port'] = $port;
		$config['smtp_user'] = $mailFrom; 
		$config['smtp_pass'] = $pass;
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

		$ci->email->initialize($config);*/

		
		$this->email->from($mailFrom, $name);
		$this->email->reply_to($email, $name);
		$this->email->to($mailTo);

		$this->email->subject('Contacto - Site Oral Swiss');
		$this->email->message($message);



		if(!$this->email->send()) {

			$return->msg				= $this->email->print_debugger(array('headers'));
			$return->status 			= "error";

			///print_r($return);/*$name.'  '.$email.'  '.$phone
            //die('matando la aplicacion');
			
        	//echo $this->email->print_debugger(array('headers'));
			//die;
		} else {
			$return->msg				= "Obrigado pelo seu interesse. Brevemente será contactado pela nossa equipa.";
			$return->status 			= "success";
			
			//header('Location: ' . 'https://swissdentalhealthplans.com', true, $permanent ? 301 : 302);
   			//exit();
		}

		//$return->msg				= "Obrigado pelo seu interesse. Brevemente será contactado pela nossa equipa.";
		//$return->status 			= "success";


        //print_r($return);/*$name.'  '.$email.'  '.$phone*/
        //die('matando la aplicacion');

		echo json_encode($return);//json_encode($return);
		
	}

}
