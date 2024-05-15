<?php 

include 'db.php';

session_start();


		$rowcount=0;
		$username = $_POST['username'];  
		$id = null;
		$selectUserSql = "SELECT user_id FROM `Users` WHERE  `username` = '".$username."' AND `active`=1 ";
		$stmt = $mysqli->query($selectUserSql);
    	//$stmt->bind_param('s', $username);
		
		$rows = $stmt->fetch_all(MYSQLI_ASSOC);
		foreach ($rows as $row) {
			$id = $row['user_id'];
		}
		
		$stmt->close();

	
	if($id){
	
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = $id;

			
		echo 'Login';	
	
	}
	else{
		
		echo 'invalid';
  
	}


?>