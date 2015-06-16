<?php

// Start the session
session_start();

require 'deets.php';
require 'funct.php';

$loc = $_GET["loc"];

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


$sql = "SELECT `model` FROM `car` WHERE `loc_name` = '{$loc}';";

if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result)>0){
  	while($row = mysqli_fetch_assoc($result))
  	{
  		if(is_null($row['model'])){
        echo '<option>nill</option>';
      }
  		else{
        echo "<option>{$row['model']}</option>";
      }
    }
  }else{
    echo "Error";
  }
}else{
  echo "Error";
}
mysqli_close($conn);
?>
