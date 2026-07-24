
<?php
	require "../../autoload.php";
	header("Content-Type: application/json");	
	use App\Controllers\ReceiptsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {		
		$input = json_decode(file_get_contents("php://input"));
		$mode = $input->mode;
        $data = [
			'id' => $input->id,
			'uid' => $input->uid,
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
		$controller = new ReceiptsController();
        if($mode == 'single') {
            $info = $controller->getReceipt($data);
		} elseif($mode == 'check') {
			$info = $controller->checkReceipt($input->id);
		} 
        if($info) {
			http_response_code(200);
			echo json_encode([
				'status' => true,
				'message' => 'Authentication successful.',
				'data' => $info
			]);
		} else {
			http_response_code(404);
			echo json_encode([
				'status' => false,
				'message' => 'Not found.',
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