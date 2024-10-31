<?php

$page_roles = array('admin');

//import credentials for db
require_once  'login.php';
require_once 'checksession.php';

//connect to db
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['delete']))
{
	$isbn = $_POST['isbn'];

	$query = "DELETE FROM classics WHERE isbn='$isbn' ";
	
	//Run the query
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	//Return to the viewAllClassics page
	header("Location: viewRecord.php");
	
}

?>