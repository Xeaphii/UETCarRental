<?php

// Start the session
session_start();

require 'deets.php';

$user = $_GET["username"];

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


$sql = "SELECT `model`,location_name,pick_up_date_time,return_date_time FROM `car` inner join reservation_log on `serial_no` = `car_serial_no` WHERE username = '{$user}';";
$output1= "";
$output2= "";
$output3="";
$output4="";
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result)>0){
    	while($row = mysqli_fetch_assoc($result))
      	{
          $output1.= "<option>{$row['model']}</option>";
          $output2.= "<option>{$row['location_name']}</option>";
          $output3.= "{$row['pick_up_date_time']};";
          $output4.= "{$row['return_date_time']};";
       }
       echo $output1.",".$output2.",".$output3.",".$output4;
    }
  }else{
    echo mysqli_errno($conn);;
  }

mysqli_close($conn);
?>
