<?php
	require "../../autoload.php";
    require '../../vendor/autoload.php';
    header("Content-Type: application/json");
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use App\Controllers\UsersController;

    if($_SERVER['REQUEST_METHOD'] === "POST") {
		if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
			$file = $_FILES['excel_file']['tmp_name'];
			$spreadsheet = IOFactory::load($file);
			$worksheet = $spreadsheet->getActiveSheet();
			$rows = $worksheet->toArray();
			$user = new UsersController();
			$errors = [];

			for ($i = 1; $i < count($rows); $i++) {
				$lastname = $rows[$i][0]; // First column
				$firstname = $rows[$i][1]; // Second column
				$middlename = $rows[$i][2]; // Third column
				$janPay = $rows[$i][3];
				$febPay = $rows[$i][4];
				$marPay = $rows[$i][5];
				$aprPay = $rows[$i][6];
				$mayPay = $rows[$i][7];
				$junPay = $rows[$i][8];
				$julPay = $rows[$i][9];
				$augPay = $rows[$i][10];
				$sepPay = $rows[$i][11];
				$octPay = $rows[$i][12];
				$novPay = $rows[$i][13];
				$decPay = $rows[$i][14];
				$barangay = $rows[$i][15];
				$info = [
					'lastname' => $lastname,
					'firstname' => $firstname,
					'middlename' => $middlename,
					'janPay' => $janPay,
					'febPay' => $febPay,
					'marPay' => $marPay,
					'aprPay' => $aprPay,
					'mayPay' => $mayPay,
					'junPay' => $junPay,
					'julPay' => $julPay,
					'augPay' => $augPay,
					'sepPay' => $sepPay,
					'octPay' => $octPay,
					'novPay' => $novPay,
					'decPay' => $decPay,
					'barangay' => $barangay
				];				
				$newUser = $user->storeMemberFromExcel($info);
				if($newUser != "ok") {
					$errors[] = $newUser; 
				} 
			}
			if(!empty($errors)) {
				http_response_code(500);
				echo json_encode([
					'status' => false,
					'message' => 'Internal Server Error.',
					'errorData' => 'server error'
				]);
			} else {
				http_response_code(200);
				echo json_encode([
					'status' => true,
					'message' => 'Upload successful',
					'errorData' => ''
				]);
			}			
		} else {
			http_response_code(422);
			echo json_encode([
				'status' => false,
				'message' => 'Invalid file type.',
				'errorData' => 'invalid'
			]);
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