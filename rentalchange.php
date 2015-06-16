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

      $('#change_user_name').change(function() {
          valuemodel = $('#change_user_name').val();
          $.get("car_details_from_username.php", { username: valuemodel}, function(data){

            $('#change_car_loc').empty();
            $('#change_car_loc').append(data.split(",")[1]);

            $('#change_car_mod').empty();
            $('#change_car_mod').append(data.split(",")[0]);

            pick_dates_times = data.split(",")[2];
            ret_dates_times = data.split(",")[3];

            if(pick_dates_times.length>0)
            {
                $("input[name=change_pick_date]").val(pick_dates_times.split(";")[0].split(" ")[0]);
                $("input[name=change_pick_time]").val(pick_dates_times.split(";")[0].split(" ")[1]);
            }
            if(ret_dates_times.length>0)
            {
                $("input[name=change_ret_date]").val(ret_dates_times.split(";")[0].split(" ")[0]);
                $("input[name=change_ret_time]").val(ret_dates_times.split(";")[0].split(" ")[1]);
            }

          });
      });
      $('#change_car_mod').change(function() {
          //valuemodel = val();
          $('#change_car_loc').prop("selectedIndex",$('#change_car_mod').prop("selectedIndex"));


          $("input[name=change_pick_date]").val(pick_dates_times.split(";")[$('#change_car_mod').prop("selectedIndex")].split(" ")[0]);
          $("input[name=change_pick_time]").val(pick_dates_times.split(";")[$('#change_car_mod').prop("selectedIndex")].split(" ")[1]);

          $("input[name=change_ret_date]").val(ret_dates_times.split(";")[$('#change_car_mod').prop("selectedIndex")].split(" ")[0]);
          $("input[name=change_ret_time]").val(ret_dates_times.split(";")[$('#change_car_mod').prop("selectedIndex")].split(" ")[1]);
      });
      $('#change_car_loc').change(function() {
          //valuemodel = val();
          $('#change_car_mod').prop("selectedIndex",$('#change_car_loc').prop("selectedIndex"));
          $("input[name=change_pick_date]").val(pick_dates_times.split(";")[$('#change_car_loc').prop("selectedIndex")].split(" ")[0]);
          $("input[name=change_pick_time]").val(pick_dates_times.split(";")[$('#change_car_loc').prop("selectedIndex")].split(" ")[1]);

          $("input[name=change_ret_date]").val(ret_dates_times.split(";")[$('#change_car_loc').prop("selectedIndex")].split(" ")[0]);
          $("input[name=change_ret_time]").val(ret_dates_times.split(";")[$('#change_car_loc').prop("selectedIndex")].split(" ")[1]);
      });
    });

    </script>
      <div class="row" style="margin-top:10px">

            <div class="col-xs-6 center-block" style="float:none">
              <form method="post" action="change_reserv_redirect.php">
                <p style="font-size:35px;color:#f05f40;margin-left:50px">Rental Information</p>
                <div class="form-group" style="margin-left:50px">
                    <label style="color:#f05f40" for="InputMessage">Enter Username:</label>
                    <input type="text" class="form-control" name="change_user_name_" id="change_user_name">
                </div>
                <hr/>
                <div class="form-group" style="margin-left:50px">
                    <label style="color:#f05f40" for="InputMessage">Car model:</label>
                    <select  class="form-control" name="change_car_mod_"  id="change_car_mod">

                    </select>
                </div>
                <div class="form-group" style="margin-left:50px">
                    <label style="color:#f05f40" for="InputMessage">Car Location:</label>

                    <select class="form-control" name="change_car_loc_" id="change_car_loc">

                    </select>
                </div>
                <div class="form-group" style="margin-left:50px">
                    <label style="color:#f05f40" for="InputMessage">Original return date time:</label>
                    <div class="input-group">
                      <input type="date" name="change_pick_date">
                      <input type="time" name="change_pick_time">
                    </div>
                </div>
                <div class="form-group" style="margin-left:50px" >
                    <label style="color:#f05f40" for="InputMessage">New arrival date time:</label>
                    <div class="input-group">
                      <input type="date" name="change_ret_date">
                      <input type="time" name="change_ret_time">
                    </div>
                </div>

                <input type="submit" style="background-color:#f05f40;margin-top:50px" name="submit" id="submit" value="Add" class="btn btn-info pull-right">
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
