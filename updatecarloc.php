<?php

// Start the session
session_start();

require 'deets.php';
require 'funct.php';

$loc = $_POST["c-loc"];
$choose_car = $_POST["choose-car"];
$car_new_loc = $_POST["car-new-loc"];



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


$sql = "UPDATE `car` SET `loc_name`='{$car_new_loc}' WHERE `model` = '{$choose_car}' and `loc_name` = '{$loc}';";

if($result = mysqli_query($conn, $sql)){
    header('Location: managecars.php?success=2');
}else{
  header('Location: managecars.php?error=2');
}
mysqli_close($conn);
?>
