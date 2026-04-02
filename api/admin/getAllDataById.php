<?php
	require "../../autoload.php";
	header("Content-Type: application/json");

    use App\Controllers\ProvincesController;
    use App\Controllers\CitiesController;
    use App\Controllers\DistrictsController;
    use App\Controllers\BarangaysController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
        $input = json_decode(file_get_contents("php://input"));
        if($input->page == 'province') {
            $field = 'region_id';
            $controller = new ProvincesController();
        } else if($input->page == 'city') {
            $field = 'province_id';
            $controller = new CitiesController();
        } else if($input->page == 'district') {
            $field = 'city_id';
            $controller = new DistrictsController();
        } else if($input->page == 'barangay') {
            $field = 'district_id';
            $controller = new BarangaysController();
        }
        $info = $controller->getAllDataById($field, $input->id);        
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