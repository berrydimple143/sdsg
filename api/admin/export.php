<?php
    require "../../autoload.php";    
    require_once '../../src/Functions/helpers.php';
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=exported_data.csv');
    use App\Controllers\UsersController;
    use App\Controllers\PaymentsController;

    if($_SERVER['REQUEST_METHOD'] === "POST") {        
        $input = json_decode(file_get_contents("php://input"));
        $pid = $input->pid;
		$page = $input->page;
        $users = [];
        $data = [];
        $validate = [
			'pid' => $pid,
			'page' => $page			
		];
        foreach($validate as $key => $value) {
			if(empty($value)) {
				$keyname = ucfirst($key);
				echo json_encode([
					'status' => false,
					'message' => "$keyname is required."
				]);
				exit();
			}
		}        
        $authUser = new UsersController();
        if($page == "all") {
            $users = $authUser->getAllUserWithDetails();    
        } elseif($page == "some") {
            $users = $authUser->getAllUserWithSearch($search);
		} elseif($page == "region" || $page == "province" || $page == "city" || $page == "district" || $page == "barangay") {
            $users = $authUser->findUsersByConditionWithDetails($pid, $page);
		}        
        		
        
        foreach($users as $user) {
            $id = $user['id'];
            $payment = new PaymentsController();
            $condition = "user_id='$id' AND type='ID'";
            $amountTotalID = $payment->getSumWithCondition($condition);     
            $totalID = $amountTotalID->amount;
            $janAmt = $payment->getSumWithCondition(getCondition($id, '01'));
            $febAmt = $payment->getSumWithCondition(getCondition($id, '02'));
            $marAmt = $payment->getSumWithCondition(getCondition($id, '03'));
            $aprAmt = $payment->getSumWithCondition(getCondition($id, '04'));
            $mayAmt = $payment->getSumWithCondition(getCondition($id, '05'));
            $junAmt = $payment->getSumWithCondition(getCondition($id, '06'));
            $julAmt = $payment->getSumWithCondition(getCondition($id, '07'));
            $augAmt = $payment->getSumWithCondition(getCondition($id, '08'));
            $sepAmt = $payment->getSumWithCondition(getCondition($id, '09'));
            $octAmt = $payment->getSumWithCondition(getCondition($id, '10'));
            $novAmt = $payment->getSumWithCondition(getCondition($id, '11'));
            $decAmt = $payment->getSumWithCondition(getCondition($id, '12'));
            $condition2 = "user_id='$id' AND type='Monthly Due'";
            $amountTotalDue = $payment->getSumWithCondition($condition2); 
            $totalDue = $amountTotalDue->amount;
            $overAll = $totalID + $totalDue;
            $data[] = [
                $user['lastname'],
                $user['firstname'],
                $user['middlename'],
                $user['barangay'],
                $totalID,
                $janAmt->amount,
                $febAmt->amount,
                $marAmt->amount,
                $aprAmt->amount,
                $mayAmt->amount,
                $junAmt->amount,
                $julAmt->amount,
                $augAmt->amount,
                $sepAmt->amount,
                $octAmt->amount,
                $novAmt->amount,
                $decAmt->amount,
                $totalDue,
                $overAll
            ];
        }
        $headers = [
            'Surname',
            'Firstname',
            'Middlename',
            'Barangay',
            'Paid ID Total',
            'January',
            'February', 
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
            'Total (B)',
            'Total(A+B)'
        ];
        $output = fopen('php://output', 'w');
        fputcsv($output, $headers);
        foreach($data as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
        exit();
    } else {
        http_response_code(405);
        echo json_encode([
            'status' => false,
            'message' => 'Only POST requests are allowed.',
            'errorData' => 'not allowed'
        ]);
    } 
?>