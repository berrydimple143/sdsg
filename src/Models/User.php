<?php
	namespace App\Models;

	use App\Core\Database;
	use PDO;

	class User {
		
		public static function getUsers() {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
			return $user->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function findUserByEmail($email) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users WHERE email='$email'");
			return $user->fetch(PDO::FETCH_ASSOC);
		}

		public static function getUser($id) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users WHERE id=$id");
			return $user->fetch(PDO::FETCH_ASSOC);
		}

		public static function createUser($firstname, $middlename, $lastname, $email, $username, $password, $phone, $mobile, $status) {
			$pdo = Database::connect();
			$user = $pdo->prepare("INSERT INTO users(firstname, middlename, lastname, email, username, password, phone, mobile, status, created_at, updated_at) VALUES(:firstname, :middlename, :lastname, :email, :username, :password, :phone, :mobile, :status, :created_at, :updated_at)");
			return $user->execute([
				":firstname" =>$firstname,
				":middlename" =>$middlename,
				":lastname" => $lastname,
				":email" => $email,
				":username" => $username,
				":password" => password_hash($password, PASSWORD_DEFAULT),
				":phone" => $phone,
				":mobile" => $mobile,
				":status" => $status,
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);
		}

		public static function updateUser($firstname, $middlename, $lastname, $email, $username, $phone, $mobile, $id) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$user = $pdo->prepare("UPDATE users SET firstname=?, middlename=?, lastname=?, email=?, username=?, phone=?, mobile=?, updated_at=? WHERE id=?");
			return $user->execute([$firstname, $middlename, $lastname, $email, $username, $phone, $mobile, $updated_at, $id]);	
		}

		public static function deleteUser($id) {
			$pdo = Database::connect();
			$user = $pdo->prepare("DELETE FROM users WHERE id=?");
			return $user->execute([$id]);			
		}
	}
?>