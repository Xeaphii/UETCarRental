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
    <script src="js/jquery.js"></script>

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
                      <a  href="#">Rental Change</a>
                  </li>
                  <li>
                      <a  href="empreport.php">Report</a>
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

    </div>

    <script>
    $(document).ready(function(){

      $("input[name=pickup_date]").val(pick_date_time_.split(";")[0].split(" ")[0]);
      $("input[name=pickup_time]").val(pick_date_time_.split(";")[0].split(" ")[1]);

      $("input[name=return_date]").val(ret_date_time_.split(";")[0].split(" ")[0]);
      $("input[name=return_time]").val(ret_date_time_.split(";")[0].split(" ")[1]);

      $("#phone_no_").val(phone_no_.split(";")[0]);
      $("#email_").val(address_.split(";")[0]);


      $('#user_name_id').change(function() {
          //valuemodel = val();


          $("#phone_no_").val(phone_no_.split(";")[$('#user_name_id').prop("selectedIndex")]);
          $("#email_").val(address_.split(";")[$('#user_name_id').prop("selectedIndex")]);
          $("input[name=pickup_date]").val(pick_date_time_.split(";")[$('#user_name_id').prop("selectedIndex")].split(" ")[0]);
          $("input[name=pickup_time]").val(pick_date_time_.split(";")[$('#user_name_id').prop("selectedIndex")].split(" ")[1]);

          $("input[name=return_date]").val(ret_date_time_.split(";")[$('#user_name_id').prop("selectedIndex")].split(" ")[0]);
          $("input[name=return_time]").val(ret_date_time_.split(";")[$('#user_name_id').prop("selectedIndex")].split(" ")[1]);
      });

    });

    </script>
      <div class="row" style="margin-top:10px">

        <div class="col-xs-6 center-block" style="float:none">
          <p style="font-size:35px;color:#f05f40; margin-left:10px">User affected</p>
          <div class="form-group" style="margin-left:50px">
              <label style="color:#f05f40" for="InputMessage">Username:</label>
              <select name = "user_name_" id="user_name_id" class="form-control">





              <?php
              require 'deets.php';

              $val = $_REQUEST["val"];
              $val = trim($val, ",");
              $val_array = explode(",",$val);
              $conn = mysqli_connect($servername, $username, '');

              // Check connection
              if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
              }

              $output1= "";
              $output2= "";
              $output3="";
              $output4="";
              mysqli_select_db($conn,$dbname);
              foreach ($val_array as $value) {

                $sql = "SELECT `return_date_time`,`pick_up_date_time`,phnoe_no,address,member.username as user_name FROM `reservation_log` natural join member WHERE r_id={$value};;";

                if($result = mysqli_query($conn, $sql)){
                  if(mysqli_num_rows($result)>0){
                    	while($row = mysqli_fetch_assoc($result))
                      	{
                          echo "<option value='{$value}'>{$row['user_name']}</option>";
                          $output1.= "{$row['return_date_time']};";
                          $output2.= "{$row['pick_up_date_time']};";
                          $output3.= "{$row['phnoe_no']};";
                          $output4.= "{$row['address']};";
                       }


                    }
                  }else{
                    echo mysqli_errno($conn);;
                  }


                }
                $output1= trim($output1, ";");
                $output2= trim($output2, ";");
                $output3= trim($output3, ";");
                $output4= trim($output4, ";");
                echo "<script>
                   ret_date_time_ = '{$output1}';
                   pick_date_time_ = '{$output2}';
                   phone_no_ = '{$output3}';
                   address_ = '{$output4}';
                </script>";
                mysqli_close($conn);
              ?>

            </select>
          </div>
          <script>
          function hande_cancel_res(){
            $.get("cancel_res_emp.php", { r_id: $('#user_name_id').val()}, function(data){
                if(data=="100")
                {
                  $.notify("Reservation cancelled Successfully", "success");
                }else{
                  $.notify("Some error occured", "error");
                }
            });
          }

          </script>
          <form method="post" action="emp_reserv_redirect.php">
          <div class="form-group" style="margin-left:50px">
              <label style="color:#f05f40" for="InputMessage">Original pickup date time:</label>
              <div class="input-group">
                <input type="date" name="pickup_date">
                <input type="time" name="pickup_time">
              </div>
          </div>
          <div class="form-group" style="margin-left:50px" >
              <label style="color:#f05f40" for="InputMessage">Original return date time:</label>
              <div class="input-group">
                <input type="date" name="return_date">
                <input type="time" name="return_time">
              </div>
          </div>
          <div class="form-group" style="margin-left:50px">
              <label style="color:#f05f40" for="InputMessage">Email:</label>
              <input type="text" class="form-control" id="email_">
          </div>
          <div class="form-group" style="margin-left:50px">
              <label style="color:#f05f40" for="InputMessage">Phoneno:</label>
              <input type="text" class="form-control" id="phone_no_">
          </div>

          <input type="submit" style="background-color:#f05f40;margin-top:50px" name="submit" id="submit" value="Cancel Res." class="btn btn-info pull-right" onclick="hande_cancel_res()">
          <input type="submit" style="background-color:#f05f40;margin-top:50px;margin-right:20px" name="submit" id="submit" value="Car Avail."  class="btn btn-info pull-right">
        </form>
        </div>
            <div class="col-xs-1">

            </div >

    </div>


    </div>

</body>


    <!-- jQuery -->


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>
    <script src="js/notify.min.js"></script>

</body>

</html>
