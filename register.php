<?php
require_once 'db_functions.php';
$db = new DB_Functions();

/*
*Endpoint: http://<domain>/godrink/register.php
*Method: POST
*Params: Phone,name,birthdate,address
*Result: JSON
*/

$response = array();
if(isset($_POST['phone']) && 
	isset($_POST['name']) && 
	isset($_POST['birthdate']) && 
	isset($_POST['address']))
{
	$phone = $_POST['phone'];
	$name = $_POST['name'];
	$birthdate = $_POST['birthdate'];
	$address = $_POST['address'];
	
	if($db->checkExistsUser($phone))
	{
		$response["error_msg"] = "User already existed whit ".$phone;
		echo json_encode($response);
		
	}
	else
	{
		//CREATE NEW User
		$user = $db->registerNewUser($phone,$name,$birthdate,$address);
		if($user)
		{
			$response["phone"] = $user["Phone"];
			$response["name"] = $user["Name"];
			$response["birthdate"] = $user["Birthdate"];
			$response["address"] = $user["Address"];
			echo json_encode($response);
	}
	else
	{
		$response["error_msg"] = "Unknow error ocurred in registration!";
		echo json_encode($response);
	}
	}
	
}
else{
	$response["error_msg"] = "Required parameter(phone,name,birthdate,address) is missing";
	echo json_encode($response);
}
?>