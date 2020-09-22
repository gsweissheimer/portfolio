<?php

if ( ! function_exists('image_url')) {
	function image_url($uri = '',$w=false, $h=false,$crop=false) {
		$CI =& get_instance();

		if($CI->config->item("development")){
			if (!file_exists(getcwd()."/assets/upload/{$uri}")) {
				copy("http://www.jesky.com.br/homolog/assets/upload/{$uri}", getcwd()."/assets/upload/{$uri}");
			}
		}
		if(!$w){
			return base_url("assets/upload/{$uri}");
		}
		$crop = $crop?"yes":"no";

		return site_url("images/{$uri}?height={$h}&width={$w}&crop={$crop}");
	}
}

if ( ! function_exists('set_enters')) {
	function set_enters($data) {
		$data = nl2br($data);
		//dump($data);
		return $data;
	}
}

if ( ! function_exists('dump'))
{
	function dump($data,$die=false)
	{
		echo "<pre>";
		print_r($data);
		if ($die == false) {
			echo "</pre>";
			die;
		} else {
			echo "</pre>";
		}
		
	}
}

if ( ! function_exists('limit_text'))
{
	function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }
}



if (! function_exists('url_to_id'))
{
	function url_to_id($url)
	{
		$id = explode("-", $url);
		return end($id);
	}
}

if ( ! function_exists('selected'))
{
	function selected($requestUri)	{
	    $current_file_name = $_SERVER['REQUEST_URI'];
	    $current_file_name = explode("/",$current_file_name);
	    array_shift($current_file_name);


	    if (in_array($requestUri, $current_file_name))
	        echo 'selected';
	}
}

if ( ! function_exists('get_link'))
{
	function get_link($uri = '')
	{
		return "{$uri}";
	}
}

if ( ! function_exists('youtube_id'))
{
	function get_youtube_id($url = '')
	{
		$parts = parse_url($url);
	    if(isset($parts['query'])){
	        parse_str($parts['query'], $qs);
	        if(isset($qs['v'])){
	            return $qs['v'];
	        }else if(isset($qs['vi'])){
	            return $qs['vi'];
	        }
	    }
	    if(isset($parts['path'])){
	        $path = explode('/', trim($parts['path'], '/'));
	        return $path[count($path)-1];
	    }
	    return false;
		// parse_str( parse_url( $uri, PHP_URL_QUERY ), $my_array_of_vars );
		// return $my_array_of_vars['v'];
	}
}

if (! function_exists('page_is'))
{
	function page_is($class_name = '')
	{
		$CI =& get_instance();
		return $CI->router->fetch_class() === $class_name;
	}
}


if ( ! function_exists('sanitizeString')) {
	function sanitizeString($string) {

		$string = strip_tags($string);

	    // matriz de entrada
	    $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º','*','@','ˆ',']','[','.',' ' );

	    // matriz de saída
	    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','','','','','','','','','','','','','','','','','','','','','','','','','','','','-');

	    // devolver a string
	    return str_replace($what, $by, strtolower($string));
	}
}

function round_up($number, $precision = 2)
{
    $fig = (int) str_pad('1', $precision, '0');
    return (ceil($number * $fig) / $fig);
}


if ( ! function_exists('send_email_helper'))
{
	function send_email_helper($email_to,$subject, $message_)
	{
		require_once(APPPATH.'/third_party/mailler/PHPMailerAutoload.php');
		require_once(APPPATH.'/third_party/mailler/class.smtp.php');
		
		$list_mails = explode(",", $email_to);
		$mail = new PHPMailer;
		extract($_POST);

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.jesky.com.br';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'envios@jesky.com.br';                 // SMTP username
		$mail->Password = 'g9e6f4b9';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		foreach ($list_mails as $m) {
			$mail->addAddress($m);
		}
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->setFrom('atendimento@jesky.com.br', $name);
		$mail->Subject = $subject;
		$mail->Body    = $message_;
		$mail->AltBody = strip_tags($message_);

		//echo "<pre>";
		if(!$mail->send()) {
		    // echo 'Message could not be sent.';
		    // echo 'Mailer Error: ' . $mail->ErrorInfo;
			// die("problema ao enviar");
		} else {
			if (ob_get_contents()) {
				ob_clean();
			}
		    redirect();
		    die();
		}
		// die();
		// $ci =& get_instance();
		// extract($_POST);

		// // if(!empty($name)&&!empty($email) && !empty($message)){
		// // 	$message = "Nome: {$name} <br/> Email: {$email};<br/> Mensagem: {$message}";
		// // }

		// $ip = get_client_ip_env();
		// // $details = (file_get_contents("http://ipinfo.io/{$ip}/json"));
		// // print_r($details);die;
		// $url = 'http://pando.apanda.com.br/index.php/api/send_email';
		// $fields = array(
		// 	'company_id' => urlencode($ci->config->item("company_code")),
		// 	'name' => urlencode($name),
		// 	'email' => urlencode($email),
		// 	'email_to' => $email_to,
		// 	'message' => urlencode($message_),
		// 	'subject'=>urlencode($subject),
		// //	'details' => $details          <-----------------------
		// );


		// $fields_string = "";
		// //url-ify the data for the POST
		// foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		// rtrim($fields_string, '&');

		// $ch = curl_init();
		// curl_setopt($ch,CURLOPT_URL, $url);
		// curl_setopt($ch,CURLOPT_POST, count($fields));
		// curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		// $result = curl_exec($ch);
		// curl_close($ch);
		// echo $result; die;
	}
}

// if ( ! function_exists('send_email_helper'))
// {
// 	function send_email_helper($email_to,$subject, $message_)
// 	{
// 		require_once(APPPATH.'third_party/ion_auth.php');
// 		$ci =& get_instance();
// 		extract($_POST);

// 		// if(!empty($name)&&!empty($email) && !empty($message)){
// 		// 	$message = "Nome: {$name} <br/> Email: {$email};<br/> Mensagem: {$message}";
// 		// }

// 		$ip = get_client_ip_env();
// 		// $details = (file_get_contents("http://ipinfo.io/{$ip}/json"));
// 		// print_r($details);die;
// 		$url = 'http://pando.apanda.com.br/index.php/api/send_email';
// 		$fields = array(
// 			'company_id' => urlencode($ci->config->item("company_code")),
// 			'name' => urlencode($name),
// 			'email' => urlencode($email),
// 			'email_to' => $email_to,
// 			'message' => urlencode($message_),
// 			'subject'=>urlencode($subject),
// 		//	'details' => $details          <-----------------------
// 		);


// 		$fields_string = "";
// 		//url-ify the data for the POST
// 		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
// 		rtrim($fields_string, '&');

// 		$ch = curl_init();
// 		curl_setopt($ch,CURLOPT_URL, $url);
// 		curl_setopt($ch,CURLOPT_POST, count($fields));
// 		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
// 		$result = curl_exec($ch);
// 		curl_close($ch);
// 		// echo $result; die;
// 	}
// }



function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

if ( ! function_exists('basic_upload'))
{

	function basic_upload($file_name,$folder_path)
	{
		$ci =& get_instance();
		$config['upload_path'] = $folder_path;
		$config['encrypt_name'] = TRUE;
		$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|jpeg';

		$ci->load->library('upload', $config);

		if ( ! $ci->upload->do_upload($file_name))
		{
			$error = array('error' => $ci->upload->display_errors());

			return $error;
		}
		else
		{
			// $data = array('upload_data' => $ci->upload->data());
			
			return $ci->upload->data();
		}
	}
}



?>