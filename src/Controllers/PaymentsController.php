<?php
    namespace App\Controllers;
    use App\Models\Payment;
    //use DateTime;

    class PaymentsController {
        public function store($data) {
            //$date = new DateTime(trim(htmlspecialchars($data['created_at'])));
            //$created_at = $date->format('Y-m-d H:i:s');
			$user_id = trim(htmlspecialchars($data['user_id']));
            $amount = trim(htmlspecialchars($data['amount']));            
            $created_at = date('Y-m-d H:i:s', strtotime(trim(htmlspecialchars($data['created_at']))));
            if($user_id AND $amount AND $created_at) {
                $inserted = Payment::create($user_id, $amount, $created_at);
                if($inserted) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function changeStatus($id, $status) {
			return Payment::changeStatus($id, $status);
		}

        public function getAllDataByField($data) {
            $user_id = trim(htmlspecialchars($data['user_id']));
            return Payment::getAllDataByField('user_id', $user_id, 'amount');
        }
    }
?>