<?php


$servername = "db-mysql-sfo3-32873-do-user-9247197-0.b.db.ondigitalocean.com";
$database = "defaultdb";
$username = "doadmin";
$password = "wyehrx4pkyhjabm6";

$dbPort = "25060";
// Create connection
//$conn = mysqli_connect($servername, $username, $password, $database);
$conn = mysqli_init();
$conn->real_connect("db-mysql-sfo3-32873-do-user-9247197-0.b.db.ondigitalocean.com",
 "doadmin", "wyehrx4pkyhjabm6", "defaultdb",25060,NULL,MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);

// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Connected successfully";
 


?>