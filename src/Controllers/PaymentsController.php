<?php
    namespace App\Controllers;
    use App\Models\Payment;
    use App\Models\User;
    use DateTime;

    class PaymentsController {
        public function store($data) {
            //$date = new DateTime(trim(htmlspecialchars($data['created_at'])));
            //$created_at = $date->format('Y-m-d H:i:s');
			$user_id = trim(htmlspecialchars($data['user_id']));
            $amount = trim(htmlspecialchars($data['amount']));        
            $type = trim(htmlspecialchars($data['type']));     
            $created_at = date('Y-m-d H:i:s', strtotime(trim(htmlspecialchars($data['created_at']))));
            if($user_id AND $amount AND $created_at) {
                $inserted = Payment::create($user_id, $amount, $type, $created_at);
                if($inserted) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function update($data, $id) {
			$amount = trim(htmlspecialchars($data['name']));
            if($amount) {
				$updated = Payment::update($amount, $id);
				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}

        public function deleteData($id) {
			return Payment::deleteData($id);					
		}

        public function getSumWithCondition($condition) {            
			return Payment::getSumWithCondition($condition);					
		}

        public function getData($id) {
			return Payment::getData($id);
		}

        public function getOneDataByField($data) {
            $user_id = trim(htmlspecialchars($data['user_id']));
            return User::getOneDataByField('id', $user_id);
        }

        public function getDataAndAssocByField($data) {
            $user_id = trim(htmlspecialchars($data['user_id']));
            return User::getDataAndAssocByField("usr.id", $user_id);
        }

        public function changeStatus($id, $status) {
			return Payment::changeStatus($id, $status);
		}

        public function changeUserStatus($id, $status) {
			return User::changeStatus($id, $status);
		}

        public function getAllDataByField($data) {
            $user_id = trim(htmlspecialchars($data['user_id']));
            return Payment::getAllDataByField('user_id', $user_id, 'created_at DESC');
        }
    }
?>