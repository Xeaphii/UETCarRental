<?php
session_start();
require 'deets.php';

$old_password = $_POST["old-password"];
$new_password = $_POST["new-password"];
$confirm_new_password = $_POST["c-new-password"];
if($new_password != $confirm_new_password)
    header('Location: signup.php?error=1');
$new_password = md5($new_password);
$old_password = md5($old_password);

// save the values to the database


$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);


$sql = "Update user set password = '{$new_password}' where username='{$_SESSION["user"]}' and password ='{$old_password}' ;";

if(mysqli_query($conn, $sql)){
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();
    header('Location: login.php');
}else{
    header('Location: changepassword.php?error=1');
}
mysqli_close($conn);
?>
