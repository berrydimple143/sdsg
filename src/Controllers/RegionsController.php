<?php
	
	namespace App\Controllers;

	use App\Models\Region;

	class RegionsController {

		public function getAllRegions() {
			return Region::getAllRegions();					
		}

        public function getRegion($id) {
			return Region::getAllRegions($id);					
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
			$price = trim(htmlspecialchars($data['price']));
			$quantity = trim(htmlspecialchars($data['quantity']));
			$description = trim(htmlspecialchars($data['description']));

			if($name AND $price AND $description) {
				$updated = Region::update($name, $price, $quantity, $description, $id);

				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}

    }
?>