<?php 

include 'db.php';

session_start();



		$username = mysqli_real_escape_string($connect,  $_POST['username']);  
		      
		$query = "SELECT * FROM `Users` WHERE  `username` = '".$username."' AND `active`=1 ";
		$search = mysqli_query($connect, $query);
		$count = mysqli_num_rows($search);

	
	if($count == 1){
		
			$row1 = mysqli_fetch_assoc($search);
			$id = $row1['user_id'] ;
					
			$_SESSION['username'] = $uname;
			$_SESSION['user_id'] = $id;

			
		echo 'Login';	
	
	}
	else{
		
		echo 'invalid';
  
	}


?>