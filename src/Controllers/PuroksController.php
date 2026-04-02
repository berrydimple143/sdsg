<?php
    namespace App\Controllers;
    use App\Models\Purok;

    class PuroksController {

        public function getAllData() {
			return Purok::getAllPuroks();
		}

        public function getData($id) {
			return Purok::getPurok($id);
		}

		public function getAllDataWithId($field, $value) {
			return Purok::getAllPuroksById($field, $value);
		}

        public function getAllDataById($field, $value) {
			return Purok::getAllDataById($field, $value);					
		}

        public function changeStatus($id, $status) {
			return Purok::changeStatus($id, $status);					
		}

        public function deleteData($id) {
			return Purok::deletePurok($id);					
		}

        public function store($data) {
			$name = trim(htmlspecialchars($data['name']));	
            $barangay_id = trim(htmlspecialchars($data['barangay_id']));
            
			if($name AND $barangay_id) {
				$inserted = Purok::createPurok($name, $barangay_id);
				if($inserted) {
					return true;
				} else {
					return false;
				}
			}
		}

        public function update($data, $id) {
			$name = trim(htmlspecialchars($data['name']));
            if($name) {
				$updated = Purok::update($name, $id);
				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}

    }
?>