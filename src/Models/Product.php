<?php
	namespace App\Models;

	use App\Core\Database;
	use PDO;

	class Product {

		public static function getProducts() {
			$pdo = Database::connect();
			$products = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
			return $products->fetchAll(PDO::FETCH_ASSOC);
		}		

		public static function getProduct($id) {
			$pdo = Database::connect();
			$product = $pdo->query("SELECT * FROM products WHERE id=$id");
			return $product->fetch(PDO::FETCH_ASSOC);
		}

		public static function createProduct($name, $price, $quantity, $description) {
			$pdo = Database::connect();
			$product = $pdo->prepare("INSERT INTO products(name, price, quantity, description, created_at, updated_at) VALUES(:name, :price, :quantity, :description, :created_at, :updated_at)");
			return $product->execute([
				":name" =>$name,
				":price" => $price,
				":quantity" => $quantity,
				":description" => $description,
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);
		}

		public static function updateProduct($name, $price, $quantity, $description, $id) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$product = $pdo->prepare("UPDATE products SET name=?, price=?, quantity=?, description=?, updated_at=? WHERE id=?");
			return $product->execute([$name, $price, $quantity, $description, $updated_at, $id]);	
		}

		public static function deleteProduct($id) {
			$pdo = Database::connect();
			$product = $pdo->prepare("DELETE FROM products WHERE id=?");
			return $product->execute([$id]);			
		}
	}
?>