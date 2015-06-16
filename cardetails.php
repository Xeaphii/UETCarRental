<?php

// Start the session
session_start();

require 'deets.php';
require 'funct.php';

$loc = $_GET["loc"];
$model = $_GET["model"];

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


$sql = "SELECT `car_type`,`color`,`capacity`,`transmission` FROM `car` WHERE `loc_name` = '{$loc}' and model = '{$model}';";

if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result)>0){
    	while($row = mysqli_fetch_assoc($result))
      	{
            echo $row["car_type"].",";
            echo $row["color"].",";
            echo $row["capacity"].",";
            echo $row["transmission"];
       }
    }
  }else{
    echo "Error";
  }

mysqli_close($conn);
?>
