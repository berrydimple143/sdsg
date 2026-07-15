<?php	
	namespace App\Controllers;

	use App\Models\User;
	use App\Models\Barangay;
	use App\Models\District;
	use App\Models\City;
	use App\Models\Province;
	use DateTime;

	class UsersController {

		public function getData($id) {
			return User::getBeneficiary($id);
		}

		public function deleteData($id) {
			return User::deleteData($id);					
		}

		public function changeStatus($id, $status) {
			return User::changeStatus($id, $status);					
		}

		public function getAllUserWithDetails() {
			return User::getAllUserWithDetails();					
		}

		public function findUsersByConditionWithDetails($id, $page) {
			$cond = 'usr.id=$id';
			if($page == 'region') {
				$cond = "per.region_id = $id";
			} else if($page == 'province') {
				$cond = "per.province_id = $id";
			} else if($page == 'city') {
				$cond = "per.city_id = $id";
			} else if($page == 'district') {
				$cond = "per.district_id = $id";
			} else if($page == 'barangay') {
				$cond = "per.barangay_id = $id";
			}			
			return User::findUsersByConditionWithDetails($cond);					
		}

		public function getAllUserWithSearch($search) {
			return User::getAllUserWithSearch($search);				
		}

		public function lastDay($month) {
			$yr = (string)date('Y');
			$fd = $yr.'-'.$month.'-'.(string)date('d');
			$sd = new DateTime($fd);			
			$sd->modify('last day of this month');
			return $sd->format('d');
		}

		public function getBeneficiaryPerMonth($month, $mtype) {
			$yr = (string)date('Y');		
			$lastDay = $this->lastDay($month);
			$before = $yr.'-'.$month.'-01';
			$after = $yr.'-'.$month.'-'.$lastDay;
			return User::getBeneficiaryPerMonth($before, $after, $mtype);
		}

		public function store($data) {
			$firstname = trim(htmlspecialchars($data['firstname']));
			$lastname = trim(htmlspecialchars($data['lastname']));
			$username = trim(htmlspecialchars($data['username']));
			$email = trim(htmlspecialchars($data['email']));
			$password = trim(htmlspecialchars($data['password']));
			$middlename = trim(htmlspecialchars($data['middlename']));
			$phone = trim(htmlspecialchars($data['phone']));
			$mobile = trim(htmlspecialchars($data['mobile']));

			if($firstname AND $lastname AND $username AND $email AND $password) {
				$inserted = User::createUser($firstname, $middlename, $lastname, $email, $username, $password, $phone, $mobile, 1);
				if($inserted) {
					return true;
				} else {
					return false;
				}
			}
		}

		public function storeMemberFromExcel($data) {
			$firstname = trim(htmlspecialchars($data['firstname']));
			$lastname = trim(htmlspecialchars($data['lastname']));
			$middlename = trim(htmlspecialchars($data['middlename']));
			$barangay = trim(htmlspecialchars($data['barangay']));
			$idPay = trim(htmlspecialchars($data['idPay']));
			$janPay = trim(htmlspecialchars($data['janPay']));
			$febPay = trim(htmlspecialchars($data['febPay']));
			$marPay = trim(htmlspecialchars($data['marPay']));
			$aprPay = trim(htmlspecialchars($data['aprPay']));
			$mayPay = trim(htmlspecialchars($data['mayPay']));
			$junPay = trim(htmlspecialchars($data['junPay']));
			$julPay = trim(htmlspecialchars($data['julPay']));
			$augPay = trim(htmlspecialchars($data['augPay']));
			$sepPay = trim(htmlspecialchars($data['sepPay']));
			$octPay = trim(htmlspecialchars($data['octPay']));
			$novPay = trim(htmlspecialchars($data['novPay']));
			$decPay = trim(htmlspecialchars($data['decPay']));
			$barangay_id = $purok_id = $district_id = $city_id = $province_id = $region_id = null;
			$bar = Barangay::getOneDataByField('name', $barangay);	
			if($bar) {
				$barangay_id = $bar->id;
				$dist = District::getOneDataByField('id', $bar->district_id);
				if($dist) {
					$district_id = $dist->id;
					$ct = City::getOneDataByField('id', $dist->city_id);
					if($ct) {
						$city_id = $ct->id;
						$prov = Province::getOneDataByField('id', $ct->province_id);
						if($prov) {
							$province_id = $prov->id;
							$region_id = $prov->region_id;
						}
					}
				}
			}
			
			if(!$this->isUserExisting($firstname, $lastname, $middlename, $barangay_id, 'add', null)) {			
				if($firstname AND $lastname) {			
					$inserted = User::createMemberFromExcel($firstname, $middlename, $lastname, $region_id, $province_id, $city_id, $district_id, $barangay_id, $purok_id, $idPay, $janPay, $febPay, $marPay, $aprPay, $mayPay, $junPay, $julPay, $augPay, $sepPay, $octPay, $novPay, $decPay);					
					if($inserted) {
						return 'ok';
					} else {
						return 'dberror';
					}
				}
			}
		}

		public function storeMember($data) {
			$firstname = trim(htmlspecialchars($data['firstname']));
			$lastname = trim(htmlspecialchars($data['lastname']));
			$middlename = trim(htmlspecialchars($data['middlename']));			
			$barangay_id = trim(htmlspecialchars($data['barangay_id']));
			$mode = trim(htmlspecialchars($data['mode']));
			$uid = trim(htmlspecialchars($data['id']));

			if(!$this->isUserExisting($firstname, $lastname, $middlename, $barangay_id, $mode, $uid)) {
				$suffix = trim(htmlspecialchars($data['suffix']));
				$region_id = trim(htmlspecialchars($data['region_id']));
				$province_id = trim(htmlspecialchars($data['province_id']));
				$city_id = trim(htmlspecialchars($data['city_id']));
				$district_id = trim(htmlspecialchars($data['district_id']));			
				$purok_id = trim(htmlspecialchars($data['purok_id']));
				$civilstatus = trim(htmlspecialchars($data['civilstatus']));
				$gender = trim(htmlspecialchars($data['gender']));
				$religion = trim(htmlspecialchars($data['religion']));
				$bloodtype = trim(htmlspecialchars($data['bloodtype']));			
				$email = trim(htmlspecialchars($data['email']));
				$nickname = trim(htmlspecialchars($data['nickname']));				
				$zipcode = trim(htmlspecialchars($data['zipcode']));
				$birthdate = trim(htmlspecialchars($data['birthdate']));				
				if(!empty($birthdate)) {
					$birthdate = date('Y-m-d', strtotime(trim(htmlspecialchars($data['birthdate']))));
				} else {
					$birthdate = null;
				}	
				$birthplace = trim(htmlspecialchars($data['birthplace']));
				$age = trim(htmlspecialchars($data['age']));
				$nationality = trim(htmlspecialchars($data['nationality']));
				$country = trim(htmlspecialchars($data['country']));
				$height = trim(htmlspecialchars($data['height']));
				$weight = trim(htmlspecialchars($data['weight']));
				$address = trim(htmlspecialchars($data['address']));
				$father = trim(htmlspecialchars($data['father']));
				$mother = trim(htmlspecialchars($data['mother']));
				$spouse = trim(htmlspecialchars($data['spouse']));
				$education = trim(htmlspecialchars($data['education']));
				$position = trim(htmlspecialchars($data['position']));
				$skill = trim(htmlspecialchars($data['skill']));
				$organization = trim(htmlspecialchars($data['organization']));
				$contact = trim(htmlspecialchars($data['contact']));
				$fb = trim(htmlspecialchars($data['fb']));
				$sss = trim(htmlspecialchars($data['sss']));
				$philhealth = trim(htmlspecialchars($data['philhealth']));
				$voter = trim(htmlspecialchars($data['voter']));
				$passport = trim(htmlspecialchars($data['passport']));
				$profid = trim(htmlspecialchars($data['profid']));
				$pagibig = trim(htmlspecialchars($data['pagibig']));
				$license = trim(htmlspecialchars($data['license']));
				$senior = trim(htmlspecialchars($data['senior']));
				$chairman = trim(htmlspecialchars($data['chairman']));
				$area = trim(htmlspecialchars($data['area']));
				$mcnumber = trim(htmlspecialchars($data['mcnumber']));
				$classification = trim(htmlspecialchars($data['classification']));
				$tribe = trim(htmlspecialchars($data['tribe']));
				$contactname = trim(htmlspecialchars($data['contactname']));
				$contactnumber = trim(htmlspecialchars($data['contactnumber']));
				$contactaddress = trim(htmlspecialchars($data['contactaddress']));

				$benbirthdate1 = trim(htmlspecialchars($data['benbirthdate1']));				
				if(!empty($benbirthdate1)) {
					$benbirthdate1 = date('Y-m-d', strtotime(trim(htmlspecialchars($data['benbirthdate1']))));
				} else {
					$benbirthdate1 = null;
				}

				
				$benname1 = trim(htmlspecialchars($data['benname1']));
				$benage1 = trim(htmlspecialchars($data['benage1']));
				$benrelationship1 = trim(htmlspecialchars($data['benrelationship1']));
				$benname2 = trim(htmlspecialchars($data['benname2']));
				$benage2 = trim(htmlspecialchars($data['benage2']));
				$benrelationship2 = trim(htmlspecialchars($data['benrelationship2']));

				$benbirthdate2 = trim(htmlspecialchars($data['benbirthdate2']));				
				if(!empty($benbirthdate2)) {
					$benbirthdate2 = date('Y-m-d', strtotime(trim(htmlspecialchars($data['benbirthdate2']))));
				} else {
					$benbirthdate2 = null;
				}
				
				$benname3 = trim(htmlspecialchars($data['benname3']));
				$benage3 = trim(htmlspecialchars($data['benage3']));
				$benrelationship3 = trim(htmlspecialchars($data['benrelationship3']));

				$benbirthdate3 = trim(htmlspecialchars($data['benbirthdate3']));				
				if(!empty($benbirthdate3)) {
					$benbirthdate3 = date('Y-m-d', strtotime(trim(htmlspecialchars($data['benbirthdate3']))));
				} else {
					$benbirthdate3 = null;
				}
				
				$benname4 = trim(htmlspecialchars($data['benname4']));
				$benage4 = trim(htmlspecialchars($data['benage4']));
				$benrelationship4 = trim(htmlspecialchars($data['benrelationship4']));

				$benbirthdate4 = trim(htmlspecialchars($data['benbirthdate4']));				
				if(!empty($benbirthdate4)) {
					$benbirthdate4 = date('Y-m-d', strtotime(trim(htmlspecialchars($data['benbirthdate4']))));
				} else {
					$benbirthdate4 = null;
				}
				
				$insurance = trim(htmlspecialchars($data['insurance']));
				$burial = trim(htmlspecialchars($data['burial']));
				$courseToAvail = trim(htmlspecialchars($data['courseToAvail']));
				$filename = trim(htmlspecialchars($data['filename']));				

				if($firstname AND $lastname AND $mode) {		
					if($mode == 'add') {
						$result = User::createMember($firstname, $middlename, $lastname, $email, $region_id, $province_id, $city_id, $district_id, $barangay_id, $purok_id, $civilstatus, $gender, $religion, $bloodtype,  $nickname, $suffix, $zipcode, $birthdate, $birthplace, $age, $nationality, $country, $height, $weight, $address, $father, $mother, $spouse, $education, $position, $skill, $organization, $contact, $fb, $sss, $philhealth, $voter, $passport, $profid, $pagibig, $license, $senior, $chairman, $area, $mcnumber, $classification, $tribe, $contactname, $contactnumber, $contactaddress, $benname1, $benage1, $benrelationship1, $benbirthdate1, $benname2, $benage2, $benrelationship2, $benbirthdate2, $benname3, $benage3, $benrelationship3, $benbirthdate3, $benname4, $benage4, $benrelationship4, $benbirthdate4, $insurance, $burial, $courseToAvail, $filename);					
					} else if($mode == 'edit') {
						$result = User::updateMember($firstname, $middlename, $lastname, $email, $region_id, $province_id, $city_id, $district_id, $barangay_id, $purok_id, $civilstatus, $gender, $religion, $bloodtype,  $nickname, $suffix, $zipcode, $birthdate, $birthplace, $age, $nationality, $country, $height, $weight, $address, $father, $mother, $spouse, $education, $position, $skill, $organization, $contact, $fb, $sss, $philhealth, $voter, $passport, $profid, $pagibig, $license, $senior, $chairman, $area, $mcnumber, $classification, $tribe, $contactname, $contactnumber, $contactaddress, $benname1, $benage1, $benrelationship1, $benbirthdate1, $benname2, $benage2, $benrelationship2, $benbirthdate2, $benname3, $benage3, $benrelationship3, $benbirthdate3, $benname4, $benage4, $benrelationship4, $benbirthdate4, $insurance, $burial, $courseToAvail, $filename, $uid);					
					}
					if($result) { return 'ok'; } else { return 'dberror'; }
				}
			} else {
				return 'exist';
			}
		}

		private function isExisting($firstname, $lastname, $middlename, $suffix, $barangay) {
			if(User::findUserByFields($firstname, $lastname, $middlename, $suffix, $barangay)) {
				return true;
			} else {
				return false;
			}
		}

		private function isUserExisting($firstname, $lastname, $middlename, $barangay, $mode, $id) {
			if(User::countUser($firstname, $lastname, $middlename, $barangay, $mode, $id) > 0) {
				return true;
			} else {
				return false;
			}
		}

		public function update($data, $id) {
			$name = trim(htmlspecialchars($data['name']));
			$price = trim(htmlspecialchars($data['price']));
			$quantity = trim(htmlspecialchars($data['quantity']));
			$description = trim(htmlspecialchars($data['description']));

			if($name AND $price AND $description) {
				$updated = User::updateUser($name, $price, $quantity, $description, $id);

				if($updated) {
					return true;
				} else {
					return false;
				}
			}
		}

	}

?>
