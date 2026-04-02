<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\ProvincesController;
	use App\Controllers\CitiesController;
	use App\Controllers\DistrictsController;
	use App\Controllers\BarangaysController;
	use App\Controllers\PuroksController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {		
		$data = json_decode(file_get_contents("php://input"));
        if($data->page == "province") {
            $controller = new ProvincesController();
        } elseif($data->page == "city") {
			$controller = new CitiesController();
		} elseif($data->page == "district") {
			$controller = new DistrictsController();
		} elseif($data->page == "barangay") {
			$controller = new BarangaysController();
		} elseif($data->page == "purok") {
			$controller = new PuroksController();
        }        

        if(empty($data->name)) {
            echo json_encode([
                'status' => false,
                'message' => "Name is required."
            ]);
            exit();
        }

		if($controller->update(['name' => $data->name], $data->id)) {
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