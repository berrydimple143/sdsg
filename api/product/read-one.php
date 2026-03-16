<?php
	
	require "../../autoload.php";

	header("Content-Type: application/json");

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

	$product = Product::getProduct($id);

	if($product) {
		http_response_code(200);
		echo json_encode([
			'status' => true,
			'product' => $product
		]);
	} else {
		http_response_code(404);
		echo json_encode([
			'status' => false,
			'message' => 'Product not found.'
		]);
	}
?>