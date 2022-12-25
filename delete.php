<?php
//ini_set ('display_errors', 1);
//ini_set ('display_startup_errors', 1);
//error_reporting (E_ALL);

include_once 'database.php';
include_once 'escape.php';
include_once 'exception.php';

$id = $_GET['id'];

$query="SELECT * FROM users2 WHERE id='" . escape_pg($id). "'";
$result = pg_query($dbconn,$query);


if (filter_var($id, FILTER_VALIDATE_INT) === false || $id > PHP_INT_MAX) {
	throw new Exception("Deletion error! ID must be a number or smaller than " . PHP_INT_MAX);
}

if(!pg_num_rows($result )>=1){
	echo 'id does not exist: ';

	echo escape_html($id);
	echo '<br/>';
	echo '<br/>';
	
}
else{
	 	
	$query = "DELETE FROM users2 WHERE id='" . escape_pg($_GET['id']) . "'";
	if($result = pg_query($query)){
		echo "<br>";
		echo "<br>";
		echo "Data Deleted Successfully.";
		echo '<br/>';
		echo '<br/>';
		echo '<br/>';
		
	}
	else{
		echo "Error.";
	}
}
  
?>

<button onclick="location.href = 'index.php';" id="myButton";  >Home</button>

