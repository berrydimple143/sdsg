<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\RegionsController;
	use App\Controllers\ProvincesController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		
		$data = json_decode(file_get_contents("php://input"));        
		if($data->page == "region") {
			$controller = new RegionsController();
		} elseif($data->page == "province") {
			$controller = new ProvincesController();
		}
        $info = $controller->changeStatus($data->id, $data->status);
		if($info) {
			http_response_code(200);
			echo json_encode([
				'status' => true,
				'message' => 'Status was changed successfully.',
                'info' => $info
			]);
		} else {
			http_response_code(401);
			echo json_encode([
				'status' => false,
				'message' => 'Data not found.',
                'info' => ''
			]);
		}

	} else {
		http_response_code(405);
		echo json_encode([
			'status' => false,
			'message' => 'Only POST requests are allowed.',
            'info' => ''
		]);
	} 
?>