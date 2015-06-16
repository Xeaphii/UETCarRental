<?php

// Start the session
session_start();

require 'deets.php';

$data = $_POST["car_id_name"];
echo $data;
// create connection to database
// ...

// sanitize the inputs
// ...
$splittedData = explode(",",$data );
$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);


$sql = "INSERT INTO `reservation_log`( `username`, `amount`, `return_date_time`, `pick_up_date_time`, `car_serial_no`, `location_name`) VALUES
('{$_SESSION["user"]}',$splittedData[3],'$splittedData[2]','$splittedData[1]',$splittedData[0],'$splittedData[4]');";

if(mysqli_query($conn, $sql)){
    header('Location: home.php?success=2');
}else{
  header('Location: home.php?error=1');
}
mysqli_close($conn);
?>
