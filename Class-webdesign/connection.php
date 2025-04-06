<?php
$con=mysqli_connect("127.0.0.1","root","Euqificap12.");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// Create database
$sql="CREATE DATABASE auca";
if (mysqli_query($con,$sql)) {
  echo "Database auca created successfully";
} else {
  echo "Error creating database: " . mysqli_error($con);
}
mysqli_close($con); 
?>


