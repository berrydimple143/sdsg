<?php
	
	namespace App\Controllers;

	use App\Models\Province;

	class ProvincesController {

		public function getAllProvinces() {
			return Province::getAllProvinces();					
		}

        public function getProvince($id) {
			return Province::getProvince($id);					
		}

		public function getData($id) {
			return Province::getProvince($id);					
		}

        public function changeStatus($id, $status) {
			return Province::changeStatus($id, $status);					
		}

        public function deleteData($id) {
			return Province::deleteProvince($id);					
		}

        public function store($data) {
			$name = trim(htmlspecialchars($data['name']));
			$region_id = trim(htmlspecialchars($data['region_id']));			

			if($name AND $region_id) {
				$inserted = Province::createProvince($name, $region_id);
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
				$updated = Province::update($name, $id);
				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}

    }
?>