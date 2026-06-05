<?php
    namespace App\Models;
    use App\Core\Database;
	use PDO;

    class District {

        public static function getAllDistricts() {
			$pdo = Database::connect();
			$districts = $pdo->query("SELECT reg.name AS rname, ct.name AS cname, prov.name AS pname, dist.name AS dname, dist.id AS id, dist.status AS status, dist.created_at AS created_at FROM districts AS dist INNER JOIN cities AS ct ON dist.city_id = ct.id INNER JOIN provinces AS prov ON ct.province_id = prov.id INNER JOIN regions AS reg ON prov.region_id = reg.id ORDER BY dist.name");
			return $districts->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getAllDistrictsById($field, $value) {
			$pdo = Database::connect();
			$districts = $pdo->query("SELECT id, name, status, created_at FROM districts WHERE $field = '$value' AND status = 1 ORDER BY name");
			return $districts->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getOneDataByField($field, $value) {
			$pdo = Database::connect();
			$district = $pdo->query("SELECT * FROM districts WHERE $field = '$value'");
			return $district->fetch(PDO::FETCH_OBJ);
		}

		public static function getAllDataById($field, $value) {
			$pdo = Database::connect();
			$districts = $pdo->query("SELECT id, name, status, created_at FROM districts WHERE $field = '$value' ORDER BY name");
			return $districts->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function getDistrict($id) {
			$pdo = Database::connect();
			$district = $pdo->query("SELECT * FROM districts WHERE id='$id'");
			return $district->fetch(PDO::FETCH_OBJ);
		}

        public static function changeStatus($id, $status) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$district = $pdo->prepare("UPDATE districts SET status=?, updated_at=? WHERE id=?");
			return $district->execute([$status, $updated_at, $id]);	
		}        

        public static function createDistrict($name, $city_id) {
			$pdo = Database::connect();
			$district = $pdo->prepare("INSERT INTO districts(city_id, name, created_at, updated_at) VALUES(:city_id, :name, :created_at, :updated_at)");
			return $district->execute([
				":city_id" => $city_id,
				":name" => $name,				
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);
		}

        public static function update($name, $id) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$district = $pdo->prepare("UPDATE districts SET name=?, updated_at=? WHERE id=?");
			return $district->execute([$name, $updated_at, $id]);
		}

        public static function deleteDistrict($id) {
			$pdo = Database::connect();
			$district = $pdo->prepare("DELETE FROM districts WHERE id=?");
			return $district->execute([$id]);
		}

    }
?>