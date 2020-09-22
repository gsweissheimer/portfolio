<?php
/**
 * PHPSense Encryption Class
 *
 * PHP tutorials and scripts
 *
 * @package		PHPSense
 * @copyright	Copyright (c) 2012, Jatinder Singh Thind
 * @link		http://www.phpsense.com
 */

// ------------------------------------------------------------------------
class Encryption {

	private $key = '';
	private $cipher = MCRYPT_RIJNDAEL_256;
	private $cipher_mode = MCRYPT_MODE_CBC;

	public function __construct() {
		if(!function_exists('mcrypt_encrypt')) {
			throw new Exception('mcrypt library not installed.');
		}
	}

	/**
	 * Set the encrypton key with wich the data is encrypted. Set this once only.
	 *
	 * @access public
	 * @return void
	 */
	public function setKey($key) {
		$this->key = hash('sha256', $key, TRUE);;
	}

	/**
	 * Encrypt data.
	 *
	 * @data Data to encrypt
	 * @access public
	 * @return string
	 */
	public function encrypt($data) {
		$init_size = mcrypt_get_iv_size($this->cipher, $this->cipher_mode);
		$init_vect = mcrypt_create_iv($init_size, MCRYPT_RAND);
		return $this->randomString(strlen($this->key)).$init_vect.mcrypt_encrypt($this->cipher, $this->key, strrev($data), $this->cipher_mode, $init_vect);
	}

	/**
	 * Descrypt data
	 *
	 * @data Data to decrypt
	 * @access public
	 * @return string
	 */
	public function decrypt($data) {
		$data = substr($data, strlen($this->key));
		$init_size = mcrypt_get_iv_size($this->cipher, $this->cipher_mode);
		$init_vect = substr($data, 0, $init_size);
		$data = substr($data, $init_size);
		return strrev(mcrypt_decrypt($this->cipher, $this->key, $data, $this->cipher_mode, $init_vect));
	}

	/**
	 * Generate random string
	 *
	 * @len Length of string to generate
	 * @access private
	 * @return string
	 */
	private function randomString($len) {
		$str = '';
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$pool_len = strlen($pool);
		for ($i = 0; $i < $len; $i++) {
			$str .= substr($pool, mt_rand(0, $pool_len - 1), 1);
		}
		return $str;
	}
}
?>
