<?php

$page_roles = array('admin','author');

require_once 'login.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

echo "<a href='addRecord.php'>Add Book</a>";
echo "<br>";
echo "<a href='logout.php'>Logout</a>";

$query = "SELECT * FROM classics";

$result = $conn->query($query); 
if(!$result) die($conn->error);

if($result->num_rows > 0){  //there is more than 0 row

	while($row = $result->fetch_array(MYSQLI_ASSOC)){	
		
echo <<<_END
		<pre>
			Author: <a href='updateRecord.php?isbn=$row[isbn]'>$row[author]</a>
			Title: $row[title]
			Category: $row[category]
			Year: $row[year]
			ISBN: $row[isbn]	
			
			<form action='deleteRecord.php' method='post'>
				<input type='hidden' name='delete' value='yes'>
				<input type='hidden' name='isbn' value='$row[isbn]'>
				<input type='submit' value='DELETE RECORD'>	
			</form>
		
		</pre>
	
_END;
	}
}else{
	echo "No data found <br>";
}

$result->close();
$conn->close();







?>