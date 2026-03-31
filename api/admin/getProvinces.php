<?php
	require "../../autoload.php";
	header("Content-Type: application/json");

    use App\Controllers\ProvincesController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
        $provinces = new ProvincesController();
        $all = $provinces->getAllProvinces();        
        if(!empty($all)) {
            echo json_encode([
				'status' => true,
				'message' => 'success',
                'provinces' => $all
			]);
        } else {
            http_response_code(404);
            echo json_encode([
				'status' => false,
				'message' => 'not found',
                'provinces' => []
			]);
        }
	} else {
		http_response_code(405);
		echo json_encode([
            'status' => false,
            'message' => 'unauthorized',
            'provinces' => []
        ]);
	} 
?>