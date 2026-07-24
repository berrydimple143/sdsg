<?php
    namespace App\Models;
    use App\Core\Database;
	use PDO;

    class Payment {
        
        public static function getAllDataByField($field, $value, $order) {
			$pdo = Database::connect();
			$payments = $pdo->query("SELECT pay.id AS id, pay.user_id AS user_id, rc.id AS rid, rc.receiver AS receiver, rc.issuer AS issuer, rc.number AS number, DATE_FORMAT(pay.created_at, '%M %d, %Y') AS created_at, pay.created_at AS paid_at, pay.amount AS amount, pay.type AS type, COALESCE(CONCAT(UPPER(SUBSTRING(usr.firstname, 1, 1)), LOWER(SUBSTRING(usr.firstname, 2))), '') AS firstname, COALESCE(CONCAT(UPPER(SUBSTRING(usr.lastname, 1, 1)), LOWER(SUBSTRING(usr.lastname, 2))), '') AS lastname, per.address AS address, COALESCE(CONCAT(UPPER(SUBSTRING(bar.name, 1, 1)), LOWER(SUBSTRING(bar.name, 2))), '') AS barangay, COALESCE(CONCAT(UPPER(SUBSTRING(ct.name, 1, 1)), LOWER(SUBSTRING(ct.name, 2))), '') AS city FROM payments pay LEFT JOIN users usr ON pay.user_id = usr.id LEFT JOIN receipts rc ON pay.id = rc.payment_id LEFT JOIN personal_information per ON usr.id = per.user_id LEFT JOIN barangays bar ON per.barangay_id = bar.id LEFT JOIN cities ct ON per.city_id = ct.id WHERE $field = '$value' ORDER BY $order");			
			return $payments->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getSumWithCondition($condition) {
			$pdo = Database::connect();
			$payment = $pdo->query("SELECT SUM(amount) AS amount FROM payments WHERE $condition");
			return $payment->fetch(PDO::FETCH_OBJ);
		}

        public static function deleteData($id) {
			$pdo = Database::connect();
			$payment = $pdo->prepare("DELETE FROM payments WHERE id=?");
			return $payment->execute([$id]);
		}

        public static function getData($id) {
			$pdo = Database::connect();
			$payment = $pdo->query("SELECT * FROM payments WHERE id='$id'");
			return $payment->fetch(PDO::FETCH_OBJ);
		}

        public static function changeStatus($id, $status) {
			$pdo = Database::connect();
			$purok = $pdo->prepare("UPDATE user_types SET classification=? WHERE user_id=?");
			return $purok->execute([$status, $id]);	
		}

        public static function update($amount, $id) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$payment = $pdo->prepare("UPDATE payments SET amount=?, updated_at=? WHERE id=?");
			return $payment->execute([$amount, $updated_at, $id]);
		}

		private static function getReceiptNumber() {
			$pdo = Database::connect();
			$receipt = $pdo->query("SELECT COUNT(*) FROM receipts");
			$total = $receipt->fetchColumn() + 1;
			$strTotal = (string)$total;
			$num = "000000";
			if(strlen($strTotal) < 2) {
				$num = $num . $total;
			} elseif(strlen($strTotal) < 3) {
				$num = substr($num, 0, 5) . $total;
			} elseif(strlen($strTotal) < 4) {
				$num = substr($num, 0, 4) . $total;
			} elseif(strlen($strTotal) < 5) {
				$num = substr($num, 0, 3) . $total;
			} elseif(strlen($strTotal) < 6) {
				$num = substr($num, 0, 2) . $total;
			} elseif(strlen($strTotal) < 7) {
				$num = substr($num, 0, 1) . $total;
			}
			return $num;
		}

        public static function create($user_id, $amount, $type, $created_at, $receiver) {
            $pdo = Database::connect();
			$payment = $pdo->prepare("INSERT INTO payments(user_id, amount, type, created_at, updated_at) VALUES(:user_id, :amount, :type, :created_at, :updated_at)");
            $inserted = $payment->execute([
				":user_id" => $user_id,
				":amount" => $amount,
				":type" => $type,
				":created_at" => $created_at,
				":updated_at" => $created_at
			]);
            if($inserted) {     
				$pid = $pdo->lastInsertId(); 
				$user = $pdo->query("SELECT * FROM users WHERE id='$user_id'");
			    $usr = $user->fetch(PDO::FETCH_OBJ);
                $classification = 'paying';     
                $userType = $pdo->prepare("UPDATE user_types SET classification=? WHERE user_id=?");
                $typeUpdated = $userType->execute([$classification, $user_id]);
                if($typeUpdated) {
                    $userUpdated = $pdo->prepare("UPDATE users SET updated_at=? WHERE id=?");
                    $userUpdated->execute([$created_at, $user_id]);
					if($userUpdated) {
						$rname = ucfirst($usr->firstname).' '.ucfirst($usr->lastname);
						if(!empty($receiver)) {
							$rname = $receiver;
						}
						$receipt = $pdo->prepare("INSERT INTO receipts (payment_id, receiver, issuer, number, created_at, updated_at) VALUES(:payment_id, :receiver, :issuer, :number, :created_at, :updated_at)");
						$rInserted = $receipt->execute([
							":payment_id" => $pid,
							":receiver" => $rname,
							":issuer" => $rname,
							":number" => self::getReceiptNumber(),
							":created_at" => $created_at,
							":updated_at" => $created_at
						]);
						if($rInserted) {
							$rid = $pdo->lastInsertId();
							$rc = $pdo->query("SELECT rc.id AS id, rc.receiver AS receiver, rc.issuer AS issuer, rc.number AS number, DATE_FORMAT(rc.created_at, '%M %d, %Y') AS created_at, pay.amount AS amount, pay.type AS type, COALESCE(CONCAT(UPPER(SUBSTRING(usr.firstname, 1, 1)), LOWER(SUBSTRING(usr.firstname, 2))), '') AS firstname, COALESCE(CONCAT(UPPER(SUBSTRING(usr.lastname, 1, 1)), LOWER(SUBSTRING(usr.lastname, 2))), '') AS lastname, per.address AS address, COALESCE(CONCAT(UPPER(SUBSTRING(bar.name, 1, 1)), LOWER(SUBSTRING(bar.name, 2))), '') AS barangay, COALESCE(CONCAT(UPPER(SUBSTRING(ct.name, 1, 1)), LOWER(SUBSTRING(ct.name, 2))), '') AS city FROM receipts rc LEFT JOIN payments pay ON rc.payment_id = pay.id LEFT JOIN users usr ON pay.user_id = usr.id LEFT JOIN personal_information per ON usr.id = per.user_id LEFT JOIN barangays bar ON per.barangay_id = bar.id LEFT JOIN cities ct ON per.city_id = ct.id WHERE rc.id='$rid'");
			    			return $rc->fetch(PDO::FETCH_OBJ);
						} else {
							return false;
						}
					} else {
						return false;
					}
                    
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }   
    }
?>