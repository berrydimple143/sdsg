<?php
	require "../../autoload.php";
	header("Content-Type: application/json");

    use App\Controllers\UsersController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
        $input = json_decode(file_get_contents("php://input"));
        $search = $input->searchWord;
        $data = [
			'user_id' => $input->user_id,
			'searchWord' => $search,
			'page' => $input->page			
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
        if($input->page == "all") {
            $users = $authUser->getAllUserWithDetails();    
        } elseif($input->page == "some") {
            $users = $authUser->getAllUserWithSearch($search);
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