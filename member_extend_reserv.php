<?php
session_start();
require 'deets.php';

$r_id = $_POST["r_id"];
$new_return_date_time = $_POST["new_return_date"];
$new_return_date_time .= " ".$_POST["new_return_time"];
// save the values to the database


$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);


$sql = "UPDATE `reservation_log` SET `return_date_time`='{$new_return_date_time}'
 WHERE r_id={$r_id} and (SELECT count(*) FROM (SELECT * FROM reservation_log)
 a WHERE a.pick_up_date_time < '{$new_return_date_time}' and (SELECT return_date_time
  FROM (SELECT * FROM reservation_log) b WHERE b.r_id = {$r_id}) <a.pick_up_date_time
  and a.car_serial_no = (SELECT car_serial_no FROM (SELECT * FROM reservation_log)
  c WHERE c.r_id = {$r_id}) )<1";
echo $sql;

if(mysqli_query($conn, $sql)){

    header('Location: rentinfo.php?success=1');
}else{
    header('Location: rentinfo.php?error=1');
}
?>
