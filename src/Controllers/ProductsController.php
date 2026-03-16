<?php
	
	namespace App\Controllers;


	use App\Models\Product;

	class ProductsController {

		public function store($data) {
			$name = trim(htmlspecialchars($data['name']));
			$price = trim(htmlspecialchars($data['price']));
			$quantity = trim(htmlspecialchars($data['quantity']));
			$description = trim(htmlspecialchars($data['description']));

			if($name AND $price AND $quantity AND $description) {
				$inserted = Product::createProduct($name, $price, $quantity, $description);
				if($inserted) {
					return true;
				} else {
					return false;
				}
			}
		}

		public function update($data, $id) {
			$name = trim(htmlspecialchars($data['name']));
			$price = trim(htmlspecialchars($data['price']));
			$quantity = trim(htmlspecialchars($data['quantity']));
			$description = trim(htmlspecialchars($data['description']));

			if($name AND $price AND $description) {
				$updated = Product::updateProduct($name, $price, $quantity, $description, $id);

				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}

	}

?>
