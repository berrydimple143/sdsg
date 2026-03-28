<?php
	require "../../autoload.php";
	header("Content-Type: application/json");

    use App\Controllers\RegionsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
        $regions = new RegionsController();
        $all = $regions->getAllRegions();        
        if(!empty($all)) {
            echo json_encode([
				'status' => true,
				'message' => 'success',
                'regions' => $all
			]);
        } else {
            http_response_code(404);
            echo json_encode([
				'status' => false,
				'message' => 'not found',
                'regions' => []
			]);
        }
	} else {
		http_response_code(405);
		echo json_encode([
            'status' => false,
            'message' => 'unauthorized',
            'regions' => []
        ]);
	} 
?>