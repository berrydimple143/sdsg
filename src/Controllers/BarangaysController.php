<?php
    namespace App\Controllers;
    use App\Models\Barangay;

    class BarangaysController {

        public function getAllData() {
			return Barangay::getAllBarangays();					
		}

        public function getData($id) {
			return Barangay::getBarangay($id);
		}

		public function getAllDataWithId($field, $value) {
			return Barangay::getAllBarangaysById($field, $value);
		}

        public function getAllDataById($field, $value) {
			return Barangay::getAllDataById($field, $value);					
		}

        public function changeStatus($id, $status) {
			return Barangay::changeStatus($id, $status);					
		}

        public function deleteData($id) {
			return Barangay::deleteBarangay($id);					
		}

        public function store($data) {
			$name = trim(htmlspecialchars($data['name']));	
            $district_id = trim(htmlspecialchars($data['district_id']));		

			if($name AND $district_id) {
				$inserted = Barangay::createBarangay($name, $district_id);
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
				$updated = Barangay::update($name, $id);
				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}

    }
?>