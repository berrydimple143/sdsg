<?php
	require "../../autoload.php";

	header("Content-Type: application/json");
	header("Access-Control-Allow-Methods: PUT");

	use App\Models\Product;
	use App\Controllers\ProductsController;	

	if($_SERVER['REQUEST_METHOD'] === "PUT") {

		$product = json_decode(file_get_contents("php://input"));
		$id = $product->id;		
		$id = filter_var($id, FILTER_VALIDATE_INT);
		

		if(!$id) {
			http_response_code(400);
			echo json_encode([
				'status' => false,
				'message' => 'Something is wrong.'
			]);
			exit();
		}

		$updateProduct = new ProductsController();		

		$data = [
			'name' => $product->name,
			'price' => $product->price,
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
		
		if($updateProduct->update($data, $id)) {
			http_response_code(200);

			echo json_encode([
				'status' => true,
				'message' => 'Product was updated successfully.',
				'data' => $data
			]);
		} else {
			http_response_code(404);
			echo json_encode([
				'status' => false,
				'message' => 'Product update failed.'
			]);
		}
	} else {
		http_response_code(405);
		echo json_encode([
			'status' => false,
			'message' => 'Only PUT requests are allowed.'
		]);
	}

?>