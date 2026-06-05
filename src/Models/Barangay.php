<?php
    namespace App\Models;
    use App\Core\Database;
	use PDO;

    class Barangay {

        public static function getAllBarangays() {
			$pdo = Database::connect();
			$barangays = $pdo->query("SELECT reg.name AS rname, ct.name AS cname, prov.name AS pname, dist.name AS dname, bar.id AS id, bar.name AS bname, bar.status AS status, bar.created_at AS created_at FROM barangays AS bar INNER JOIN districts AS dist ON bar.district_id = dist.id INNER JOIN cities AS ct ON dist.city_id = ct.id INNER JOIN provinces AS prov ON ct.province_id = prov.id INNER JOIN regions AS reg ON prov.region_id = reg.id ORDER BY bar.name");
			return $barangays->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getAllBarangaysById($field, $value) {
			$pdo = Database::connect();
			$barangays = $pdo->query("SELECT id, name, status, created_at FROM barangays WHERE $field = '$value' AND status = 1 ORDER BY name");
			return $barangays->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function getAllDataById($field, $value) {
			$pdo = Database::connect();
			$districts = $pdo->query("SELECT id, name, status, created_at FROM barangays WHERE $field = '$value' ORDER BY name");
			return $districts->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function getBarangay($id) {
			$pdo = Database::connect();
			$barangay = $pdo->query("SELECT * FROM barangays WHERE id='$id'");
			return $barangay->fetch(PDO::FETCH_OBJ);
		}

		public static function getOneDataByField($field, $value) {
			$pdo = Database::connect();
			$barangay = $pdo->query("SELECT * FROM barangays WHERE $field = '$value'");
			return $barangay->fetch(PDO::FETCH_OBJ);
		}

        public static function changeStatus($id, $status) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$barangay = $pdo->prepare("UPDATE barangays SET status=?, updated_at=? WHERE id=?");
			return $barangay->execute([$status, $updated_at, $id]);	
		}        

        public static function createBarangay($name, $district_id) {
			$pdo = Database::connect();
			$barangay = $pdo->prepare("INSERT INTO barangays(district_id, name, created_at, updated_at) VALUES(:district_id, :name, :created_at, :updated_at)");
			return $barangay->execute([
				":district_id" => $district_id,
				":name" => $name,				
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);
		}

        public static function update($name, $id) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$barangay = $pdo->prepare("UPDATE barangays SET name=?, updated_at=? WHERE id=?");
			return $barangay->execute([$name, $updated_at, $id]);
		}

        public static function deleteBarangay($id) {
			$pdo = Database::connect();
			$barangay = $pdo->prepare("DELETE FROM barangays WHERE id=?");
			return $barangay->execute([$id]);
		}

    }
?>