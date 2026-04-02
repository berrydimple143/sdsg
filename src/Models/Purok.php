<?php
    namespace App\Models;
    use App\Core\Database;
	use PDO;
    
    class Purok {

        public static function getAllPuroks() {
			$pdo = Database::connect();
			$puroks = $pdo->query("SELECT reg.name AS rname, ct.name AS cname, prov.name AS pname, dist.name AS dname, bar.name AS bname, prk.name AS prkname, prk.id AS id, prk.status AS status, prk.created_at AS created_at FROM puroks AS prk INNER JOIN barangays AS bar ON prk.barangay_id = bar.id INNER JOIN districts AS dist ON bar.district_id = dist.id INNER JOIN cities AS ct ON dist.city_id = ct.id INNER JOIN provinces AS prov ON ct.province_id = prov.id INNER JOIN regions AS reg ON prov.region_id = reg.id ORDER BY prk.name");
			return $puroks->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getAllPuroksById($field, $value) {
			$pdo = Database::connect();
			$puroks = $pdo->query("SELECT id, name, status, created_at FROM puroks WHERE $field = '$value' AND status = 1 ORDER BY name");
			return $puroks->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function getAllDataById($field, $value) {
			$pdo = Database::connect();
			$districts = $pdo->query("SELECT id, name, status, created_at FROM puroks WHERE $field = '$value' ORDER BY name");
			return $districts->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function getPurok($id) {
			$pdo = Database::connect();
			$purok = $pdo->query("SELECT * FROM puroks WHERE id='$id'");
			return $purok->fetch(PDO::FETCH_OBJ);
		}

        public static function changeStatus($id, $status) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$purok = $pdo->prepare("UPDATE puroks SET status=?, updated_at=? WHERE id=?");
			return $purok->execute([$status, $updated_at, $id]);	
		}        

        public static function createPurok($name, $barangay_id) {
			$pdo = Database::connect();
			$purok = $pdo->prepare("INSERT INTO puroks(barangay_id, name, created_at, updated_at) VALUES(:barangay_id, :name, :created_at, :updated_at)");
			return $purok->execute([
				":barangay_id" => $barangay_id,
				":name" => $name,				
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);
		}

        public static function update($name, $id) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$purok = $pdo->prepare("UPDATE puroks SET name=?, updated_at=? WHERE id=?");
			return $purok->execute([$name, $updated_at, $id]);
		}

        public static function deletePurok($id) {
			$pdo = Database::connect();
			$purok = $pdo->prepare("DELETE FROM puroks WHERE id=?");
			return $purok->execute([$id]);
		}

    }
?>