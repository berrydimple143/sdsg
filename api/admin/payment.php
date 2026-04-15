
<?php
	require "../../autoload.php";
	header("Content-Type: application/json");	
	use App\Controllers\PaymentsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {		
		$input = json_decode(file_get_contents("php://input"));
		$mode = $input->mode;
        $data = [
			'user_id' => $input->user_id,
			'amount' => $input->amount,
			'created_at' => $input->created_at,
            'mode' => $mode
		];
		foreach($data as $key => $value) {
			if(empty($value)) {
				$keyname = ucfirst($key);
				echo json_encode([
					'status' => false,
					'message' => "$keyname is required."
				]);
				exit();
			}
		}
		$controller = new PaymentsController();
        if($mode == 'add') {
            $info = $controller->store($data);
		} elseif($mode == 'search') {
			$info = $controller->getAllDataByField($data);
		} elseif($mode == 'single') {
			$info = $controller->getOneDataByField($data);
		} elseif($mode == 'download') {
			$info = $controller->getDataAndAssocByField($data);
        }
        if($info) {
			http_response_code(200);
			echo json_encode([
				'status' => true,
				'message' => 'Authentication successful.',
				'data' => $info
			]);
		} else {
			http_response_code(401);
			echo json_encode([
				'status' => false,
				'message' => 'Authentication failed.',
				'data' => []
			]);
		}
	} else {
		http_response_code(405);
		echo json_encode([
			'status' => false,
			'message' => 'Only POST requests are allowed.',
			'data' => []
		]);
	} 
?>