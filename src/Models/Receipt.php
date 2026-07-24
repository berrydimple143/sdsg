<?php
    namespace App\Models;
    use App\Core\Database;
	use PDO;

    class Receipt {

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

        public static function checkReceipt($id) {
            $pdo = Database::connect();			
			$rc = $pdo->query("SELECT COUNT(*) FROM receipts WHERE id = '$id'");
			return $rc->fetchColumn();
        }

        public static function create($id, $uid, $receiver) {
            $pdo = Database::connect();
            $user = $pdo->query("SELECT firstname, lastname FROM users WHERE id=$uid");
			$usr = $user->fetch(PDO::FETCH_OBJ);
            $created_at = date('Y-m-d H:i:s');
            $userUpdated = $pdo->prepare("UPDATE users SET updated_at=? WHERE id=?");
            $userUpdated->execute([$created_at, $uid]);
            if($userUpdated) {
                $rname = ucfirst($usr->firstname).' '.ucfirst($usr->lastname);
                if(!empty($receiver)) {
                    $rname = $receiver;
                }
                $receipt = $pdo->prepare("INSERT INTO receipts(payment_id, receiver, issuer, number, created_at, updated_at) VALUES(:payment_id, :receiver, :issuer, :number, :created_at, :updated_at)");
                $rInserted = $receipt->execute([
                    ":payment_id" => $id,
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
        }   

        public static function getReceipt($id, $uid) {
            $pdo = Database::connect();
            $rc = $pdo->query("SELECT rc.id AS id, rc.receiver AS receiver, rc.issuer AS issuer, rc.number AS number, DATE_FORMAT(rc.created_at, '%M %d, %Y') AS created_at, pay.amount AS amount, pay.type AS description, COALESCE(CONCAT(UPPER(SUBSTRING(usr.firstname, 1, 1)), LOWER(SUBSTRING(usr.firstname, 2))), '') AS firstname, COALESCE(CONCAT(UPPER(SUBSTRING(usr.lastname, 1, 1)), LOWER(SUBSTRING(usr.lastname, 2))), '') AS lastname, per.address AS address, COALESCE(CONCAT(UPPER(SUBSTRING(bar.name, 1, 1)), LOWER(SUBSTRING(bar.name, 2))), '') AS barangay, COALESCE(CONCAT(UPPER(SUBSTRING(ct.name, 1, 1)), LOWER(SUBSTRING(ct.name, 2))), '') AS city FROM receipts rc LEFT JOIN payments pay ON rc.payment_id = pay.id LEFT JOIN users usr ON pay.user_id = usr.id LEFT JOIN personal_information per ON usr.id = per.user_id LEFT JOIN barangays bar ON per.barangay_id = bar.id LEFT JOIN cities ct ON per.city_id = ct.id WHERE rc.payment_id='$id'");
			$result = $rc->fetch(PDO::FETCH_OBJ);
            if($result) {
                return $result;
            } else {
                $user = $pdo->query("SELECT * FROM users WHERE id='$uid'");
			    $usr = $user->fetch(PDO::FETCH_OBJ);
                $rname = ucfirst($usr->firstname).' '.ucfirst($usr->lastname);
                if(!empty($receiver)) {
                    $rname = $receiver;
                }
                $receipt = $pdo->prepare("INSERT INTO receipts(payment_id, receiver, issuer, number, created_at, updated_at) VALUES(:payment_id, :receiver, :issuer, :number, :created_at, :updated_at)");
                $rInserted = $receipt->execute([
                    ":payment_id" => $pid,
                    ":receiver" => $rname,
                    ":issuer" => $rname,
                    ":number" => self::getReceiptNumber(),
                    ":created_at" => $created_at,
                    ":updated_at" => $created_at
                ]);
                if($rInserted) {
                    $rc = $pdo->query("SELECT rc.id AS id, rc.receiver AS receiver, rc.issuer AS issuer, rc.number AS number, DATE_FORMAT(rc.created_at, '%M %d, %Y') AS created_at, pay.amount AS amount, pay.type AS description, COALESCE(CONCAT(UPPER(SUBSTRING(usr.firstname, 1, 1)), LOWER(SUBSTRING(usr.firstname, 2))), '') AS firstname, COALESCE(CONCAT(UPPER(SUBSTRING(usr.lastname, 1, 1)), LOWER(SUBSTRING(usr.lastname, 2))), '') AS lastname, per.address AS address, COALESCE(CONCAT(UPPER(SUBSTRING(bar.name, 1, 1)), LOWER(SUBSTRING(bar.name, 2))), '') AS barangay, COALESCE(CONCAT(UPPER(SUBSTRING(ct.name, 1, 1)), LOWER(SUBSTRING(ct.name, 2))), '') AS city FROM receipts rc LEFT JOIN payments pay ON rc.payment_id = pay.id LEFT JOIN users usr ON pay.user_id = usr.id LEFT JOIN personal_information per ON usr.id = per.user_id LEFT JOIN barangays bar ON per.barangay_id = bar.id LEFT JOIN cities ct ON per.city_id = ct.id WHERE rc.id='$id'");
                    return $rc->fetch(PDO::FETCH_OBJ);
                } else {
                    return false;
                }
            }
        }

    }
?>