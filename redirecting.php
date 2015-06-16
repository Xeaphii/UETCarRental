<?php

// Start the session
session_start();

require 'deets.php';

$user = $_POST["username"];
$pas = $_POST["password"];

// create connection to database
// ...

// sanitize the inputs
// ...

// create an MD5 hash of the password
$pas = md5($pas);

// save the values to the database


$conn = mysqli_connect($servername, $username, '');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($conn,$dbname);


  $sql = "SELECT type FROM user WHERE username = '{$user}' and password = '{$pas}';";
echo $sql;

if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result)>0){
  	while($row = mysqli_fetch_assoc($result))
  	{
  		if(is_null($row['type']))
        header('Location: login.php?attemp=1');
  		else
  			if($row['type'] == 1){
          if(isset($_POST['remember']))
            $_SESSION['remember'] = time();
          $_SESSION["type"] = "1";
          $_SESSION["user"] = $user;
          header('Location: adminhome.php');
        }else if($row['type'] == 2){
          if(isset($_POST['remember']))
            $_SESSION['remember'] = time();
          $_SESSION["type"] = "2";
          $_SESSION["user"] = $user;
          header('Location: home.php');
        }else if($row['type'] == 3){
          if(isset($_POST['remember']))
            $_SESSION['remember'] = time();

          $_SESSION["type"] = "3";
          $_SESSION["user"] = $user;
          header('Location: emphome.php');
        }
      }
  }else{
    header('Location: login.php?attemp=1');
  }
}else{
  header('Location: login.php?attemp=1');
}
mysqli_close($conn);
?>
