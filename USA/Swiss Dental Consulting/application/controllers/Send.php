<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Send extends CI_Controller {
	
	public function sendForm() {

        $host = "smtp-pt.securemail.pro";
        $mailFrom = "info@swissdentalconsulting.com";
        $mailTo = $mailFrom;
		$pass = "sds2020ISDS";
		$port = 25;

        $name = $this->input->post('formSDC__name');
        $email = $this->input->post('formSDC__email');
        $phone = $this->input->post('formSDC__phone');
		$message = "<br/>Contacto - Site Swiss Dental Consulting".
			"<br/><br/>Nome: ".$name.
			"<br/>Email: ".$email.
			"<br/>Telemóvel: ".$phone.
            "<br/>Mensagem: ".$this->input->post('formSDC__description').
            "<br/><br/>Este é um e-mail automático, para entrar em contato com ".$name.', favor usar o e-mail '.$email;


		$ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "smtp";
		$config['SMTPAuth'] = true;
		$config['smtp_host'] = $host;
		$config['smtp_port'] = $port;
		$config['smtp_user'] = $mailFrom; 
		$config['smtp_pass'] = $pass;
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

		$ci->email->initialize($config);

		$this->email->from($mailFrom, $name);
		$this->email->reply_to($email, $name);
		$this->email->to($mailTo);

		$this->email->subject('Contacto - Site Swiss Dental Consulting');
		$this->email->message($message);

		if(!$this->email->send()) {
        	echo $this->email->print_debugger(array('headers'));
			die;
		} else {
			header('Location: ' . 'https://swissdentalconsulting.com', true, $permanent ? 301 : 302);
   			exit();
		}
		
	}

}
