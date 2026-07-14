<?php
	require "../../autoload.php";
	require_once '../../src/Functions/helpers.php';
	header("Content-Type: application/json");

    use App\Controllers\UsersController;
	use App\Controllers\PaymentsController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
        $input = json_decode(file_get_contents("php://input"));
        $search = $input->searchWord;
		$pid = $input->user_id;
		$page = $input->page;
		$action = $input->action;
        $data = [
			'user_id' => $pid,
			'action' => $action,
			'searchWord' => $search,		
			'page' => $page
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
		$users = $idPayments = $jans = $febs = $mars = $aprs = $mays = $totalA = [];
		$juns = $juls = $augs = $seps = $octs = $novs = $decs = $totalAB = [];
        $authUser = new UsersController();
        if($page == "all") {
            $users = $authUser->getAllUserWithDetails();		
		} elseif($page == "region" || $page == "province" || $page == "city" || $page == "district" || $page == "barangay") {
            $users = $authUser->findUsersByConditionWithDetails($pid, $page);
		}
		if($action == "print") {
			$payment = new PaymentsController();			
			foreach($users as $usr) {
				$uid = $usr['id'];
				$condition1 = "user_id='$uid' AND type='ID'";
				$amountTotalID = $payment->getSumWithCondition($condition1); 
				$idPayments[] = $amountTotalID->amount !== null ? $amountTotalID->amount : '';
				$janAmt = $payment->getSumWithCondition(getCondition($uid, '01'));
				$jans[] = $janAmt->amount !== null ? $janAmt->amount : '';
				$febAmt = $payment->getSumWithCondition(getCondition($uid, '02'));
				$febs[] = $febAmt->amount !== null ? $febAmt->amount : '';
				$marAmt = $payment->getSumWithCondition(getCondition($uid, '03'));
				$mars[] = $marAmt->amount !== null ? $marAmt->amount : '';
				$aprAmt = $payment->getSumWithCondition(getCondition($uid, '04'));
				$aprs[] = $aprAmt->amount !== null ? $aprAmt->amount : '';
				$mayAmt = $payment->getSumWithCondition(getCondition($uid, '05'));
				$mays[] = $mayAmt->amount !== null ? $mayAmt->amount : '';
				$junAmt = $payment->getSumWithCondition(getCondition($uid, '06'));
				$juns[] = $junAmt->amount !== null ? $junAmt->amount : '';
				$julAmt = $payment->getSumWithCondition(getCondition($uid, '07'));
				$juls[] = $julAmt->amount !== null ? $julAmt->amount : '';
				$augAmt = $payment->getSumWithCondition(getCondition($uid, '08'));
				$augs[] = $augAmt->amount !== null ? $augAmt->amount : '';
				$sepAmt = $payment->getSumWithCondition(getCondition($uid, '09'));
				$seps[] = $sepAmt->amount !== null ? $sepAmt->amount : '';
				$octAmt = $payment->getSumWithCondition(getCondition($uid, '10'));
				$octs[] = $octAmt->amount !== null ? $octAmt->amount : '';
				$novAmt = $payment->getSumWithCondition(getCondition($uid, '11'));
				$novs[] = $novAmt->amount !== null ? $novAmt->amount : '';
				$decAmt = $payment->getSumWithCondition(getCondition($uid, '12'));
				$decs[] = $decAmt->amount !== null ? $decAmt->amount : '';		
				$condition2 = "user_id='$uid' AND type='Monthly Due'";
				$atd = $payment->getSumWithCondition($condition2); 
				$totalA[] = $atd->amount !== null ? $atd->amount : '';	
				$totalAB[] = $amountTotalID->amount + $atd->amount;
			}
		}
		if(!empty($users)) {
            echo json_encode([
				'status' => true,
				'message' => 'success',
                'users' => $users,
				'idPayments' => $idPayments,
				'jans' => $jans,
				'febs' => $febs,
				'mars' => $mars,
				'aprs' => $aprs,
				'mays' => $mays,
				'juns' => $juns,
				'juls' => $juls,
				'augs' => $augs,
				'seps' => $seps,
				'octs' => $octs,
				'novs' => $novs,
				'decs' => $decs,
				'totalA' => $totalA,
				'totalAB' => $totalAB
			]);
        } else {
            http_response_code(404);
            echo json_encode([
				'status' => false,
				'message' => 'not found',
                'users' => null,
				'idPayments' => null
			]);
        }
	} else {
		http_response_code(405);
		echo json_encode([
            'status' => false,
            'message' => 'unauthorized',
            'users' => null,
			'idPayments' => null
        ]);
	} 
?>