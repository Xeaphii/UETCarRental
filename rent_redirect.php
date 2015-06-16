<?php

// Start tde session
session_start();

require 'deets.php';

$pickup_date = $_POST["pickup_date"];
$pickup_time = $_POST["pickup_time"];
$return_date = $_POST["return_date"];
$return_time = $_POST["return_time"];
$car_loc_ = $_POST["car_loc_name"];
$choose_by_ = $_POST["choose_by_name"];
$choice_options_ = $_POST["choice_options_name"];

$p_date_time = $pickup_date." ".$pickup_time;
$r_date_time = $return_date." ".$return_time;

$ts1 = strtotime($p_date_time);
$ts2 = strtotime($r_date_time);

if($p_date_time == ""||$r_date_time == ""){
  header('Location: rent.php?error=1');
  die();
}


$fair_type="";
$fair_duration=0;

$seconds_diff = $ts2 - $ts1;
if($seconds_diff /(60*60*24) >2)
{
  header('Location: rent.php?error=1');
  die();
}elseif($seconds_diff /(60*60*24) ==2){
  if(($seconds_diff/(60*60))%24>0){
    header('Location: rent.php?error=1');
    die();
  }else{
    $fair_duration = 2;
    $fair_type="day_wise";
  }
}elseif($seconds_diff /(60*60*24) <=2 && $seconds_diff /(60*60*24)>=0){
  if(($seconds_diff/(60*60))%24==0){
    $fair_duration = $seconds_diff /(60*60*24);
    $fair_type="day_wise";
  }else{
    $fair_duration = $seconds_diff/(60*60);
    $fair_type="hour_wise";
  }
}else
{
  header('Location: rent.php?error=1');
  die();
}

// create connection to database
// ...

// sanitize tde inputs
// ...

// create an MD5 hash of tde password

// save tde values to tde database

if($choose_by_ == "Type")
{
  $choose_by_="car_type";
}else{
  $choose_by_="model";
}



$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);

$sql = "SELECT * FROM member where username='{$_SESSION["user"]}'";
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result)==0){
    header('Location: setting.php?error=2');
    die();
    }
  }

$sql = "SELECT * FROM `driving_plan` WHERE `plan_name` = (SELECT `plan_name` FROM `member` WHERE `username` = '{$_SESSION["user"]}')";

$discount = 0;
$plan_name = "";
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_assoc($result))
      {
        if(!is_null($row["discount"]))
        {
          $discount  = $row["discount"];
        }
       }
    }
  }else{
    header('Location: rent.php?error=1');
    die();
  }

$sql = "select * from car where
serial_no in (select car_serial_no from reservation_log
 where  ((pick_up_date_time > '{$pickup_date} {$pickup_time}' and  '{$return_date} {$return_time}'< pick_up_date_time) or
 ( '{$pickup_date} {$pickup_time}' > return_date_time and '{$return_date} {$return_time}' > return_date_time ))
 and serial_no not in( select car_serial_no from service_request)) and loc_name='{$car_loc_}' and {$choose_by_} = '{$choice_options_}'
 UNION
 ( select * from car where serial_no not in
 (select car_serial_no from reservation_log)
 and  serial_no not in (select car_serial_no from service_request) and loc_name='{$car_loc_}' and {$choose_by_} = '{$choice_options_}');";

 if($result = mysqli_query($conn, $sql)){
   if(mysqli_num_rows($result)>0){
     $output="";
     	while($row = mysqli_fetch_assoc($result))
       	{
           if($discount !=0)
           {
             $discounted_price= $row["hour_rate"] - ($row["hour_rate"]*$discount)/100;
           }else{
             $discounted_price = $row["hour_rate"];
           }if($fair_type == "day_wise")
           {
             $estimated_cost = $fair_duration*$row["daily_rate"];
           }else{
             $estimated_cost = $fair_duration*$discounted_price;
           }
             $output.= "<tr>
                   <td>{$row["model"]}</td>
                   <td>{$row["car_type"]}</td>
                   <td>{$row["loc_name"]}</td>
                   <td>{$row["color"]}</td>
                   <td>{$row["hour_rate"]}</td>
                   <td>$discounted_price</td>
                   <td>{$row["daily_rate"]}</td>
                   <td>{$row["capacity"]}</td>
                   <td>{$row["transmission"]}</td>
                   <td>{$row["bluetooth"]}</td>
                   <td>{$row["auc_cab"]}</td>
                   <td>Available till</td>
                   <td>{$estimated_cost}</td>
                   <td><input type='radio' id='car_id'  name='car_id_name' value='";

                   $output.=  $row["serial_no"].",".$p_date_time.",".$r_date_time.",". $estimated_cost.",".$row["loc_name"];
                   $output.= "'></td></tr>";
        }
        header('Location: availability.php?value='.$output);
        die();
     }
     else{
        header('Location: rent.php?error=2');
        die();
     }
   }else{
      header('Location: rent.php?error=1');
      die();
   }

mysqli_close($conn);
?>
