<?php
	namespace App\Models;

	use App\Core\Database;
	use PDO;
	use DateTime;

	class User {

		public static function getBeneficiaryPerMonth($before, $after, $mtype) {
			$pdo = Database::connect();			
			$ben = $pdo->query("SELECT COUNT(*) FROM users AS usr INNER JOIN user_types AS utype ON usr.id = utype.user_id WHERE usr.created_at >= '$before' AND usr.created_at <= '$after' AND utype.classification = '$mtype'");
			return $ben->fetchColumn();
		}

		public static function changeStatus($id, $status) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$user = $pdo->prepare("UPDATE users SET status=?, updated_at=? WHERE id=?");
			$usr = $user->execute([$status, $updated_at, $id]);
			$classification = 'nonpaying';
			if($status == 1) {
				$classification = 'paying';
			}
			$type = $pdo->prepare("UPDATE user_types SET classification=? WHERE user_id=?");			
			return $type->execute([$classification, $id]);
		}
		
		public static function getUsers() {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
			return $user->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getAllUserWithSearch($search) {
			$pdo = Database::connect();			
			$user = $pdo->query("SELECT usr.id AS id, usr.firstname AS firstname, usr.lastname AS lastname, usr.middlename AS middlename, usr.status AS status, utype.classification AS classification FROM users AS usr INNER JOIN user_types AS utype ON usr.id = utype.user_id WHERE usr.firstname LIKE '%$search%' OR usr.lastname LIKE '%$search%' OR usr.middlename LIKE '%$search%' OR utype.classification LIKE '%$search%' ORDER BY usr.created_at DESC");			
			return $user->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function findUsersByConditionWithDetails($cond) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT usr.id AS id, usr.firstname AS firstname, usr.lastname AS lastname, usr.middlename AS middlename, usr.status AS status, utype.classification AS classification, bar.name AS barangay FROM users AS usr INNER JOIN user_types AS utype ON usr.id = utype.user_id LEFT JOIN personal_information AS per ON usr.id = per.user_id LEFT JOIN barangays AS bar ON per.barangay_id = bar.id WHERE $cond ORDER BY usr.lastname");
			return $user->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function getAllUserWithDetails() {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT usr.id AS id, usr.firstname AS firstname, usr.lastname AS lastname, usr.middlename AS middlename, usr.status AS status, utype.classification AS classification, bar.name AS barangay FROM users AS usr INNER JOIN user_types AS utype ON usr.id = utype.user_id LEFT JOIN personal_information AS per ON usr.id = per.user_id LEFT JOIN barangays AS bar ON per.barangay_id = bar.id ORDER BY usr.lastname");
			return $user->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function findUserByEmail($email) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users WHERE email='$email'");
			return $user->fetch(PDO::FETCH_ASSOC);
		}

		public static function findUserByFields($firstname, $lastname, $middlename, $suffix, $barangay) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users AS usr INNER JOIN personal_information AS per ON usr.id = per.user_id WHERE usr.firstname='$firstname' AND usr.lastname='$lastname' AND usr.middlename='$middlename' AND per.suffix='$suffix' AND per.barangay_id='$barangay'");
			return $user->fetch(PDO::FETCH_ASSOC);
		}

		public static function countUser($firstname, $lastname, $middlename, $barangay, $mode, $id) {
			$pdo = Database::connect();
			if($mode == 'add') {
				$ben = $pdo->query("SELECT COUNT(*) FROM users AS usr INNER JOIN personal_information AS per ON usr.id = per.user_id WHERE usr.firstname='$firstname' AND usr.lastname='$lastname' AND usr.middlename='$middlename' AND per.barangay_id='$barangay'");
			} else if($mode == 'edit') {
				$ben = $pdo->query("SELECT COUNT(*) FROM users AS usr INNER JOIN personal_information AS per ON usr.id = per.user_id WHERE usr.firstname='$firstname' AND usr.lastname='$lastname' AND usr.middlename='$middlename' AND per.barangay_id='$barangay' AND usr.id != $id");
			}
			return $ben->fetchColumn();
		}

		public static function getUser($id) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users WHERE id=$id");
			return $user->fetch(PDO::FETCH_ASSOC);
		}

		public static function getBeneficiary($id) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT usr.id AS id, usr.firstname AS firstname, usr.lastname AS lastname, usr.middlename AS middlename, usr.email AS email, usr.status AS status, per.region_id AS region_id, per.province_id AS province_id, per.city_id AS city_id, per.district_id AS district_id, per.barangay_id AS barangay_id, per.purok_id AS purok_id, per.suffix AS suffix, per.nickname AS nickname, per.zipcode AS zipcode, per.birthdate AS birthdate, per.birthplace AS birthplace, per.age AS age, per.civilstatus AS civilstatus, per.gender AS gender, per.nationality AS nationality, per.country AS country, per.religion AS religion, per.bloodtype AS bloodtype, per.height AS height, per.weight AS weight, gov.sss AS sss, gov.philhealth AS philhealth, gov.voter AS voter, gov.passport AS passport, gov.profid AS profid, gov.pagibig AS pagibig, gov.license AS license, gov.senior AS senior, fam.father AS father, fam.mother AS mother, fam.spouse AS spouse, emc.contactname AS contactname, emc.contactnumber AS contactnumber, emc.contactaddress AS contactaddress, edc.education AS education, edc.position AS position, edc.skill AS skill, edc.organization AS organization, ctc.contact AS contact, ctc.fb AS fb, ctc.photo AS photo, com.chairman AS chairman, com.area AS area, com.mcnumber AS mcnumber, com.classification AS classification, com.tribe AS tribe, bnf.insurance AS insurance, bnf.burial AS burial, bnf.courseToAvail AS courseToAvail, bnc.benname1 AS benname1, bnc.benname2 AS benname2, bnc.benname3 AS benname3, bnc.benname4 AS benname4, bnc.benage1 AS benage1, bnc.benage2 AS benage2, bnc.benage3 AS benage3, bnc.benage4 AS benage4, bnc.benrelationship1 AS benrelationship1, bnc.benrelationship2 AS benrelationship2, bnc.benrelationship3 AS benrelationship3, bnc.benrelationship4 AS benrelationship4, bnc.benbirthdate1 AS benbirthdate1, bnc.benbirthdate2 AS benbirthdate2, bnc.benbirthdate3 AS benbirthdate3, bnc.benbirthdate4 AS benbirthdate4 FROM users usr INNER JOIN personal_information per ON usr.id = per.user_id INNER JOIN government_id gov ON usr.id = gov.user_id INNER JOIN family_background fam ON usr.id = fam.user_id INNER JOIN emergency_contact emc ON usr.id = emc.user_id INNER JOIN education_occupation edc ON usr.id = edc.user_id INNER JOIN contact_information ctc ON usr.id = ctc.user_id INNER JOIN community_information com ON usr.id = com.user_id INNER JOIN benefits bnf ON usr.id = bnf.user_id INNER JOIN beneficiaries bnc ON usr.id = bnc.user_id WHERE usr.id=$id");
			return $user->fetch(PDO::FETCH_OBJ);
		}

		public static function getOneDataByField($field, $value) {
			$pdo = Database::connect();
			$payment = $pdo->query("SELECT * FROM users WHERE $field = '$value'");
			return $payment->fetch(PDO::FETCH_OBJ);
		}

		public static function getDataAndAssocByField($field, $value) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT usr.id AS id, usr.status AS status, usr.firstname AS firstname, usr.lastname AS lastname, usr.middlename AS middlename, usr.email AS email, per.suffix AS suffix, per.nickname AS nickname, reg.name AS region, reg.id AS region_id, prov.name AS province, prov.id AS province_id, ct.name AS city, ct.id AS city_id, dist.name AS district, dist.id AS district_id, bar.name AS barangay, bar.id AS barangay_id, pur.name AS purok, pur.id AS purok_id, per.zipcode AS zipcode, per.birthdate AS bday, per.birthplace AS birthplace, per.age AS age, per.civilstatus AS civilstatus, per.gender AS gender, per.nationality AS nationality, per.country AS country, per.religion AS religion, per.bloodtype AS bloodtype, per.height AS height, per.weight AS weight, govid.sss AS sss, govid.philhealth AS philhealth, govid.voter AS voter, govid.passport AS passport, govid.profid AS profid, govid.pagibig AS pagibig, govid.license AS license, govid.senior AS senior, fam.father AS father, fam.mother AS mother, fam.spouse AS spouse, emc.contactname AS contactname, emc.contactnumber AS contactnumber, emc.contactaddress AS contactaddress, ed.education AS education, ed.position AS position, ed.skill AS skill, ed.organization AS organization, cont.contact AS contact, cont.fb AS fb, cont.photo AS photo, com.chairman AS chairman, com.area AS area, com.mcnumber AS mcnumber, com.classification AS classification, com.tribe AS tribe, bnfts.insurance AS insurance, bnfts.burial AS burial, bnfts.courseToAvail AS courseToAvail, ben.benname1 AS benname1, ben.benage1 AS benage1, ben.benrelationship1 AS benrelationship1, ben.benbirthdate1 AS benbirthdate1, ben.benname2 AS benname2, ben.benage2 AS benage2, ben.benrelationship2 AS benrelationship2, ben.benbirthdate2 AS benbirthdate2, ben.benname3 AS benname3, ben.benage3 AS benage3, ben.benrelationship3 AS benrelationship3, ben.benbirthdate3 AS benbirthdate3, ben.benname4 AS benname4, ben.benage4 AS benage4, ben.benrelationship4 AS benrelationship4, ben.benbirthdate4 AS benbirthdate4 FROM users AS usr INNER JOIN personal_information as per ON usr.id = per.user_id INNER JOIN regions AS reg ON per.region_id = reg.id INNER JOIN provinces AS prov ON per.province_id = prov.id INNER JOIN cities AS ct ON per.city_id = ct.id INNER JOIN districts AS dist ON per.district_id = dist.id INNER JOIN barangays AS bar ON per.barangay_id = bar.id INNER JOIN puroks AS pur ON per.purok_id = pur.id INNER JOIN government_id AS govid ON usr.id = govid.user_id INNER JOIN family_background AS fam ON usr.id = fam.user_id INNER JOIN emergency_contact AS emc ON usr.id = emc.user_id INNER JOIN education_occupation AS ed ON usr.id = ed.user_id INNER JOIN contact_information AS cont ON usr.id = cont.user_id INNER JOIN community_information AS com ON usr.id = com.user_id INNER JOIN benefits AS bnfts ON usr.id = bnfts.user_id INNER JOIN beneficiaries AS ben ON usr.id = ben.user_id WHERE $field = $value");
			return $user->fetch(PDO::FETCH_OBJ);
		}

		public static function createUser($firstname, $middlename, $lastname, $email, $username, $password, $phone, $mobile, $status) {
			$pdo = Database::connect();
			$user = $pdo->prepare("INSERT INTO users(firstname, middlename, lastname, email, username, password, phone, mobile, status, created_at, updated_at) VALUES(:firstname, :middlename, :lastname, :email, :username, :password, :phone, :mobile, :status, :created_at, :updated_at)");
			return $user->execute([
				":firstname" =>$firstname,
				":middlename" =>$middlename,
				":lastname" => $lastname,
				":email" => $email,
				":username" => $username,
				":password" => password_hash($password, PASSWORD_DEFAULT),
				":phone" => $phone,
				":mobile" => $mobile,
				":status" => $status,
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);
		}

		public static function createMemberFromExcel($firstname, $middlename, $lastname,  $region_id, $province_id, $city_id, $district_id, $barangay_id, $purok_id, $idPay, $janPay, $febPay, $marPay, $aprPay, $mayPay, $junPay, $julPay, $augPay, $sepPay, $octPay, $novPay, $decPay) {
			$pdo = Database::connect();
			$user = $pdo->prepare("INSERT INTO users(firstname, middlename, lastname, status, created_at, updated_at) VALUES(:firstname, :middlename, :lastname, :status, :created_at, :updated_at)");

			$inserted = $user->execute([
				":firstname" =>$firstname,
				":middlename" =>$middlename,
				":lastname" => $lastname,			
				":status" => true,
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);

			if(empty($idPay) || $idPay == null) { $idPay = 0; }		
			if(empty($janPay) || $janPay == null) { $janPay = 0; }	
			if(empty($febPay) || $febPay == null) { $febPay = 0; }	
			if(empty($marPay) || $marPay == null) { $marPay = 0; }					
			if(empty($aprPay) || $aprPay == null) { $aprPay = 0; }	
			if(empty($mayPay) || $mayPay == null) { $mayPay = 0; }	
			if(empty($junPay) || $junPay == null) { $junPay = 0; }	
			if(empty($julPay) || $julPay == null) { $julPay = 0; }	
			if(empty($augPay) || $augPay == null) { $augPay = 0; }	
			if(empty($sepPay) || $sepPay == null) { $sepPay = 0; }	
			if(empty($octPay) || $octPay == null) { $octPay = 0; }	
			if(empty($novPay) || $novPay == null) { $novPay = 0; }	
			if(empty($decPay) || $decPay == null) { $decPay = 0; }	
			$total = $idPay + $janPay + $febPay + $marPay + $aprPay + $mayPay + $junPay + $julPay + $augPay + $sepPay + $octPay + $novPay + $decPay;
			$pstatus = 'nonpaying';
			if($total > 0) {
				$pstatus = 'paying';
			}

			if($inserted) {
				$uid = $pdo->lastInsertId();

				$personal = $pdo->prepare("INSERT INTO personal_information(user_id, region_id,  province_id, city_id, district_id, barangay_id, purok_id) VALUES(:user_id,  :region_id, :province_id, :city_id, :district_id, :barangay_id, :purok_id)");	
				$inserted2 = $personal->execute([
					":user_id" =>$uid,
					":region_id" => $region_id,
					":province_id" => $province_id,
					":city_id" =>$city_id,
					":district_id" =>$district_id,
					":barangay_id" => $barangay_id,
					":purok_id" => $purok_id					
				]);

				$family = $pdo->prepare("INSERT INTO family_background(user_id) VALUES(:user_id)");	
				$inserted3 = $family->execute([":user_id" => $uid]);
				
				$ed = $pdo->prepare("INSERT INTO education_occupation(user_id) VALUES(:user_id)");	
				$inserted4 = $ed->execute([":user_id" => $uid]);

				$cont = $pdo->prepare("INSERT INTO contact_information(user_id) VALUES(:user_id)");	
				$inserted5 = $cont->execute([":user_id" => $uid]);

				$gov = $pdo->prepare("INSERT INTO government_id(user_id) VALUES(:user_id)");	
				$inserted6 = $gov->execute([":user_id" =>$uid]);

				$community = $pdo->prepare("INSERT INTO community_information(user_id) VALUES(:user_id)");	
				$inserted7 = $community->execute([":user_id" => $uid]);

				$emergency = $pdo->prepare("INSERT INTO emergency_contact(user_id) VALUES(:user_id)");	
				$inserted8 = $emergency->execute([":user_id" => $uid]);

				$beneficiaries = $pdo->prepare("INSERT INTO beneficiaries(user_id) VALUES(:user_id)");
				$inserted9 = $beneficiaries->execute([":user_id" => $uid]);				

				$utypes = $pdo->prepare("INSERT INTO user_types(user_id, mtype, position, designation, classification) VALUES(:user_id, :mtype, :position, :designation, :classification)");	
				$inserted11 = $utypes->execute([
					":user_id" => $uid,
					":mtype" => 'member',
					":position" => '',
					":designation" => '',
					":classification" => $pstatus
				]);

				$benefits = $pdo->prepare("INSERT INTO benefits(user_id, insurance, burial) VALUES(:user_id, :insurance, :burial)");	
				$inserted10 = $benefits->execute([
					":user_id" => $uid,
					":insurance" => 50,
					":burial" => 50
				]);					
				$payArray = [];
				$dateArray = [];				
				$jan = new DateTime('2026-01-01 01:01:01');
				$feb = new DateTime('2026-02-01 01:01:01');
				$mar = new DateTime('2026-03-01 01:01:01');
				$apr = new DateTime('2026-04-01 01:01:01');
				$may = new DateTime('2026-05-01 01:01:01');
				$jun = new DateTime('2026-06-01 01:01:01');
				$jul = new DateTime('2026-07-01 01:01:01');
				$aug = new DateTime('2026-08-01 01:01:01');
				$sep = new DateTime('2026-09-01 01:01:01');
				$oct = new DateTime('2026-10-01 01:01:01');
				$nov = new DateTime('2026-11-01 01:01:01');
				$dec = new DateTime('2026-12-01 01:01:01');				

				if((int)$idPay > 0) {
					$IDPayment = $pdo->prepare("INSERT INTO payments(user_id, amount, type) VALUES(:user_id, :amount, :type)");
					$IDPayment->execute([
						":user_id" => $uid,
						":amount" => $idPay,
						":type" => 'ID'
					]);
				}				
				if((int)$janPay > 0) {
					$payArray[] = $janPay;
					$dateArray[] = $jan->format('Y-m-d H:i:s');
				}
				if((int)$febPay > 0) {
					$payArray[] = $febPay;
					$dateArray[] = $feb->format('Y-m-d H:i:s');
				}
				if((int)$marPay > 0) {
					$payArray[] = $marPay;
					$dateArray[] = $mar->format('Y-m-d H:i:s');
				}
				if((int)$aprPay > 0) {
					$payArray[] = $aprPay;
					$dateArray[] = $apr->format('Y-m-d H:i:s');
				}			
				if((int)$mayPay > 0) {
					$payArray[] = $mayPay;
					$dateArray[] = $may->format('Y-m-d H:i:s');
				}	
				if((int)$junPay > 0) {
					$payArray[] = $junPay;
					$dateArray[] = $jun->format('Y-m-d H:i:s');
				}
				if((int)$julPay > 0) {
					$payArray[] = $julPay;
					$dateArray[] = $jul->format('Y-m-d H:i:s');
				}
				if((int)$augPay > 0) {
					$payArray[] = $augPay;
					$dateArray[] = $aug->format('Y-m-d H:i:s');
				}
				if((int)$sepPay > 0) {
					$payArray[] = $sepPay;
					$dateArray[] = $sep->format('Y-m-d H:i:s');
				}
				if((int)$octPay > 0) {
					$payArray[] = $octPay;
					$dateArray[] = $oct->format('Y-m-d H:i:s');
				}
				if((int)$novPay > 0) {
					$payArray[] = $novPay;
					$dateArray[] = $nov->format('Y-m-d H:i:s');
				}
				if((int)$decPay > 0) {
					$payArray[] = $decPay;
					$dateArray[] = $dec->format('Y-m-d H:i:s');
				}

				for($i=0; $i < count($payArray); $i++) {
					$pay = $pdo->prepare("INSERT INTO payments(user_id, amount, type, created_at, updated_at) VALUES(:user_id, :amount, :type, :created_at, :updated_at)");			
					$pay->execute([
						":user_id" => $uid,
						":amount" => $payArray[$i],
						":type" => 'Monthly Due',
						":created_at" => $dateArray[$i],
						":updated_at" => $dateArray[$i]
					]);
				}

				return $inserted;
			} else {
				return false;
			}
		}

		public static function createMember($firstname, $middlename, $lastname, $email, $region_id, $province_id, $city_id, $district_id, $barangay_id, $purok_id, $civilstatus, $gender, $religion, $bloodtype, $nickname, $suffix, $zipcode, $birthdate, $birthplace, $age, $nationality, $country, $height, $weight, $father, $mother, $spouse, $education, $position, $skill, $organization, $contact, $fb, $sss, $philhealth, $voter, $passport, $profid, $pagibig, $license, $senior, $chairman, $area, $mcnumber, $classification, $tribe, $contactname, $contactnumber, $contactaddress, $benname1, $benage1, $benrelationship1, $benbirthdate1, $benname2, $benage2, $benrelationship2, $benbirthdate2, $benname3, $benage3, $benrelationship3, $benbirthdate3, $benname4, $benage4, $benrelationship4, $benbirthdate4, $insurance, $burial, $courseToAvail, $filename) {
			$pdo = Database::connect();
			$user = $pdo->prepare("INSERT INTO users(firstname, middlename, lastname, email,  status, created_at, updated_at) VALUES(:firstname, :middlename, :lastname, :email,  :status, :created_at, :updated_at)");			

			$inserted = $user->execute([
				":firstname" =>$firstname,
				":middlename" =>$middlename,
				":lastname" => $lastname,
				":email" => $email,						
				":status" => true,
				":created_at" => date('Y-m-d H:i:s'),
				":updated_at" => date('Y-m-d H:i:s')
			]);

			if($inserted) {
				$uid = $pdo->lastInsertId();

				$personal = $pdo->prepare("INSERT INTO personal_information(user_id, nickname, suffix, region_id,  province_id, city_id, district_id, barangay_id, purok_id, zipcode, birthdate, birthplace, age, civilstatus, gender, nationality, country, religion, bloodtype, height, weight) VALUES(:user_id, :nickname, :suffix, :region_id, :province_id, :city_id, :district_id, :barangay_id, :purok_id, :zipcode, :birthdate, :birthplace, :age, :civilstatus, :gender, :nationality, :country, :religion, :bloodtype, :height, :weight)");	
				$inserted2 = $personal->execute([
					":user_id" =>$uid,
					":nickname" =>$nickname,
					":suffix" =>$suffix,
					":region_id" => $region_id,
					":province_id" => $province_id,
					":city_id" =>$city_id,
					":district_id" =>$district_id,
					":barangay_id" => $barangay_id,
					":purok_id" => $purok_id,
					":zipcode" =>$zipcode,
					":birthdate" =>$birthdate,
					":birthplace" => $birthplace,
					":age" => $age,
					":civilstatus" =>$civilstatus,
					":gender" =>$gender,
					":nationality" => $nationality,
					":country" => $country,
					":religion" => $religion,
					":bloodtype" =>$bloodtype,
					":height" =>$height,
					":weight" => $weight
				]);

				$family = $pdo->prepare("INSERT INTO family_background(user_id, father, mother, spouse) VALUES(:user_id, :father, :mother, :spouse)");	
				$inserted3 = $family->execute([
					":user_id" =>$uid,
					":father" =>$father,
					":mother" =>$mother,
					":spouse" => $spouse
				]);
				
				$ed = $pdo->prepare("INSERT INTO education_occupation(user_id, education, position, skill, organization) VALUES(:user_id, :education, :position, :skill, :organization)");	
				$inserted4 = $ed->execute([
					":user_id" =>$uid,
					":education" =>$education,
					":position" =>$position,
					":skill" => $skill,
					":organization" => $organization
				]);

				$cont = $pdo->prepare("INSERT INTO contact_information(user_id, contact, fb, photo) VALUES(:user_id, :contact, :fb, :photo)");	
				$inserted5 = $cont->execute([
					":user_id" => $uid,
					":contact" => $contact,
					":fb" => $fb,
					":photo" => $filename
				]);

				$gov = $pdo->prepare("INSERT INTO government_id(user_id, sss, philhealth, voter, passport, profid, pagibig, license, senior) VALUES(:user_id, :sss, :philhealth, :voter, :passport, :profid, :pagibig, :license, :senior)");	
				$inserted6 = $gov->execute([
					":user_id" =>$uid,
					":sss" =>$sss,
					":philhealth" =>$philhealth,
					":voter" => $voter,
					":passport" => $passport,
					":profid" =>$profid,
					":pagibig" =>$pagibig,
					":license" => $license,
					":senior" => $senior
				]);

				$community = $pdo->prepare("INSERT INTO community_information(user_id, chairman, area, mcnumber, classification, tribe) VALUES(:user_id, :chairman, :area, :mcnumber, :classification, :tribe)");	
				$inserted7 = $community->execute([
					":user_id" =>$uid,
					":chairman" =>$chairman,
					":area" =>$area,
					":mcnumber" => $mcnumber,
					":classification" => $classification,
					":tribe" =>$tribe
				]);

				$emergency = $pdo->prepare("INSERT INTO emergency_contact(user_id, contactname, contactnumber, contactaddress) VALUES(:user_id, :contactname, :contactnumber, :contactaddress)");	
				$inserted8 = $emergency->execute([
					":user_id" =>$uid,
					":contactname" =>$contactname,
					":contactnumber" =>$contactnumber,
					":contactaddress" =>$contactaddress
				]);

				$beneficiaries = $pdo->prepare("INSERT INTO beneficiaries(user_id, benname1, benname2, benname3, benname4, benage1, benage2, benage3, benage4, benrelationship1, benrelationship2, benrelationship3, benrelationship4, benbirthdate1, benbirthdate2, benbirthdate3, benbirthdate4) VALUES(:user_id, :benname1, :benname2, :benname3, :benname4, :benage1, :benage2, :benage3, :benage4, :benrelationship1, :benrelationship2, :benrelationship3, :benrelationship4, :benbirthdate1, :benbirthdate2, :benbirthdate3, :benbirthdate4)");
				$inserted9 = $beneficiaries->execute([
					":user_id" =>$uid,
					":benname1" =>$benname1,
					":benname2" =>$benname2,
					":benname3" => $benname3,
					":benname4" => $benname4,
					":benage1" =>$benage1,
					":benage2" =>$benage2,
					":benage3" => $benage3,
					":benage4" => $benage4,
					":benrelationship1" =>$benrelationship1,
					":benrelationship2" =>$benrelationship2,
					":benrelationship3" => $benrelationship3,
					":benrelationship4" => $benrelationship4,
					":benbirthdate1" =>$benbirthdate1,
					":benbirthdate2" =>$benbirthdate2,
					":benbirthdate3" => $benbirthdate3,
					":benbirthdate4" => $benbirthdate4
				]);

				$benefits = $pdo->prepare("INSERT INTO benefits(user_id, insurance, burial, courseToAvail) VALUES(:user_id, :insurance, :burial, :courseToAvail)");	
				$inserted10 = $benefits->execute([
					":user_id" =>$uid,
					":insurance" =>$insurance,
					":burial" =>$burial,
					":courseToAvail" =>$courseToAvail
				]);

				$utypes = $pdo->prepare("INSERT INTO user_types(user_id, mtype, position, designation, classification) VALUES(:user_id, :mtype, :position, :designation, :classification)");	
				$inserted11 = $utypes->execute([
					":user_id" =>$uid,
					":mtype" => 'member',
					":position" => '',
					":designation" => '',
					":classification" => 'nonpaying'
				]);

				return $inserted;
			} else {
				return false;
			}
		}

		public static function updateMember($firstname, $middlename, $lastname, $email, $region_id, $province_id, $city_id, $district_id, $barangay_id, $purok_id, $civilstatus, $gender, $religion, $bloodtype, $nickname, $suffix, $zipcode, $birthdate, $birthplace, $age, $nationality, $country, $height, $weight, $father, $mother, $spouse, $education, $position, $skill, $organization, $contact, $fb, $sss, $philhealth, $voter, $passport, $profid, $pagibig, $license, $senior, $chairman, $area, $mcnumber, $classification, $tribe, $contactname, $contactnumber, $contactaddress, $benname1, $benage1, $benrelationship1, $benbirthdate1, $benname2, $benage2, $benrelationship2, $benbirthdate2, $benname3, $benage3, $benrelationship3, $benbirthdate3, $benname4, $benage4, $benrelationship4, $benbirthdate4, $insurance, $burial, $courseToAvail, $filename, $uid) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$user = $pdo->prepare("UPDATE users usr INNER JOIN user_types utype ON usr.id = utype.user_id INNER JOIN personal_information per ON usr.id = per.user_id INNER JOIN government_id gov ON usr.id = gov.user_id INNER JOIN family_background fam ON usr.id = fam.user_id INNER JOIN emergency_contact emc ON usr.id = emc.user_id INNER JOIN education_occupation edc ON usr.id = edc.user_id INNER JOIN contact_information ctc ON usr.id = ctc.user_id INNER JOIN community_information com ON usr.id = com.user_id INNER JOIN benefits bnf ON usr.id = bnf.user_id INNER JOIN beneficiaries bnc ON usr.id = bnc.user_id SET usr.firstname=?, usr.middlename=?, usr.lastname=?, usr.email=?, per.region_id=?, per.province_id=?, per.city_id=?, per.district_id=?, per.barangay_id=?, per.purok_id=?, per.civilstatus=?, per.gender=?, per.religion=?, per.bloodtype=?, per.nickname=?, per.suffix=?, per.zipcode=?, per.birthdate=?, per.birthplace=?, per.age=?, per.nationality=?, per.country=?, per.height=?, per.weight=?, fam.father=?, fam.mother=?, fam.spouse=?, edc.education=?, edc.position=?, edc.skill=?, edc.organization=?, ctc.contact=?, ctc.fb=?, gov.sss=?, gov.philhealth=?, gov.voter=?, gov.passport=?, gov.profid=?, gov.pagibig=?, gov.license=?, gov.senior=?, com.chairman=?, com.area=?, com.mcnumber=?, com.classification=?, com.tribe=?, emc.contactname=?, emc.contactnumber=?, emc.contactaddress=?, bnc.benname1=?, bnc.benage1=?, bnc.benrelationship1=?, bnc.benbirthdate1=?, bnc.benname2=?, bnc.benage2=?, bnc.benrelationship2=?, bnc.benbirthdate2=?, bnc.benname3=?, bnc.benage3=?, bnc.benrelationship3=?, bnc.benbirthdate3=?, bnc.benname4=?, bnc.benage4=?, bnc.benrelationship4=?, bnc.benbirthdate4=?, bnf.insurance=?, bnf.burial=?, bnf.courseToAvail=?, ctc.photo=?, usr.updated_at=? WHERE usr.id=?");

			return $user->execute([$firstname, $middlename, $lastname, $email, $region_id, $province_id, $city_id, $district_id, $barangay_id, $purok_id, $civilstatus, $gender, $religion, $bloodtype, $nickname, $suffix, $zipcode, $birthdate, $birthplace, $age, $nationality, $country, $height, $weight, $father, $mother, $spouse, $education, $position, $skill, $organization, $contact, $fb, $sss, $philhealth, $voter, $passport, $profid, $pagibig, $license, $senior, $chairman, $area, $mcnumber, $classification, $tribe, $contactname, $contactnumber, $contactaddress, $benname1, $benage1, $benrelationship1, $benbirthdate1, $benname2, $benage2, $benrelationship2, $benbirthdate2, $benname3, $benage3, $benrelationship3, $benbirthdate3, $benname4, $benage4, $benrelationship4, $benbirthdate4, $insurance, $burial, $courseToAvail, $filename, $updated_at, $uid]);	
		}

		public static function updateUser($firstname, $middlename, $lastname, $email, $username, $phone, $mobile, $id) {
			$pdo = Database::connect();
			$updated_at = date('Y-m-d H:i:s');
			$user = $pdo->prepare("UPDATE users SET firstname=?, middlename=?, lastname=?, email=?, username=?, phone=?, mobile=?, updated_at=? WHERE id=?");
			return $user->execute([$firstname, $middlename, $lastname, $email, $username, $phone, $mobile, $updated_at, $id]);	
		}

		public static function deleteUser($id) {
			$pdo = Database::connect();
			$user = $pdo->prepare("DELETE FROM users WHERE id=?");
			return $user->execute([$id]);			
		}

		public static function deleteData($id) {
			$pdo = Database::connect();
			$user = $pdo->prepare("DELETE usr, utype, per, pay, gov, fam, emc, edc, ctc, com, bnf, bnc FROM users usr LEFT JOIN user_types utype ON usr.id = utype.user_id LEFT JOIN personal_information per ON usr.id = per.user_id LEFT JOIN payments pay ON usr.id = pay.user_id LEFT JOIN government_id gov ON usr.id = gov.user_id LEFT JOIN family_background fam ON usr.id = fam.user_id LEFT JOIN emergency_contact emc ON usr.id = emc.user_id LEFT JOIN education_occupation edc ON usr.id = edc.user_id LEFT JOIN contact_information ctc ON usr.id = ctc.user_id LEFT JOIN community_information com ON usr.id = com.user_id LEFT JOIN benefits bnf ON usr.id = bnf.user_id LEFT JOIN beneficiaries bnc ON usr.id = bnc.user_id WHERE usr.id=?");
			return $user->execute([$id]);
		}

	}
?>