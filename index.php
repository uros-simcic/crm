<!DOCTYPE html>
<html>
  <body>
	<form method="post" >
	
    Id:<br>
		<input type="bigint" name="id">
		<br>  
    Name:<br>
		<input type="text" name="name">
		<br>
		Age:<br>
		<input type="text" name="age">
		<br>
		Email Id:<br>
		<input type="email" name="email">
		<br><br>
   	<br><br>
    Comment:<br>
		<input type="text" name="comment">
		<br>
    <br><br>
		<input type="submit" name="save" value="submit">
	</form>
    <body>
    <br/><br/>
    <a href="view.php">View entries</a>
    <br/><br/>
    
  </body>
</html>

<style><?php include 'css.css'; ?></style>

<?php

//ini_set ('display_errors', 1);
//ini_set ('display_startup_errors', 1);
//error_reporting (E_ALL);

include_once 'database.php';
include_once 'escape.php';
include_once 'exception.php';

if(isset($_POST['save']))
{	 

$id = $_POST['id'];

   
  function checkId($id) {
    if (filter_var($id, FILTER_VALIDATE_INT) === false || $id > PHP_INT_MAX) {
        
  
    throw new Exception("ID not valid or larger than " . PHP_INT_MAX);

    }
          
    return $id;

    }   

$id = checkId($id);


$query="SELECT * FROM users2 WHERE id='" . escape_pg($id). "'";
$result = pg_query($dbconn,$query) or die ("Query could not be executed");

  if(pg_num_rows($result )>=1){
     echo 'id already exists: ';
     //echo $id;
     echo escape_html($id);
  }

  else{
        echo 'New id inserted';
        printf("\n");
      }
  }


       
  $name = pg_escape_string($_POST['name']);
    
  $age = $_POST['age'];
     
  if (filter_var($age, FILTER_VALIDATE_INT) === false) {
    die;

    
  }

//trigger error if <18
  if ($age<18) {
  //trigger_error("underaged",E_USER_WARNING);
  throw new Exception("underaged");
}      

function customError($errno, $errstr) {
    echo "<b>Error:</b> [$errno] $errstr<br>";
   
    die();
  }

set_error_handler("customError",E_USER_WARNING);
  
$email = pg_escape_string($_POST['email']);
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  // invalid emailaddress
            
  }
  $date = date('Y-m-d H:i:s');
     
    
  $comment = $_POST['comment'];

$query = "INSERT INTO users2(id,name,age,email,date,comment) 
VALUES ('" . escape_pg($id) . "', '" . escape_pg($name) . "', '" . escape_pg($age) . "', '" . escape_pg($email) . "', '" . escape_pg($date) . "', '" . escape_pg($comment) . "')";
   

//echo $query;

/*
VALUES ('"
. escape_pg($id)
. "', '"
. escape_pg($name)
. "', '"
. escape_pg($age)
. "', '"
. escape_pg($email)
. "', '"
. escape_pg($date)
. "', '"
. escape_pg($comment)
. "')";
*/

     
if($result = pg_query($query)){
  echo "<br>";
  echo "<p>Data added successfully.</p>";

        
	}
	else{
	echo "<p2>Entry error.</p>";
        
}
?>
