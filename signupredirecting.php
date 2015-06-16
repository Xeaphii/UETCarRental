<?php

// Start the session
session_start();

require 'deets.php';

$user = $_POST["username"];
$pas = $_POST["password"];
$c_pass = $_POST["c-password"];
$acc_type = $_POST["acc-type"];

// create connection to database
// ...

// sanitize the inputs
// ...

// create an MD5 hash of the password
if($pas != $c_pass)
    header('Location: signup.php?error=1');
$pas = md5($pas);
$c_pass = md5($c_pass);

// save the values to the database


$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);


$sql = "INSERT INTO user(username, password, type) VALUES ('{$user}','{$pas}','{$acc_type}');";

if(mysqli_query($conn, $sql)){

    $_SESSION["type"] = $acc_type;
    $_SESSION["user"] = $user;
    if($acc_type == 1)
    {header('Location: adminhome.php');}
    elseif($acc_type == 2){
      header('Location: emphome.php');}
    elseif($acc_type == 3){
      header('Location: home.php');}

}else{
  header('Location: signup.php?error=2');
}
mysqli_close($conn);
?>
