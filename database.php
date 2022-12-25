<?php
   $host        = "localhost";
   $port        = "5432";
   $dbname      = "postgres";
   $user        = "urosss";
   $password    = "enilnolsi"; 

   $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=urosss password=enilnolsi");
  
   if(!$dbconn) {
     echo "Error : Unable to open database.\n";
 } else {
     echo "Database is connected.\n";
     echo "<br>";
 }
?>
