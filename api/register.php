<?php
	require "../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\UsersController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$newUser = new UsersController();
		$user = json_decode(file_get_contents("php://input"));

		$data = [
			'firstname' => $user->firstname,
			'lastname' => $user->lastname,
			'email' => $user->email,
			'username' => $user->username,
			'password' => $user->password				
		];	

		foreach($data as $key => $value) {
			if(empty($value)) {
				$keyname = ucfirst($key);
				echo json_encode([
					'status' => false,
					'message' => "$keyname is required."
				]);
				exit();
			}
		}

		$data['middlename'] = $user->middlename;
		$data['phone'] = $user->phone;
		$data['mobile'] = $user->mobile;

		if($newUser->store($data)) {
			http_response_code(200);
			echo json_encode([
				'status' => true,
				'message' => 'Authentication successful.'
			]);
		} else {
			http_response_code(401);
			echo json_encode([
				'status' => false,
				'message' => 'Authentication failed.'
			]);
		}

	} else {
		http_response_code(405);
		echo json_encode([
			'status' => false,
			'message' => 'Only POST requests are allowed.'
		]);
	} 
?>