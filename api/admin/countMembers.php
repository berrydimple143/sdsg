<?php
	require "../../autoload.php";
	header("Content-Type: application/json");

    use App\Controllers\UsersController;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
        $authUser = new UsersController();
        $ben = json_decode(file_get_contents("php://input"));
        $mtype = $ben->mtype;     
        $janMembers = $authUser->getBeneficiaryPerMonth('01', $mtype);
        $febMembers = $authUser->getBeneficiaryPerMonth('02', $mtype);
        $marMembers = $authUser->getBeneficiaryPerMonth('03', $mtype);
        $aprMembers = $authUser->getBeneficiaryPerMonth('04', $mtype);  
        $mayMembers = $authUser->getBeneficiaryPerMonth('05', $mtype);
        $junMembers = $authUser->getBeneficiaryPerMonth('06', $mtype);
        $julMembers = $authUser->getBeneficiaryPerMonth('07', $mtype);
        $augMembers = $authUser->getBeneficiaryPerMonth('08', $mtype);
        $sepMembers = $authUser->getBeneficiaryPerMonth('09', $mtype);
        $octMembers = $authUser->getBeneficiaryPerMonth('10', $mtype);
        $novMembers = $authUser->getBeneficiaryPerMonth('11', $mtype);
        $decMembers = $authUser->getBeneficiaryPerMonth('12', $mtype);
        echo json_encode([
            'status' => true,
            'message' => 'success',
            'janMembers' => $janMembers,
            'febMembers' => $febMembers,
            'marMembers' => $marMembers,
            'aprMembers' => $aprMembers,
            'mayMembers' => $mayMembers,
            'junMembers' => $junMembers,
            'julMembers' => $julMembers,
            'augMembers' => $augMembers,
            'sepMembers' => $sepMembers,
            'octMembers' => $octMembers,
            'novMembers' => $novMembers,
            'decMembers' => $decMembers
        ]);
	} else {
		http_response_code(405);
		echo json_encode([
            'status' => false,
            'message' => 'unauthorized',
            'users' => null
        ]);
	} 
?>