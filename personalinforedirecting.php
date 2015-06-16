<?php
session_start();

require 'deets.php';
if(isset($_POST["f-name"]))
  {$f_name = $_POST["f-name"];}
  else {
    $f_name = "";
  }
  if(isset($_POST["m-name"]))
    {
$m_name = $_POST["m-name"];}
else {
  $m_name = "";
}
if(isset($_POST["l-name"]))
  {
$l_name = $_POST["l-name"];}
else {
  $l_name = "";
}
if(isset($_POST["email"]))
  {
$email = $_POST["email"];}
else {
  $email = "";
}
if(isset($_POST["phone"]))
  {
$phone = $_POST["phone"];}
else {
  $phone = "";
}
if(isset($_POST["address"]))
  {
$address = $_POST["address"];}
else {
  $address = "";
}
if(isset($_POST["acc-type"]))
  {
$acc_type = $_POST["acc-type"];}
else {
  $acc_type = "";
}
if(isset($_POST["credit-name"]))
  {
$credit_name = $_POST["credit-name"];}
else {
  $credit_name = "";
}
if(isset($_POST["card-number"]))
  {
$card_number = $_POST["card-number"];}
else {
  $card_number = "";
}
if(isset($_POST["cvv"]))
  {
$cvv = $_POST["cvv"];}
else {
  $cvv = "";
}
if(isset($_POST["expiry-date"]))
  {
$expiry_date = $_POST["expiry-date"];}
else {
  $expiry_date = "";
}
if(isset($_POST["billing-address"]))
  {
$billing_address = $_POST["billing-address"];}
else {
  $billing_address = "";
}

$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);
$sql = "INSERT INTO `card`(`card_no`, `name`, `cvv`, `expiry_date`, `billing_address`) VALUES ({$card_number},'{$credit_name}','{$cvv}','{$expiry_date}','{$billing_address}');";

if(mysqli_query($conn, $sql)){

  $sql = "INSERT INTO `member`(`username`, `fisrt_name`, `middle_name`, `last_name`, `address`, `phnoe_no`, `email`, `card_no`, `plan_name`)
                    VALUES ('{$_SESSION['user']}','{$f_name}','{$m_name}','{$l_name}','{$address}','{$phone}','{$email}',{$card_number},'{$acc_type}');";

  if(mysqli_query($conn, $sql)){

      if($_SESSION["type"] == 1)
      {header('Location: adminhome.php?success=1');}
      elseif($_SESSION["type"] == 2){
        header('Location: emphome.php?success=1');}
      elseif($_SESSION["type"] == 3){
        header('Location: home.php?success=1');}

  }else{
    header('Location: setting.php?error=2');
  }

}else{
  header('Location: setting.php?error=1');
}


mysqli_close($conn);



?>
