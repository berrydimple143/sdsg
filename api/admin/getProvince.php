<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\ProvincesController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$newProvince = new ProvincesController();
		$province = json_decode(file_get_contents("php://input"));        
        $np = $newProvince->getProvince($province->id);
		if($np) {
			http_response_code(200);
			echo json_encode([
				'status' => true,
				'message' => 'Province was changed successfully.',
                'province' => $np
			]);
		} else {
			http_response_code(401);
			echo json_encode([
				'status' => false,
				'message' => 'Province not found.',
                'province' => ''
			]);
		}

	} else {
		http_response_code(405);
		echo json_encode([
			'status' => false,
			'message' => 'Only POST requests are allowed.',
            'province' => ''
		]);
	} 
?>