<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\ProvincesController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {		
		$data = json_decode(file_get_contents("php://input"));
        if($data->page == "province") {
            $info = new ProvincesController();
        } elseif($data->page == "city") {

        }        

        if(empty($data->name)) {
            echo json_encode([
                'status' => false,
                'message' => "Name is required."
            ]);
            exit();
        }

		if($info->update(['name' => $data->name], $data->id)) {
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