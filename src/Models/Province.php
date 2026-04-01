<?php 
    namespace App\Models;
    use App\Core\Database;
	use PDO;

    class Province {
        public static function getAllProvinces() {
			$pdo = Database::connect();
			$provinces = $pdo->query("SELECT reg.name AS rname, prov.id AS id, prov.name AS provname, prov.status AS status, prov.created_at AS created_at FROM provinces AS prov INNER JOIN regions AS reg ON prov.region_id = reg.id ORDER BY prov.name");
			return $provinces->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getAllProvincesById($field, $value) {
			$pdo = Database::connect();
			$provinces = $pdo->query("SELECT id, name, status, created_at FROM provinces WHERE $field = '$value' AND status = 1 ORDER BY name");
			return $provinces->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getAllDataById($field, $value) {
			$pdo = Database::connect();
			$provinces = $pdo->query("SELECT id, name, status, created_at FROM provinces WHERE $field = '$value' ORDER BY name");
			return $provinces->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function getProvince($id) {
			$pdo = Database::connect();
			$province = $pdo->query("SELECT * FROM provinces WHERE id='$id'");
			return $province->fetch(PDO::FETCH_OBJ);
		}

        public static function changeStatus($id, $status) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$province = $pdo->prepare("UPDATE provinces SET status=?, updated_at=? WHERE id=?");
			return $province->execute([$status, $updated_at, $id]);	
		}

        public static function getProvincesWithStatus($status) {
			$pdo = Database::connect();
			$provinces = $pdo->query("SELECT * FROM provinces WHERE status='$condition' ORDER BY name");
			return $provinces->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function createProvince($name, $region_id) {
			$pdo = Database::connect();
			$province = $pdo->prepare("INSERT INTO provinces(region_id, name, created_at, updated_at) VALUES(:region_id, :name, :created_at, :updated_at)");
			return $province->execute([
				":region_id" =>$region_id,
				":name" =>$name,				
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);
		}

        public static function update($name, $id) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$province = $pdo->prepare("UPDATE provinces SET name=?, updated_at=? WHERE id=?");
			return $province->execute([$name, $updated_at, $id]);	
		}

        public static function deleteProvince($id) {
			$pdo = Database::connect();
			$province = $pdo->prepare("DELETE FROM provinces WHERE id=?");
			return $province->execute([$id]);
		}
    }
?>