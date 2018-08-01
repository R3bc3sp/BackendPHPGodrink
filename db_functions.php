<?php

class DB_Functions{
	
	private $conn;
	
	function __construct()
	
	{
		require_once 'db_connect.php';
		$db = new DB_Connect();
		$this->conn = $db->connect();
		
	}
	
	function __destruct()
	
	{
		//TODO: Implemen_destruct() method.
	}
	
	/*
	* Check user exists
	*return true/false
	*/
	
	function checkExistsUser($phone)
	{
		$stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone=?");
		$stmt->bind_param("s",$phone);
		$stmt->execute();
		$stmt->store_result();
		
		if($stmt->num_rows > 0)
		{
			$stmt->close();
			return true;
		}
		else{
			$stmt->close();
			return false;
	}
}

	/*
	*Register New User
	*return User object if user was created
	*return false and show error message if have exception
	*
	*/
	
	public function registerNewUser($phone,$name,$birthdate,$address)
	{
		$stmt = $this->conn->prepare("INSERT INTO User(Phone,Name,Birthdate,Address) VALUES(?,?,?,?) ");
		$stmt->bind_param("ssss",$phone,$name,$birthdate,$address);
		$result=$stmt->execute();
		$stmt->close();
		
		if($result)
		{
		$stmt=$this->conn->prepare("SELECT * FROM User WHERE Phone = ?");
		$stmt->bind_param("s",$phone);
		$stmt->execute();
		$user = $stmt->get_result()->fetch_assoc();
		$stmt->close();
		return $user;
		
	}
	else 
		return false;
	}	
}
?>
		