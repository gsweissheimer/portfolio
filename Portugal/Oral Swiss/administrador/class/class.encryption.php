<?php
	/**
	 * This library is unsafe because it does not MAC after encrypting
	 */
	class Encryption {
			const METHOD = 'aes-256-cbc';
			private $key = '';

			public function setKey($key){
					$this->key = $key;
			}

			public function encrypt($message){
					if (mb_strlen($this->key, '8bit') !== 32) {
							throw new Exception("Needs a 256-bit key!");
					}
					$ivsize = openssl_cipher_iv_length(self::METHOD);
					$iv = openssl_random_pseudo_bytes($ivsize);

					$ciphertext = openssl_encrypt(
							$message,
							self::METHOD,
							$this->key,
							OPENSSL_RAW_DATA,
							$iv
					);

					return $iv . $ciphertext;
			}

			public function decrypt($message)
			{
					if (mb_strlen($this->key, '8bit') !== 32) {
							throw new Exception("Needs a 256-bit key!");
					}
					$ivsize = openssl_cipher_iv_length(self::METHOD);
					$iv = mb_substr($message, 0, $ivsize, '8bit');
					$ciphertext = mb_substr($message, $ivsize, null, '8bit');

					return openssl_decrypt(
							$ciphertext,
							self::METHOD,
							$this->key,
							OPENSSL_RAW_DATA,
							$iv
					);
			}

			public function compareStrings($var1, $var2){
				$flag = 'false';
				if($var1 == $this->decrypt($var2)){
					$flag = 'true';
				}else{
					$flag = 'false';
				}
				return $flag;
			}
	}
?>
