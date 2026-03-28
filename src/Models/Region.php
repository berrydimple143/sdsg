<?php
	namespace App\Models;

	use App\Core\Database;
	use PDO;

	class Region {
        public static function getAllRegions() {
			$pdo = Database::connect();
			$regions = $pdo->query("SELECT id, name, status, created_at FROM regions ORDER BY name");
			return $regions->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function getRegion($id) {
			$pdo = Database::connect();
			$region = $pdo->query("SELECT * FROM regions WHERE id='$id'");
			return $region->fetch(PDO::FETCH_OBJ);
		}

        public static function getRegionsWithStatus($status) {
			$pdo = Database::connect();
			$regions = $pdo->query("SELECT * FROM regions WHERE status='$condition' ORDER BY name");
			return $regions->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function createRegion($name) {
			$pdo = Database::connect();
			$region = $pdo->prepare("INSERT INTO regions(name, created_at, updated_at) VALUES(:name, :created_at, :updated_at)");
			return $region->execute([
				":name" =>$name,				
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);
		}

        public static function deleteRegion($id) {
			$pdo = Database::connect();
			$region = $pdo->prepare("DELETE FROM regions WHERE id=?");
			return $region->execute([$id]);			
		}
    }

?>