<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\ProvincesController;
	use App\Controllers\CitiesController;
	use App\Controllers\DistrictsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {		
		$data = json_decode(file_get_contents("php://input"));     
        if($data->page == "province") {
            $controller = new ProvincesController();
        } else if($data->page == "city") {
			$controller = new CitiesController();
		} else if($data->page == "district") {
			$controller = new DistrictsController();
        }        

        $np = $controller->getData($data->id);
		if($np) {
			http_response_code(200);
			echo json_encode([
				'status' => true,
				'message' => 'Record was changed successfully.',
                'data' => $np
			]);
		} else {
			http_response_code(401);
			echo json_encode([
				'status' => false,
				'message' => 'Data not found.',
                'data' => ''
			]);
		}

	} else {
		http_response_code(405);
		echo json_encode([
			'status' => false,
			'message' => 'Only POST requests are allowed.',
            'data' => ''
		]);
	} 
?>