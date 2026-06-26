<?php
	require "../../autoload.php";
	header("Content-Type: application/json");

    use App\Controllers\UsersController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
        $input = json_decode(file_get_contents("php://input"));
        $search = $input->searchWord;
		$pid = $input->user_id;
		$page = $input->page;
        $data = [
			'user_id' => $pid,
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
        $authUser = new UsersController();
        if($page == "all") {
            $users = $authUser->getAllUserWithDetails();    
        } elseif($page == "some") {
            $users = $authUser->getAllUserWithSearch($search);
		} elseif($page == "region" || $page == "province" || $page == "city" || $page == "district" || $page == "barangay") {
            $users = $authUser->findUsersByConditionWithDetails($pid, $page);
		}

        if(!empty($users)) {
            echo json_encode([
				'status' => true,
				'message' => 'success',
                'users' => $users
			]);
        } else {
            http_response_code(404);
            echo json_encode([
				'status' => false,
				'message' => 'not found',
                'users' => null
			]);
        }
	} else {
		http_response_code(405);
		echo json_encode([
            'status' => false,
            'message' => 'unauthorized',
            'users' => null
        ]);
	} 
?>