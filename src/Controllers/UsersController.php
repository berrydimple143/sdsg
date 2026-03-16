<?php
	
	namespace App\Controllers;


	use App\Models\User;

	class UsersController {

		public function store($data) {
			$firstname = trim(htmlspecialchars($data['firstname']));
			$lastname = trim(htmlspecialchars($data['lastname']));
			$username = trim(htmlspecialchars($data['username']));
			$email = trim(htmlspecialchars($data['email']));
			$password = trim(htmlspecialchars($data['password']));
			$middlename = trim(htmlspecialchars($data['middlename']));
			$phone = trim(htmlspecialchars($data['phone']));
			$mobile = trim(htmlspecialchars($data['mobile']));

			if($firstname AND $lastname AND $username AND $email AND $password) {
				$inserted = User::createUser($firstname, $middlename, $lastname, $email, $username, $password, $phone, $mobile, 1);
				if($inserted) {
					return true;
				} else {
					return false;
				}
			}
		}

		public function update($data, $id) {
			$name = trim(htmlspecialchars($data['name']));
			$price = trim(htmlspecialchars($data['price']));
			$quantity = trim(htmlspecialchars($data['quantity']));
			$description = trim(htmlspecialchars($data['description']));

			if($name AND $price AND $description) {
				$updated = User::updateUser($name, $price, $quantity, $description, $id);

				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}

	}

?>
