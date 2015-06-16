<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  session_start();

  if (isset($_SESSION['remember']) && (time() - $_SESSION['remember'] > 1800)) {
  // last request was more than 30 minutes ago
  session_unset();     // unset $_SESSION variable for the run-time
  session_destroy();   // destroy session data in storage
  }
  $_SESSION['remember'] = time();

  if(!isset($_SESSION['user'])) {
      header('Location: login.php');
  }

  if(!isset($_SESSION['type'])){
    header('Location: login.php');}
  elseif($_SESSION['type'] == 2){
    header('Location: emphome.php');}
  elseif($_SESSION['type'] == 1){
    header('Location: adminhome.php');}
  ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <title>Car Rental</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" href="css/plans.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" onload="myFunction()">
  <?php
  if(isset($_GET["success"])){
    if($_GET["success"] == 1){
      echo '<script>';
      echo 'function myFunction() {';
      echo '  $.notify("Car reservation date time extended", "success");';
      echo '}';
      echo '</script>';
    }
  }elseif(isset($_GET["error"])){
    if($_GET["error"] == 1){
      echo '<script>';
      echo 'function myFunction() {';
      echo '  $.notify("Unfortunatuly, some error occured! reservation date time not cahnged  ", "error");';
      echo '}';
      echo '</script>';
    }
  }
  ?>
    <div class="container" style="margin-top:5%;">
      <nav id="mainNav" class="navbar navbar-default navbar-fixed-top" style="background-color:#f05f40">
          <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand page-scroll" href="#page-top">UET Car Rental</a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                      <li>
                          <a  href="home.php">Home</a>
                      </li>
                      <li>
                          <a  href="plans.php">Plans</a>
                      </li>
                      <li>
                          <a  href="rent.php">Rent a Car</a>
                      </li>
                      <li>
                          <a  href="#">Rental Information</a>
                      </li>
                      <li>
                          <a  href="setting.php">Information</a>
                      </li>
                      <li>
                          <a  href="changepassword.php">Account</a>
                      </li>
                      <li>
                          <a  href="logout.php">logout</a>
                      </li>
                  </ul>
              </div>
              <!-- /.navbar-collapse -->
          </div>
          <!-- /.container-fluid -->
      </nav>
      <div class="row" >

            <div class="col-xs-6 center-block" style="float:none">
        <p style="font-size:60px;color:#f05f40">Rental Information</p>
      </div>
    </div>
    <div class="row" >

  <div class="col-xs-4 center-block" style="float:none;margin-top:50px">
      <p style="font-size:25px;color:#f05f40">Current Reservation</p>
    </div>
  </div>

  <form role="form" method="post" action="member_extend_reserv.php">
  <div class="row">
    <div class="col-xs-10 center-block" style="float:none">
        <table style="color:#f05f40" class="table table-hover">
   <thead>
     <tr>
           <th>Date</th>
           <th>Reservation time</th>
           <th>Car</th>
           <th>Location</th>
           <th>Amount</th>
           <th>Extend?</th>
         </tr>
       </thead>
       <tbody>

         <?php
         require 'deets.php';

         // save the values to the database


         $conn = mysqli_connect($servername, $username, '');

         // Check connection
         if (!$conn) {
             die("Connection failed: " . mysqli_connect_error());
         }


         mysqli_select_db($conn,$dbname);


         $sql = "SELECT * FROM `reservation_log` where `username` = '{$_SESSION["user"]}' and return_date_time > now();";

         if($result = mysqli_query($conn, $sql)){
           if(mysqli_num_rows($result)>0){
             	while($row = mysqli_fetch_assoc($result))
               	{
                   $sql = "SELECT `model` FROM `car` WHERE `serial_no` = '{$row["car_serial_no"]}';";
                   $result1 = mysqli_query($conn, $sql);
                   $row1 = mysqli_fetch_assoc($result1);
                     echo "<tr>
                       <td>";
                     echo explode(" ",$row["pick_up_date_time"])[0];
                     echo "</td>
                       <td>";
                         echo explode(" ",$row["pick_up_date_time"])[1]."-".explode(" ",$row["return_date_time"])[1];
                     echo "</td>
                       <td>{$row1["model"]}</td>
                       <td>{$row["location_name"]}</td>
                       <td>{$row["amount"]}</td>

                       <td><input type='radio' name='r_id' value='{$row["r_id"]}'></td>
                      </tr>";
                }
             }
           }else{
             echo "Error";
           }

         mysqli_close($conn);
         ?>


       </tbody>
     </table>

     <div class="form-group">
         <label style="color:#f05f40" for="InputMessage">New return date time:</label>
         <div class="input-group">
           <input type="date" name="new_return_date">
           <input type="time" name="new_return_time">
         </div>
     </div>

     <input type="submit" style="background-color:#f05f40;margin-top:50px" name="submit" id="submit" value="Extend" class="btn btn-info pull-right">
    </div>
  </div>
</form>
    <hr/>

    <div class="col-xs-4 center-block" style="float:none;margin-top:50px">
        <p style="font-size:25px;color:#f05f40">Previous Reservation</p>
      </div>
    </div>


    <div class="row">
      <div class="col-xs-8 center-block" style="float:none">
          <table style="color:#f05f40" class="table table-hover">
     <thead>
       <tr>
             <th>Date</th>
             <th>Reservation time</th>
             <th>Car</th>
             <th>Location</th>
             <th>Amount</th>
           </tr>
         </thead>
         <tbody>
           <?php
           require 'deets.php';

           // save the values to the database


           $conn = mysqli_connect($servername, $username, '');

           // Check connection
           if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
           }


           mysqli_select_db($conn,$dbname);


           $sql = "SELECT * FROM `reservation_log` where `username` = '{$_SESSION["user"]}' and return_date_time <= now();";

           if($result = mysqli_query($conn, $sql)){
             if(mysqli_num_rows($result)>0){
               	while($row = mysqli_fetch_assoc($result))
                 	{

                     $sql = "SELECT `model` FROM `car` WHERE `serial_no` = '{$row["car_serial_no"]}';";
                     $result1 = mysqli_query($conn, $sql);
                     $row1 = mysqli_fetch_assoc($result1);
                       echo "<tr>
                         <td>";
                       echo explode(" ",$row["pick_up_date_time"])[0];
                       echo "</td>
                         <td>";
                           echo explode(" ",$row["pick_up_date_time"])[1]."-".explode(" ",$row["return_date_time"])[1];
                       echo "</td>
                         <td>{$row1["model"]}</td>
                         <td>{$row["location_name"]}</td>
                         <td>{$row["amount"]}</td>
                        </tr>";
                  }
               }
             }else{
               echo "Error";
             }

           mysqli_close($conn);
           ?>

         </tbody>
       </table>

      </div>
    </div>


    </div>

</body>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>
    <script src="js/notify.min.js"></script>

</body>

</html>
