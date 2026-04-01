<?php
    namespace App\Controllers;
    use App\Models\District;

    class DistrictsController {

        public function getAllData() {
			return District::getAllDistricts();					
		}

        public function getData($id) {
			return District::getDistrict($id);
		}

		public function getAllDataWithId($field, $value) {
			return District::getAllDistrictsById($field, $value);
		}

        public function changeStatus($id, $status) {
			return District::changeStatus($id, $status);					
		}

        public function deleteData($id) {
			return District::deleteDistrict($id);					
		}

        public function store($data) {
			$name = trim(htmlspecialchars($data['name']));	
            $city_id = trim(htmlspecialchars($data['city_id']));		

			if($name AND $city_id) {
				$inserted = District::createDistrict($name, $city_id);
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
				$updated = District::update($name, $id);
				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}

    }
?>