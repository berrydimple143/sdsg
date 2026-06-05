<?php
    namespace App\Models;
    use App\Core\Database;
	use PDO;

    class City {

        public static function getAllCities() {
			$pdo = Database::connect();
			$cities = $pdo->query("SELECT prov.name AS pname, reg.name AS rname, ct.id AS id, ct.name AS cname, ct.status AS status, ct.created_at AS created_at FROM cities AS ct INNER JOIN provinces AS prov ON ct.province_id = prov.id INNER JOIN regions AS reg ON prov.region_id = reg.id ORDER BY ct.name");
			return $cities->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getAllCitiesById($field, $value) {
			$pdo = Database::connect();
			$cities = $pdo->query("SELECT id, name, status, created_at FROM cities WHERE $field = '$value' AND status = 1 ORDER BY name");
			return $cities->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getOneDataByField($field, $value) {
			$pdo = Database::connect();
			$city = $pdo->query("SELECT * FROM cities WHERE $field = '$value'");
			return $city->fetch(PDO::FETCH_OBJ);
		}

		public static function getAllDataById($field, $value) {
			$pdo = Database::connect();
			$cities = $pdo->query("SELECT id, name, status, created_at FROM cities WHERE $field = '$value' ORDER BY name");
			return $cities->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function getCity($id) {
			$pdo = Database::connect();
			$city = $pdo->query("SELECT * FROM cities WHERE id='$id'");
			return $city->fetch(PDO::FETCH_OBJ);
		}

        public static function changeStatus($id, $status) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$city = $pdo->prepare("UPDATE cities SET status=?, updated_at=? WHERE id=?");
			return $city->execute([$status, $updated_at, $id]);	
		}

        public static function getCitiesWithStatus($status) {
			$pdo = Database::connect();
			$cities = $pdo->query("SELECT * FROM cities WHERE status='$condition' ORDER BY name");
			return $cities->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function createCity($name, $province_id) {
			$pdo = Database::connect();
			$city = $pdo->prepare("INSERT INTO cities(province_id, name, created_at, updated_at) VALUES(:province_id, :name, :created_at, :updated_at)");
			return $city->execute([
				":province_id" => $province_id,
				":name" => $name,				
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);
		}

        public static function update($name, $id) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$city = $pdo->prepare("UPDATE cities SET name=?, updated_at=? WHERE id=?");
			return $city->execute([$name, $updated_at, $id]);	
		}

        public static function deleteCity($id) {
			$pdo = Database::connect();
			$city = $pdo->prepare("DELETE FROM cities WHERE id=?");
			return $city->execute([$id]);
		}

    }
?>