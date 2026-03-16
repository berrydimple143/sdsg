<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	header("Access-Control-Allow-Methods: DELETE");

	use App\Models\Product;

	$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

	if(!$id) {
		http_response_code(400);
		echo json_encode([
			'status' => false,
			'message' => 'Something is wrong.'
		]);
		exit();
	}

	if($_SERVER['REQUEST_METHOD'] === "DELETE") {

		$product = Product::getProduct($id);

		if($product) {
			$deleted = Product::deleteProduct($id);
			if($deleted) {
				http_response_code(200);

				echo json_encode([
					'status' => true,
					'message' => 'Product deleted successfully.'
				]);
			} else {
				echo json_encode([
					'status' => false,
					'message' => 'Product deletion failed.'
				]);
			}
			
		} else {
			http_response_code(404);
			echo json_encode([
				'status' => false,
				'message' => 'Product not found.'
			]);
		}
	} else {
		http_response_code(405);
		echo json_encode([
			'status' => false,
			'message' => 'Only DELETE requests are allowed.'
		]);
	}
?>