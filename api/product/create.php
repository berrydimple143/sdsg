<?php
	require "../../autoload.php";

	header("Content-Type: application/json");
	header("Access-Control-Allow-Methods: POST");

	use App\Controllers\ProductsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$newProduct = new ProductsController();		
		$product = json_decode(file_get_contents("php://input"));

		$data = [
			'name' => $product->name,
			'price' => $product->price,
			'quantity' => $product->quantity,
			'description' => $product->description
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
		
		if($newProduct->store($data)) {
			http_response_code(200);
			echo json_encode([
				'status' => true,
				'message' => 'Product was created successfully.',
				'data' => $data
			]);
		} else {
			http_response_code(400);
			echo json_encode([
				'status' => false,
				'message' => 'Product creation failed.'
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