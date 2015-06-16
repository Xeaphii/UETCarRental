<?php

// Start the session
session_start();

require 'deets.php';

// create connection to database
// ...

// sanitize the inputs
// ...

// save the values to the database

$loc = $_GET["loc"];
$return_res = $_GET["choose_by"];

$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);


$sql = "SELECT distinct `{$return_res}` FROM `car` where loc_name='{$loc}';";

if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result)>0){
    	while($row = mysqli_fetch_assoc($result))
      	{
            echo "<option>{$row[$return_res]}</option>";
       }
    }
  }else{
    echo "Error";
  }
mysqli_close($conn);
?>
