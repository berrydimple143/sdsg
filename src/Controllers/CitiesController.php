<?php
    namespace App\Controllers;
    use App\Models\City;

    class CitiesController {

        public function getAllData() {
			return City::getAllCities();
		}
        public function getData($id) {
			return City::getCity($id);
		}

		public function getAllDataWithId($field, $value) {
			return City::getAllCitiesById($field, $value);					
		}

		public function getAllDataById($field, $value) {
			return City::getAllDataById($field, $value);					
		}

        public function changeStatus($id, $status) {
			return City::changeStatus($id, $status);					
		}

        public function deleteData($id) {
			return City::deleteCity($id);					
		}

        public function store($data) {
			$name = trim(htmlspecialchars($data['name']));	
            $province_id = trim(htmlspecialchars($data['province_id']));		

			if($name AND $province_id) {
				$inserted = City::createCity($name, $province_id);
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
				$updated = City::update($name, $id);
				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}
    }
?>