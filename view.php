<?php
//ini_set ('display_errors', 1);
//ini_set ('display_startup_errors', 1);
//error_reporting (E_ALL);

include_once 'escape.php';
include_once 'database.php';

$result = pg_query($dbconn,"SELECT * FROM users2");
?>

<!DOCTYPE html>
<html>
 <head>
 <title> Retrive data</title>
 </head>
<body>
<table>
	<tr>
        <td>Id</td>
		<td>Name</td>
		<td>Age</td>
		<td>Email</td>
        <td>Date</td>
        <td>Comment</td>
	</tr>

	
<?php
$i=0;
while($row=pg_fetch_assoc($result)) {
?>
	<tr>
        <td><?php echo escape_html($row["id"]); ?></td>
		<td><?php echo escape_html($row["name"]); ?></td>
		<td><?php echo escape_html($row["age"]); ?></td>
		<td><?php echo escape_html($row["email"]); ?></td>
        <td><?php echo escape_html($row["date"]); ?></td>
        <td><?php echo escape_html($row["comment"]); ?></td>
        <td><a href="delete.php?id=<?php echo escape_html($row["id"]); ?>">Delete</a></td>
        <td><a href="update.php?id=<?php echo escape_html($row["id"]); ?>">Update</a></td>
	</tr>

<?php
$i++;
}
?>

</table>
<button onclick="location.href = 'index.php';" id="myButton" class="float-left submit-button" >Home</button>

</body>
</html>
<style><?php include 'css.css'; ?></style>
