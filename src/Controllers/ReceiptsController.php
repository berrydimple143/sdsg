<?php
    namespace App\Controllers;
    use App\Models\Receipt;

    class ReceiptsController {        
        public function getReceipt($data) {
            $id = trim(htmlspecialchars($data['id']));
            $uid = trim(htmlspecialchars($data['uid']));
			return Receipt::getReceipt($id, $uid);
		}      
        public function checkReceipt($id) {
			return Receipt::checkReceipt($id);
		}
        public function addReceipt($data) {
            $id = trim(htmlspecialchars($data['id']));
            $uid = trim(htmlspecialchars($data['uid']));
            $receiver = trim(htmlspecialchars($data['receiver']));
            if($id AND $uid) {
                $inserted = Receipt::create($id, $uid, $receiver);
                if($inserted) {
                    return $inserted;
                } else {
                    return false;
                }
            }
		}
    }
?>