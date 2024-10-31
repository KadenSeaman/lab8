<html>
	<head></head>
	
	<body>
		<form method='post' action='authenticate.php'>
			Username: <input type='text' name='username'><br>
			Password: <input type='password' name='password'>
			<input type='submit' value='Login'>
		</form>
	</body>

</html>

<?php

require_once 'login.php';
require_once 'sanitize.php';
require_once 'User.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if (isset($_POST['username']) && isset($_POST['password'])) {
	
	//Get values from login screen
	$tmp_username = sanitize($conn, $_POST['username']);
	$tmp_password = sanitize($conn, $_POST['password']);
	
	//get password from DB w/ SQL
	$query = "SELECT password FROM users WHERE username = '$tmp_username'";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	$passwordFromDB;
	if($result->num_rows > 0){  //there is more than 0 row

		while($row = $result->fetch_array(MYSQLI_ASSOC)){	
			$passwordFromDB = $row['password'];
		}
		
		//Compare passwords
		if(password_verify($tmp_password,$passwordFromDB))
		{
			echo "successful login<br>";
			session_start();
			
			$user = new User($tmp_username);			
			$_SESSION['user'] = $user;
				
			header("Location: viewRecord.php");
		}
		else
		{
			echo "login error<br>";
		}	
		
	}else{
		echo "No such username <br>";
	}
		
		
}

$conn->close();


?>