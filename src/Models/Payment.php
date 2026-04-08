<?php
    namespace App\Models;
    use App\Core\Database;
	use PDO;

    class Payment {
        
        public static function getAllDataByField($field, $value, $order) {
			$pdo = Database::connect();
			$districts = $pdo->query("SELECT * FROM payments WHERE $field = '$value' ORDER BY $order");
			return $districts->fetchAll(PDO::FETCH_ASSOC);
		}

        public static function changeStatus($id, $status) {
			$pdo = Database::connect();
			$purok = $pdo->prepare("UPDATE user_types SET classification=? WHERE user_id=?");
			return $purok->execute([$status, $id]);	
		}

        public static function create($user_id, $amount, $created_at) {
            $pdo = Database::connect();
			$payment = $pdo->prepare("INSERT INTO payments(user_id, amount, created_at, updated_at) VALUES(:user_id, :amount, :created_at, :updated_at)");
            $inserted = $payment->execute([
				":user_id" => $user_id,
				":amount" => $amount,
				":created_at" => $created_at,
				":updated_at" => $created_at
			]);
            if($inserted) {         
                $classification = 'paying';     
                $user = $pdo->prepare("UPDATE user_types SET classification=? WHERE user_id=?");
                $updated = $user->execute([$classification, $user_id]);
                if($updated) {
                    $user2 = $pdo->prepare("UPDATE users SET updated_at=? WHERE id=?");
                    $user2->execute([$created_at, $user_id]);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }   
    }
?>