<?php

// Start the session
session_start();

require 'deets.php';

$c_loc = $_POST["c-loc"];
$car_model = $_POST["choose-car"];
$descp = $_POST["descp"];

// create connection to database
// ...

// sanitize the inputs
// ...

// create an MD5 hash of the password


// save the values to the database


$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);

$sql = "INSERT INTO `service_request`(`car_serial_no`, `username`, `service_date_time`, `problem`) VALUES
  ((SELECT serial_no FROM `car` WHERE `loc_name` = '{$c_loc}' and model = '{$car_model}'),'{$_SESSION["user"]}',now(),'{$descp}');";

if(mysqli_query($conn, $sql)){
      header('Location: maintainance.php?success=1');}
else{
  header('Location: maintainance.php?error=1');
}
mysqli_close($conn);
?>
