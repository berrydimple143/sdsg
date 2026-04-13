<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\RegionsController;
	use App\Controllers\ProvincesController;
	use App\Controllers\CitiesController;
	use App\Controllers\DistrictsController;
	use App\Controllers\BarangaysController;
	use App\Controllers\PuroksController;
	use App\Controllers\PaymentsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		
		$data = json_decode(file_get_contents("php://input"));        
		if($data->page == "region") {
			$controller = new RegionsController();
		} elseif($data->page == "province") {
			$controller = new ProvincesController();
		} elseif($data->page == "city") {
			$controller = new CitiesController();
		} elseif($data->page == "district") {
			$controller = new DistrictsController();
		} elseif($data->page == "barangay") {
			$controller = new BarangaysController();
		} elseif($data->page == "purok") {
			$controller = new PuroksController();
		} elseif($data->page == "payment") {
			$controller = new PaymentsController();
		}
		if($data->page == "beneficiary") {
			$controller = new PaymentsController();
			$info = $controller->changeUserStatus($data->id, $data->status);
		} else {
			$info = $controller->changeStatus($data->id, $data->status);
		}
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