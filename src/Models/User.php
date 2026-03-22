<?php
	namespace App\Models;

	use App\Core\Database;
	use PDO;

	class User {
		
		public static function getUsers() {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
			return $user->fetchAll(PDO::FETCH_ASSOC);
		}

		// public static function getAllUserWithDetails2() {
		// 	$pdo = Database::connect();
		// 	$user = $pdo->query("SELECT id, firstname, lastname, middlename FROM users ORDER BY created_at DESC");
		// 	return $user->fetchAll(PDO::FETCH_ASSOC);
		// }

		public static function getAllUserWithDetails() {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT usr.id AS id, usr.firstname AS firstname, usr.lastname AS lastname, usr.middlename AS middlename, utype.classification AS classification FROM users AS usr INNER JOIN user_types AS utype ON usr.id = utype.user_id ORDER BY usr.created_at DESC");
			return $user->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function findUserByEmail($email) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users WHERE email='$email'");
			return $user->fetch(PDO::FETCH_ASSOC);
		}

		public static function findUserByFields($firstname, $lastname, $middlename, $suffix, $barangay) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users AS usr INNER JOIN personal_information AS per ON usr.id = per.user_id WHERE usr.firstname='$firstname' AND usr.lastname='$lastname' AND usr.middlename='$middlename' AND per.suffix='$suffix' AND per.barangay='$barangay'");
			return $user->fetch(PDO::FETCH_ASSOC);
		}

		public static function getUser($id) {
			$pdo = Database::connect();
			$user = $pdo->query("SELECT * FROM users WHERE id=$id");
			return $user->fetch(PDO::FETCH_ASSOC);
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

		public static function createMember($firstname, $middlename, $lastname, $email, $region, $province, $city, $district, $barangay, $purok, $civilstatus, $gender, $religion, $bloodtype, $nickname, $suffix, $zipcode, $birthdate, $birthplace, $age, $nationality, $country, $height, $weight, $father, $mother, $spouse, $education, $position, $skill, $organization, $contact, $fb, $sss, $philhealth, $voter, $passport, $profid, $pagibig, $license, $senior, $chairman, $area, $mcnumber, $classification, $tribe, $contactname, $contactnumber, $contactaddress, $benname1, $benage1, $benrelationship1, $benbirthdate1, $benname2, $benage2, $benrelationship2, $benbirthdate2, $benname3, $benage3, $benrelationship3, $benbirthdate3, $benname4, $benage4, $benrelationship4, $benbirthdate4, $insurance, $burial, $courseToAvail) {
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

				$personal = $pdo->prepare("INSERT INTO personal_information(user_id, nickname, suffix, region,  province, city, district, barangay, purok, zipcode, birthdate, birthplace, age, civilstatus, gender, nationality, country, religion, bloodtype, height, weight) VALUES(:user_id, :nickname, :suffix, :region,  :province, :city, :district, :barangay, :purok, :zipcode, :birthdate, :birthplace, :age, :civilstatus, :gender, :nationality, :country, :religion, :bloodtype, :height, :weight)");	
				$inserted2 = $personal->execute([
					":user_id" =>$uid,
					":nickname" =>$nickname,
					":suffix" =>$suffix,
					":region" => $region,
					":province" => $province,
					":city" =>$city,
					":district" =>$district,
					":barangay" => $barangay,
					":purok" => $purok,
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

				$cont = $pdo->prepare("INSERT INTO contact_information(user_id, contact, fb) VALUES(:user_id, :contact, :fb)");	
				$inserted5 = $cont->execute([
					":user_id" =>$uid,
					":contact" =>$contact,
					":fb" =>$fb
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
					":classification" => 'regular'
				]);

				return $inserted;
			} else {
				return false;
			}
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
	}
?>