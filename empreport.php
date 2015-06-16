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
  elseif($_SESSION['type'] == 3){
    header('Location: home.php');}
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

<body id="page-top" >

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
                      <a  href="emphome.php">Home</a>
                  </li>
                  <li>
                      <a  href="managecars.php">Manage</a>
                  </li>
                  <li>
                      <a  href="maintainance.php">Maintainance</a>
                  </li>
                  <li>
                      <a  href="rentalchange.php">Rental Change</a>
                  </li>
                  <li>
                      <a  href="#">Report</a>
                  </li>
                  <li>
                      <a  href="empchangepass.php">Account</a>
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

  <div class="col-xs-4 center-block" style="float:none;margin-top:50px">
      <p style="font-size:25px;color:#f05f40">Frequent Users</p>
    </div>
  </div>


  <div class="row">
    <div class="col-xs-10 center-block" style="float:none">
        <table style="color:#f05f40" class="table table-hover">
   <thead>
     <tr>
           <th>Username</th>
           <th>Driving plan</th>
           <th>No of Driving per month</th>
         </tr>
       </thead>
       <tbody>

        <?php


        require 'deets.php';


        $conn = mysqli_connect($servername, $username, '');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }


        mysqli_select_db($conn,$dbname);


        $sql = "SELECT username, plan_name , COUNT(*)/3 AS NoOfReservationsPerMonth
        FROM reservation_log NATURAL JOIN member
        WHERE (DATEDIFF( CURRENT_DATE, pick_up_date_time ) /30 ) >=0
        AND (DATEDIFF( CURRENT_DATE, pick_up_date_time ) /30) <=3 GROUP BY username ORDER BY COUNT(*) DESC limit 5;
        ;";

        if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result)>0){
            	while($row = mysqli_fetch_assoc($result))
              	{
                    echo "<tr>
                          <td>{$row["username"]}</td>
                          <td>{$row["plan_name"]}</td>
                          <td>{$row["NoOfReservationsPerMonth"]}</td>
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

    <hr/>

    <div class="col-xs-6 center-block" style="float:none;margin-top:50px">
        <p style="font-size:25px;color:#f05f40">Maintainance History Report</p>
      </div>
    </div>


    <div class="row">
      <div class="col-xs-8 center-block" style="float:none">
          <table style="color:#f05f40" class="table table-hover">
     <thead>
       <tr>
             <th>Car</th>
             <th>Date Time</th>
             <th>Problem</th>
             <th>Employee</th>
           </tr>
         </thead>
         <tbody>
           <?php


           require 'deets.php';


           $conn = mysqli_connect($servername, $username, '');

           // Check connection
           if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
           }


           mysqli_select_db($conn,$dbname);


           $sql = "select model,service_date_time,username,problem  from (temo natural join service_request) JOIN car  on car_serial_no=serial_no order by 'count(a.car_serial_no)';";

           if($result = mysqli_query($conn, $sql)){
             if(mysqli_num_rows($result)>0){
                 while($row = mysqli_fetch_assoc($result))
                   {
                       echo "<tr>
                             <td>{$row["model"]}</td>
                             <td>{$row["service_date_time"]}</td>
                             <td>{$row["problem"]}</td>
                             <td>{$row["username"]}</td>
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

    <hr/>

    <div class="col-xs-6 center-block" style="float:none;margin-top:50px">
        <p style="font-size:25px;color:#f05f40">Location Preference Report</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-8 center-block" style="float:none">
          <table style="color:#f05f40" class="table table-hover">
     <thead>
       <tr>
             <th>MOnth</th>
             <th>Location</th>
             <th>No. of Reservations</th>
             <th>Total no. of hours</th>
           </tr>
         </thead>
         <tbody>
           <?php


           require 'deets.php';


           $conn = mysqli_connect($servername, $username, '');

           // Check connection
           if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
           }


           mysqli_select_db($conn,$dbname);


           $sql = "SELECT  MONTH( pick_up_date_time ) as months_, location_name, COUNT( * )
           AS NumOfReservation, SUM( TIMEDIFF( return_date_time, pick_up_date_time )/(60*60) )
            AS TotalNoOfHours
           FROM reservation_log inner JOIN car on car_serial_no = serial_no WHERE (DATEDIFF( CURRENT_DATE, pick_up_date_time ) /30) >=0 AND
           (DATEDIFF( CURRENT_DATE, pick_up_date_time ) /30) <=3 AND pick_up_date_time < CURRENT_DATE
           GROUP BY location_name, MONTH( pick_up_date_time ),YEAR( pick_up_date_time )
           ORDER BY YEAR( pick_up_date_time ) , MONTH( pick_up_date_time ) DESC;";

           if($result = mysqli_query($conn, $sql)){
             if(mysqli_num_rows($result)>0){
                 while($row = mysqli_fetch_assoc($result))
                   {
                       echo "<tr>
                             <td>{$row["months_"]}</td>
                             <td>{$row["location_name"]}</td>
                             <td>{$row["NumOfReservation"]}</td>
                             <td>{$row["TotalNoOfHours"]}</td>
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

</body>

</html>
