<?php

$host = "smtp-pt.securemail.pro";
$mailFrom = "info@swissdentalinvest.com";
$mailTo = $mailFrom;
$pass = "sds2020ISDS";
$port = 25;


$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$desc = $_POST['description'];
$message = "<br/>Contacto - Site Swiss Dental Invest".
    "<br/><br/>Nome: ".$name.
    "<br/>Telemovel: ".$phone.
    "<br/>Email: ".$email.
    "<br/>Mensagem: ".$desc.
    "<br/><br/>Este é um e-mail automático, para entrar em contato com ".$name.', favor usar o e-mail '.$email;

//echo '<pre>';
//var_dump($message);
//die;

// Inclui o arquivo class.phpmailer.php localizado na mesma pasta do arquivo php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';
 
// Inicia a classe PHPMailer 
$mail = new PHPMailer; 
 
// Método de envio 
$mail->IsSMTP(); 
 
// Enviar por SMTP 
$mail->Host = $host; 
 
// Você pode alterar este parametro para o endereço de SMTP do seu provedor 
$mail->Port = $port; 
 
 
// Usar autenticação SMTP (obrigatório) 
$mail->SMTPAuth = true; 
 
// Usuário do servidor SMTP (endereço de email) 
// obs: Use a mesma senha da sua conta de email
$mail->Username = $mailFrom; 
$mail->Password = $pass; 
 
// Configurações de compatibilidade para autenticação em TLS 
$mail->SMTPSecure = 'tls';
//$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 
 
// Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
$mail->SMTPDebug = 0; 
 
// Define o remetente 
// Seu e-mail 
$mail->From = $mailFrom; 
 
// Seu nome 
$mail->FromName = $name; 
 
// Define o(s) destinatário(s) 
$mail->AddAddress($mailTo, $name); 
$mail->addReplyTo($email, $name);
 
// Opcional: mais de um destinatário
// $mail->AddAddress('fernando@email.com'); 
 
// Opcionais: CC e BCC
// $mail->AddCC('joana@provedor.com', 'Joana'); 
// $mail->AddBCC('roberto@gmail.com', 'Roberto'); 
 
// Definir se o e-mail é em formato HTML ou texto plano 
// Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
$mail->IsHTML(true); 
 
// Charset (opcional) 
$mail->CharSet = 'UTF-8'; 
 
// Assunto da mensagem 
$mail->Subject = "Contacto - Site Swiss Dental Invest";
 
// Corpo do email 
$mail->Body = $message; 
 
// Opcional: Anexos 
// $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 
 
// Envia o e-mail 
$enviado = $mail->Send(); 
 
// Exibe uma mensagem de resultado 
if ($enviado) { 
	//var_dump('enviado');
    header('Location: ' . 'https://swissdentalinvest.com', true, $permanent ? 301 : 302);
	exit();
} else { 
	var_dump($mail->ErrorInfo);
	exit();
} 