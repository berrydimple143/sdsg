<?php
	require "../../autoload.php";
	header("Content-Type: application/json");

    use App\Controllers\UsersController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
        $authUser = new UsersController();
        $users = $authUser->getAllUserWithDetails();        
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