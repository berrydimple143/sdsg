<?php
	
	namespace App\Controllers;


	use App\Models\User;
	use DateTime;

	class UsersController {

		public function getAllUserWithDetails() {
			return User::getAllUserWithDetails();					
		}

		public function getAllUserWithSearch($search) {
			return User::getAllUserWithSearch($search);				
		}

		public function getBeneficiaryPerMonth($month, $mtype) {
			$yr = (string)date('Y');
			$fd = $yr.'-'.$month.'-'.(string)date('d');
			$sd = new DateTime($fd);			
			$sd->modify('last day of this month');
			$lastDay = $sd->format('d');
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

		public function storeMember($data) {
			$firstname = trim(htmlspecialchars($data['firstname']));
			$lastname = trim(htmlspecialchars($data['lastname']));
			$middlename = trim(htmlspecialchars($data['middlename']));
			$suffix = trim(htmlspecialchars($data['suffix']));
			$barangay_id = trim(htmlspecialchars($data['barangay_id']));
			if(!$this->isExisting($firstname, $lastname, $middlename, $suffix, $barangay_id)) {		
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
				$birthdate = date('Y-m-d', strtotime(trim(htmlspecialchars($data['birthdate']))));
				$birthplace = trim(htmlspecialchars($data['birthplace']));
				$age = trim(htmlspecialchars($data['age']));
				$nationality = trim(htmlspecialchars($data['nationality']));
				$country = trim(htmlspecialchars($data['country']));
				$height = trim(htmlspecialchars($data['height']));
				$weight = trim(htmlspecialchars($data['weight']));
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
				$benbirthdate1 = date('Y-m-d', strtotime(trim(htmlspecialchars($data['benbirthdate1']))));
				$benname1 = trim(htmlspecialchars($data['benname1']));
				$benage1 = trim(htmlspecialchars($data['benage1']));
				$benrelationship1 = trim(htmlspecialchars($data['benrelationship1']));
				$benname2 = trim(htmlspecialchars($data['benname2']));
				$benage2 = trim(htmlspecialchars($data['benage2']));
				$benrelationship2 = trim(htmlspecialchars($data['benrelationship2']));
				$benbirthdate2 = date('Y-m-d', strtotime(trim(htmlspecialchars($data['benbirthdate2']))));
				$benname3 = trim(htmlspecialchars($data['benname3']));
				$benage3 = trim(htmlspecialchars($data['benage3']));
				$benrelationship3 = trim(htmlspecialchars($data['benrelationship3']));
				$benbirthdate3 = date('Y-m-d', strtotime(trim(htmlspecialchars($data['benbirthdate3']))));
				$benname4 = trim(htmlspecialchars($data['benname4']));
				$benage4 = trim(htmlspecialchars($data['benage4']));
				$benrelationship4 = trim(htmlspecialchars($data['benrelationship4']));
				$benbirthdate4 = date('Y-m-d', strtotime(trim(htmlspecialchars($data['benbirthdate4']))));
				$insurance = trim(htmlspecialchars($data['insurance']));
				$burial = trim(htmlspecialchars($data['burial']));
				$courseToAvail = trim(htmlspecialchars($data['courseToAvail']));

				if($firstname AND $lastname AND $region_id AND $province_id AND $city_id AND $district_id AND $barangay_id AND $purok_id AND $civilstatus AND $gender) {
					$inserted = User::createMember($firstname, $middlename, $lastname, $email, $region_id, $province_id, $city_id, $district_id, $barangay_id, $purok_id, $civilstatus, $gender, $religion, $bloodtype,  $nickname, $suffix, $zipcode, $birthdate, $birthplace, $age, $nationality, $country, $height, $weight, $father, $mother, $spouse, $education, $position, $skill, $organization, $contact, $fb, $sss, $philhealth, $voter, $passport, $profid, $pagibig, $license, $senior, $chairman, $area, $mcnumber, $classification, $tribe, $contactname, $contactnumber, $contactaddress, $benname1, $benage1, $benrelationship1, $benbirthdate1, $benname2, $benage2, $benrelationship2, $benbirthdate2, $benname3, $benage3, $benrelationship3, $benbirthdate3, $benname4, $benage4, $benrelationship4, $benbirthdate4, $insurance, $burial, $courseToAvail);
					if($inserted) {
						return 'ok';
					} else {
						return 'dberror';
					}
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
