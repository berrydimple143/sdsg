<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\RegionsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$newRegion = new RegionsController();
		$region = json_decode(file_get_contents("php://input"));        
        $nr = $newRegion->getRegion($region->id);
		if($nr) {
			http_response_code(200);
			echo json_encode([
				'status' => true,
				'message' => 'Region was changed successfully.',
                'region' => $nr
			]);
		} else {
			http_response_code(401);
			echo json_encode([
				'status' => false,
				'message' => 'Region not found.',
                'region' => ''
			]);
		}

	} else {
		http_response_code(405);
		echo json_encode([
			'status' => false,
			'message' => 'Only POST requests are allowed.',
            'region' => ''
		]);
	} 
?>