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
    }
?>