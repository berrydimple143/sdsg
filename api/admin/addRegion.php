<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\RegionsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$newRegion = new RegionsController();
		$region = json_decode(file_get_contents("php://input"));

        if(empty($region->name)) {
            echo json_encode([
                'status' => false,
                'message' => "Name is required."
            ]);
            exit();
        }

		if($newRegion->store(['name' => $region->name])) {
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