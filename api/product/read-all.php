<?php
	require "../../autoload.php";

	header("Content-Type: application/json");

	use App\Models\Product;

	$allProducts = Product::getProducts();

	if(!empty($allProducts)) {
		$arr['data'] = [];

		foreach($allProducts as $product) {
			$product_item = [
				'name' => $product['name'],
				'price' => $product['price'],
				'description' => $product['description'],
				'created_at' => $product['created_at']
			];
			$arr['data'][] = $product_item;
		}
		http_response_code(200);
		echo json_encode($arr);
	} else {
		http_response_code(404);
		echo [
			'data' => [],
			'message' => 'No products yet.'
		];
	}

?>