<?php
	require "../../autoload.php";
	header("Content-Type: application/json");

    use App\Controllers\RegionsController;
    use App\Controllers\ProvincesController;
    use App\Controllers\CitiesController;
    use App\Controllers\DistrictsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
        $input = json_decode(file_get_contents("php://input"));
        if($input->page == 'region') {
            $controller = new RegionsController();
        } else if($input->page == 'province') {
            $controller = new ProvincesController();
        } else if($input->page == 'city') {
            $controller = new CitiesController();
        } else if($input->page == 'district') {
            $controller = new DistrictsController();
        }
        $info = $controller->getAllData();        
        if(!empty($info)) {
            echo json_encode([
				'status' => true,
				'message' => 'success',
                'data' => $info
			]);
        } else {
            http_response_code(404);
            echo json_encode([
				'status' => false,
				'message' => 'not found',
                'data' => []
			]);
        }
	} else {
		http_response_code(405);
		echo json_encode([
            'status' => false,
            'message' => 'unauthorized',
            'data' => []
        ]);
	} 
?>