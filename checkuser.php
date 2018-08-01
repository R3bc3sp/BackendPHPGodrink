<?php
require_once 'db_functions.php';
$db = new DB_Functions();

/*
*Endpoint: http://<domain>/godrink/checkuser.php
*Method: POST
*Params: Phone
*Result: JSON
*/

$response = array();
if(isset($_POST['phone']))
{
	$phone = $_POST['phone'];
	
	if($db->checkExistsUser($phone))
	{
		$response["exists"] = TRUE;
		echo json_encode($response);
		
	}
	else
	{
		$response["exists"] = FALSE;
		echo json_encode($response);
	}
	
}
else{
	$response["error_msg"] = "REQUIRED PARAMETER (phone) is missing!";
	echo json_encode($response);
}
?>