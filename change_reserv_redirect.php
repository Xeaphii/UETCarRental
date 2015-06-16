<?php

// Start the session
session_start();

require 'deets.php';

$change_user_name_ = $_POST["change_user_name_"];
$change_car_mod_ = $_POST["change_car_mod_"];
$change_car_loc_ = $_POST["change_car_loc_"];
$change_pick_date_time = $_POST["change_pick_date"];
$change_pick_date_time .= " ".$_POST["change_pick_time"];
$change_ret_date_time = $_POST["change_ret_date"];
$change_ret_date_time .= " ".$_POST["change_ret_time"];





$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);

$sql = "SELECT `return_date_time` FROM `reservation_log` WHERE `username` = '{$change_user_name_}' and `car_serial_no` = (SELECT `serial_no` FROM `car`
  WHERE `model` = '{$change_car_mod_}' and `loc_name` = '{$change_car_loc_}') and `pick_up_date_time` = '{$change_pick_date_time }';";
  // /echo $sql;

  // echo $sql;
  // echo "<br/>";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $ret_time_= $row["return_date_time"];
  $ts1 = strtotime($ret_time_);
  $ts2 = strtotime($change_ret_date_time);



  $seconds_diff = $ts2 - $ts1;
  $no_hours = $seconds_diff/(60*60);
  $no_hours = $no_hours*50;

$sql = "UPDATE `reservation_log` SET `return_date_time`='{$change_ret_date_time}',late_fee={$no_hours} WHERE `location_name` = '{$change_car_loc_}'
and `car_serial_no` = (SELECT `serial_no` FROM `car`
  WHERE `model` = '{$change_car_mod_}' and `loc_name` = '{$change_car_loc_}') and `pick_up_date_time` = '$change_pick_date_time'
  and `username` = '{$change_user_name_}';";

$output_ = "";

if($result = mysqli_query($conn, $sql)){

  $sql="SELECT r_id FROM reservation_log
  a WHERE a.pick_up_date_time < '{$change_ret_date_time}' and  a.pick_up_date_time>'{$ret_time_}' and a.car_serial_no = (SELECT `serial_no` FROM `car`
  WHERE `model` = '{$change_car_mod_}' and `loc_name` = '{$change_car_loc_}');";
  if($result1 = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result1)>0){
        while($row1 = mysqli_fetch_assoc($result1))
        {
          if(!is_null($row1["r_id"]))
          {
            $output_  .= $row1["r_id"].",";
          }
         }
      }
    }else{
      header('Location: rent.php?error=1');
      die();
    }
    header("Location: change_res_emp.php?val={$output_}");
}else{
  header('Location: rentalchange.php?error=1');
}
mysqli_close($conn);
?>
