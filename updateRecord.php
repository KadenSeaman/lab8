<?php

$page_roles = array('admin');

require_once 'login.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

echo "<a href='logout.php'>Logout</a>";

if(isset($_GET['isbn'])){
	
$isbn = $_GET['isbn'];

$query = "SELECT * FROM classics where isbn = $isbn";

$result = $conn->query($query); 
if(!$result) die($conn->error);

if($result->num_rows > 0){  //there is more than 0 row

	while($row = $result->fetch_array(MYSQLI_ASSOC)){	
		
echo <<<_END

		<form method='post' action='updateRecord.php'>
		<pre>
			Author: <input type='text' value='$row[author]' name='author'>
			Title: <input type='text' value='$row[title]' name='title'>
			Category: <input type='text' value='$row[category]' name='category'>
			Year: <input type='text' value='$row[year]' name='year'>
			ISBN: $row[isbn]

			<input type='submit' value='Update'>
			<input type='hidden' name='isbn' value='$row[isbn]'>
			<input type='hidden' name='update' value='yes'>
		
		</pre>
		</form>
	
_END;
	}
}else{
	echo "No data found <br>";
}

}

if(isset($_POST['update'])){
	
	$isbn = $_POST['isbn'];
	$author = $_POST['author'];
	$category = $_POST['category'];
	$title = $_POST['title'];
	$year = $_POST['year'];
		
	$query = "Update classics set author='$author', title='$title', category='$category',
	year='$year' where isbn = $isbn ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: viewRecord.php");
		
}

$conn->close();







?>