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
				$lastname = $rows[$i][0];
				$firstname = $rows[$i][1];
				$middlename = $rows[$i][2];
				$barangay = $rows[$i][3];
				$idPay = $rows[$i][4];
				$janPay = $rows[$i][6];				
				$febPay = $rows[$i][7];
				$marPay = $rows[$i][8];
				$aprPay = $rows[$i][9];
				$mayPay = $rows[$i][10];
				$junPay = $rows[$i][11];
				$julPay = $rows[$i][12];
				$augPay = $rows[$i][13];
				$sepPay = $rows[$i][14];
				$octPay = $rows[$i][15];
				$novPay = $rows[$i][16];
				$decPay = $rows[$i][17];
				
				$info = [
					'lastname' => $lastname,
					'firstname' => $firstname,
					'middlename' => $middlename,
					'idPay' => $idPay,
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
					'errorData' => $errors
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