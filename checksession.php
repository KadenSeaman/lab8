<?php

require_once 'User.php';

//session check
session_start();

if($_SESSION['user']){
	
	$user = $_SESSION['user'];
	$user_roles = $user->getRoles();
	$username = $user->username;
	
	
	$found=0;
	foreach ($user_roles as $urole){
		foreach ($page_roles as $prole){
			if($urole==$prole){
				$found=1;
			}
		}
	}
	
	if(!$found){
		header("Location: unauthorized.php");
		exit();
	}	
	
	
}else{ //not in session
	header("Location: authenticate.php");
}



?>