<?php
// Database connection
$hostname = "localhost";
$dbuser = "root";
$password = "Euqificap12.";
$dbname = "AccountDB";
$conn=mysqli_connect($hostname, $dbuser, $password, $dbname); 
if (!$conn)  {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully to " . $dbname;
}
?>