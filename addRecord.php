<html>
	<head>
	
	</head>
	
	<body>
		<form method='post' action='addRecord.php'>
			<pre>
				ISBN: <input type='text' name='isbn'>
				Author: <input type='text' name='author'>
				Title: <input type='text' name='title'>
				Category: <input type='text' name='category'>
				Year: <input type='text' name='year'>
				<input type='submit' value='Add Record'>
			</pre>
		</form>
	</body>
</html>

<?php

$page_roles = array('admin');

require_once 'login.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

echo "<a href='logout.php'>Logout</a>";

//check if ISBN exists
if(isset($_POST['isbn'])) 
{
	//Get data from POST object
	$isbn = $_POST['isbn'];
	$author = $_POST['author'];
	$title = $_POST['title'];
	$category = $_POST['category'];
	$year = $_POST['year'];
	
	$query = "INSERT INTO classics (isbn, author, title, category, year) 
	VALUES ('$isbn', '$author','$title', '$category', '$year')";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: viewRecord.php");//this will return you to the view all page
	
}

$conn->close();
















?>