<?php
include_once 'database.php';
include_once 'escape.php';
include_once 'exception.php';


//ini_set ('display_errors', 1);
//ini_set ('display_startup_errors', 1);
//error_reporting (E_ALL);


$id = $_GET["id"]; 

//if(!is_numeric($id) || $id <= PHP_INT_MAX)  {
if (filter_var($id, FILTER_VALIDATE_INT) === false || $id > PHP_INT_MAX) {
	throw new Exception("Deletion error! ID must be a number or smaller than " . PHP_INT_MAX);
}

$result = pg_query($dbconn,"SELECT * FROM users2 WHERE id='" . escape_pg($_GET['id']) . "'");
$row= pg_fetch_assoc($result);


$query="SELECT * FROM users2 WHERE id='" . escape_pg($id). "'";

$result = pg_query($dbconn,$query);

if(!pg_num_rows($result )>=1){
	echo 'id does not exist: ';
	//echo $id;
	echo escape_html($id);
}

if(count($_POST)>0) {

	$id = $_POST['id'];
	if (filter_var($id, FILTER_VALIDATE_INT) === false || $id > PHP_INT_MAX) {
		throw new Exception("Update error! ID must be a number or smaller than " . PHP_INT_MAX);
}
		
$date = explode('-', $_POST['date']);
		
//correct date format: yyyy-mm-dd

if (array_key_exists(0, $date) && array_key_exists(1, $date) && array_key_exists(2, $date) && checkdate($date[1], $date[2], $date[0]) === true) {
	$query = "UPDATE users2 SET id='" . escape_pg($_POST['id']) . "', name='" . escape_pg($_POST['name']) . "', age='" . escape_pg($_POST['age']) . "', email='" . escape_pg($_POST['email']) . "', date='" . escape_pg($_POST['date']) . "', comment='" . escape_pg($_POST['comment']) . "' WHERE id='" . escape_pg($_POST['id']) . "'"; 
		
	if($result = pg_query($query)){
    echo "Record Updated Successfully.";
    }
    else{
    echo "Error.";
	}
		
	}
	else {
			
	throw new Exception("Date error, date must be valid and in format yyyy-mm-dd" );
   }
}

$result = pg_query(
	$dbconn,
	"SELECT * FROM users2 WHERE id='" 
	. escape_pg($_GET['id']) 
	. "'"
	);
$row= pg_fetch_assoc($result);

?>

<html>
<head>
	<title>Update Data</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="view.php">List</a>


</div>
    Id: <br>
	<input type="text" name="id"  value="<?php echo escape_html($row['id']); ?>">
	<br>
	Name: <br>
	<input type="text" name="name"  value="<?php echo escape_html($row['name']); ?>">
	<br>
	Age :<br>
	<input type="text" name="age"  value="<?php echo escape_html($row['age']); ?>">
	<br>
	<br>
	Email:<br>
	<input type="text" name="email" value="<?php echo escape_html($row['email']); ?>">
	<br>
    Date:<br>
	<input type="text" name="date" value="<?php echo escape_html($row['date']); ?>">
	<br>
    Comment: <br>
	<input type="text" name="comment"  value="<?php echo escape_html($row['comment']); ?>">
	<br>
	<input type="submit" name="submit" value="Submit" class="buttom">

	<style><?php include 'css.css'; ?></style>

</form>
</body>
</html>