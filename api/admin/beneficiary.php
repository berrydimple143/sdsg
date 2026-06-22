<?php
	require "../../autoload.php";
	header("Content-Type: application/json");
	use App\Controllers\UsersController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {		
		$user = json_decode(file_get_contents("php://input"));

		$data = [
			'firstname' => $user->firstname,
			'lastname' => $user->lastname,
            'insurance' => $user->insurance,
            'burial' => $user->burial,
            'mode' => $user->mode
		];

		foreach($data as $key => $value) {
			if(empty($value)) {
				$keyname = ucfirst($key);
				echo json_encode([
					'status' => false,
					'message' => "$keyname is required."
				]);
				exit();
			}
		}
		
		$data['civilstatus'] = $user->civilstatus;
		$data['gender'] = $user->gender;
		$data['region_id'] = $user->region_id;
        $data['province_id'] = $user->province_id;
		$data['city_id'] = $user->city_id;
		$data['district_id'] = $user->district_id;
		$data['barangay_id'] = $user->barangay_id;
        $data['purok_id'] = $user->purok_id;		
        $data['religion'] = $user->religion;
        $data['bloodtype'] = $user->bloodtype;
		$data['middlename'] = $user->middlename;
		$data['email'] = $user->email;
		$data['nickname'] = $user->nickname;
        $data['suffix'] = $user->suffix;
		$data['zipcode'] = $user->zipcode;
		$data['birthdate'] = $user->birthdate;
        $data['birthplace'] = $user->birthplace;
		$data['age'] = $user->age;
		$data['nationality'] = $user->nationality;
		$data['country'] = $user->country;
        $data['height'] = $user->height;
		$data['weight'] = $user->weight;
		$data['father'] = $user->father;
        $data['mother'] = $user->mother;
		$data['spouse'] = $user->spouse;
		$data['education'] = $user->education;
        $data['position'] = $user->position;
		$data['skill'] = $user->skill;
		$data['organization'] = $user->organization;
		$data['contact'] = $user->contact;
        $data['fb'] = $user->fb;
        $data['sss'] = $user->sss;
		$data['philhealth'] = $user->philhealth;
        $data['voter'] = $user->voter;
		$data['passport'] = $user->passport;
		$data['profid'] = $user->profid;
        $data['pagibig'] = $user->pagibig;
		$data['license'] = $user->license;
		$data['senior'] = $user->senior;
        $data['chairman'] = $user->chairman;
		$data['area'] = $user->area;
		$data['mcnumber'] = $user->mcnumber;
		$data['classification'] = $user->classification;
        $data['tribe'] = $user->tribe;
        $data['contactname'] = $user->contactname;
		$data['contactnumber'] = $user->contactnumber;
        $data['contactaddress'] = $user->contactaddress;
        $data['benname1'] = $user->benname1;
		$data['benage1'] = $user->benage1;
        $data['benrelationship1'] = $user->benrelationship1;
		$data['benbirthdate1'] = $user->benbirthdate1;
		$data['benname2'] = $user->benname2;
        $data['benage2'] = $user->benage2;
		$data['benrelationship2'] = $user->benrelationship2;
		$data['benbirthdate2'] = $user->benbirthdate2;
        $data['benname3'] = $user->benname3;
		$data['benage3'] = $user->benage3;
		$data['benrelationship3'] = $user->benrelationship3;
		$data['benbirthdate3'] = $user->benbirthdate3;
        $data['benname4'] = $user->benname4;
        $data['benage4'] = $user->benage4;
        $data['benrelationship4'] = $user->benrelationship4;
		$data['benbirthdate4'] = $user->benbirthdate4;
		$data['insurance'] = $user->insurance;
		$data['burial'] = $user->burial;
        $data['courseToAvail'] = $user->courseToAvail;
		$data['filename'] = $user->filename;
        $data['mode'] = $user->mode;
        $data['id'] = $user->userId;

        $newUser = new UsersController();
		$returnData = $newUser->storeMember($data);
		if($returnData == "ok") {
			http_response_code(200);
			echo json_encode([
				'status' => true,
				'message' => 'Save successful.',
				'errorData' => ''
			]);		
		} else {
			if($returnData == "exist") {
				http_response_code(409);
				echo json_encode([
					'status' => false,
					'message' => 'This user already exists.',
					'errorData' => 'exist'
				]);
			} else {
				http_response_code(401);
				echo json_encode([
					'status' => false,
					'message' => 'Save failed.',
					'errorData' => $returnData
				]);
			}			
		}

	} else {
		http_response_code(405);
		echo json_encode([
			'status' => false,
			'message' => 'Only POST requests are allowed.',
			'errorData' => 'not allowed'
		]);
	}
?>