<?php
	
	namespace App\Controllers;

	use App\Models\Region;

	class RegionsController {

		public function getAllRegions() {
			return Region::getAllRegions();					
		}

        public function getRegion($id) {
			return Region::getRegion($id);
		}

        public function changeStatus($id, $status) {
			return Region::changeStatus($id, $status);					
		}

        public function deleteRegion($id) {
			return Region::deleteRegion($id);					
		}

        public function store($data) {
			$name = trim(htmlspecialchars($data['name']));			

			if($name) {
				$inserted = Region::createRegion($name);
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
				$updated = Region::update($name, $id);
				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}

    }
?>