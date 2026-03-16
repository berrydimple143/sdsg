<?php
	
	namespace App\Controllers;
	use App\Models\User;

	class AuthController {

		public function auth($data) {
			$email = trim(htmlspecialchars($data['email']));
			$password = trim(htmlspecialchars($data['password']));			

			if($email AND $password) {
				$user = User::findUserByEmail($email);				
				if($user) {
					if(password_verify($password, $user['password'])) {
						return $user;
					}
					return false;
				}
				return false;
			}
			return false;
		}

		public static function encrypt_text($text) {
			


/*
			Methond 1
			$key = "A(LVv@P5&elUU@|5aso@hsWW_Hw15m1?"; 
			$cipher_method = 'aes-256-cbc';
			$options = 0;
			$iv_length = openssl_cipher_iv_length($cipher_method);
			$iv = openssl_random_pseudo_bytes($iv_length);
			$encrypted_data = openssl_encrypt($text, $cipher_method, $key, $options, $iv);
			return base64_encode($iv . $encrypted_data);
*/
/*
			Method 2			
			Using sodium
			$key = sodium_crypto_secretbox_keygen(); 
			$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES); 
			$encrypted = sodium_crypto_secretbox($text, $nonce, $key);
			return base64_encode($nonce . $encrypted); 	
					 */
		}

		public static function decrypt_text($text) {
			$key = "A(LVv@P5&elUU@|5aso@hsWW_Hw15m1?"; 
			$cipher_method = 'aes-256-cbc';
			$decoded_data = base64_decode($text);
			$iv_length = openssl_cipher_iv_length($cipher_method);
			$iv_dec = substr($decoded_data, 0, $iv_length);
			$encrypted_data_dec = substr($decoded_data, $iv_length);
			return openssl_decrypt($encrypted_data_dec, $cipher_method, $key, 0, $iv_dec);

			// Using sodium
			// $key = sodium_crypto_secretbox_keygen();
			// $decoded = base64_decode($text);
			// $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
			// $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
			// return sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
		}
	}

?>
