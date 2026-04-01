
<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\ProvincesController;
	use App\Controllers\CitiesController;
	use App\Controllers\DistrictsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {		
		$input = json_decode(file_get_contents("php://input"));

        $data = [
			'name' => $input->name,
			'province_id' => $input->province_id,
			'city_id' => $input->city_id
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
		if($input->page == "province") {
			$controller = new ProvincesController();
		} elseif($input->page == "city") {
			$controller = new CitiesController();
		} elseif($input->page == "district") {
			$controller = new DistrictsController();
		}		

		if($controller->store($data)) {
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