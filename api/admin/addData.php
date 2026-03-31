
<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\ProvincesController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {		
		$province = json_decode(file_get_contents("php://input"));
        $data = [
			'name' => $province->name,
			'region_id' => $province->region_id			
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
		if($province->page == "province") {
			$info = new ProvincesController();
		} elseif($province->page == "city") {

		}		

		if($info->store($data)) {
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