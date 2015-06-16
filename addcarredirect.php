<?php


session_start();

require 'deets.php';
require 'funct.php';

$v_sno = POST("v-sno");
$c_model = POST("c-model");
$c_type = POST("c-type");
$c_loc = POST("car-location");
$c_color = POST("c-color");
$h_rate = POST("h-rate");
$d_rate = POST("d-rate");
$seating_cap = POST("seating-capacity");
$trna_type = POST("transmission-type");
$bluetooth = POST("bluetooth");
$auc_cable = POST("auc-cable");

// create connection to database
// ...

$bluetooth = SanitizeBooleanVar($bluetooth);
$auc_cable = SanitizeBooleanVar($auc_cable);


$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);

$sql = "select * from temo where (SELECT count(*)  FROM `car` WHERE `loc_name` = '$c_loc') <= (SELECT cap FROM `location` WHERE `name` = '{$c_loc}');";

echo $sql;
if($result=mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result)>0){

      $sql = "select * from temo where (SELECT count(*) FROM `car` WHERE `loc_name` = '{$c_loc}' and `model` = '{$c_model}')<1";

      if($result=mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result)>0){

            $sql = "INSERT INTO `car`(`serial_no`, `model`, `auc_cab`, `bluetooth`, `color`, `car_type`, `hour_rate`, `daily_rate`, `capacity`, `transmission`, `loc_name`) VALUES
             ({$v_sno},'{$c_model}',{$auc_cable},{$bluetooth},'{$c_color}','{$c_type}',{$h_rate},{$d_rate},{$seating_cap},'{$trna_type}','{$c_loc}');";
             //echo $sql;
              if($result=mysqli_query($conn, $sql)){

                   header('Location: managecars.php?success=1');


               }else{
                 header('Location: managecars.php?error=1');
               }

          }
          else{
            header('Location: managecars.php?error=1');
          }
        }
        else{
          header('Location: managecars.php?error=1');
        }
  }
}else{
  header('Location: managecars.php?error=1');
}



mysqli_close($conn);
?>
