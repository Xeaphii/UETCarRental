<?php

// Start the session
session_start();

require 'deets.php';

$r_id = $_GET["r_id"];

// create connection to database
// ...

// sanitize the inputs
// ...

// save the values to the database


$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);


$sql = "DELETE FROM `reservation_log` WHERE `r_id` = '{$r_id}';";

if($result = mysqli_query($conn, $sql)){
    echo "100";
  }else{
    echo "202";
  }

mysqli_close($conn);
?>
