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
    <script src="js/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" onload="myFunction()">
  <?php
  if(isset($_GET["error"])){
    if($_GET["error"] == 1){
      echo '<script>';
      echo 'function myFunction() {';
      echo '  $.notify("Some error occcured", "error");';
      echo '}';
      echo '</script>';
    }elseif($_GET["error"] == 2){
      echo '<script>';
      echo 'function myFunction() {';
      echo '  $.notify("Car not available for your choice right now", "error");';
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
                          <a  href="#">Rent a Car</a>
                      </li>
                      <li>
                          <a  href="rentinfo.php">Rental Information</a>
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

            <div class="col-xs-4 center-block" style="float:none">
        <p style="font-size:60px;color:#f05f40">Rent a car</p>
      </div>
    </div>

    <script>
    $(document).ready(function(){


      value = $('#choose_by').val();
      if(value == "Type"){
        $.get("distinctcartypes.php", {loc:$("#car_loc").val()}, function(data){

            $('#choice_options').empty();
            $('#choice_options').append(data);
        });
      }
      else if(value == "Model"){
        $.get("distinctcarmodels.php", {loc:$("#car_loc").val() }, function(data){

            $('#choice_options').empty();
            $('#choice_options').append(data);
        });
      }

      $('#choose_by').change(function() {

        value = $('#choose_by').val();
        if(value == "Type"){
          $.get("distinctcartypes.php", {loc:$("#car_loc").val()}, function(data){

              $('#choice_options').empty();
              $('#choice_options').append(data);
          });
        }
        else if(value == "Model"){
          $.get("distinctcarmodels.php", {loc:$("#car_loc").val() }, function(data){

              $('#choice_options').empty();
              $('#choice_options').append(data);
          });
        }
      });

      $('#car_loc').change(function() {

        loc = $('#car_loc').val();

        choose_by = $('#choose_by').val();

        if(choose_by == "Type"){
          choose_by="car_type";
        }else{
          choose_by="model";
        }
          $.get("loc_choice_car_details.php", {"loc":loc,"choose_by":choose_by}, function(data){

              $('#choice_options').empty();
              $('#choice_options').append(data);
          });

      });

    });

    </script>
      <div class="row" style="margin-top:50px">
        <form role="form" method="post" action="rent_redirect.php">
            <div class="col-xs-4 center-block" style="float:none">

                <div class="form-group">
                    <label style="color:#f05f40" for="InputMessage">Pickup Date Time:</label>
                    <div class="input-group">
                      <input type="date" name="pickup_date">
                      <input type="time" name="pickup_time">
                    </div>
                </div>
                <div class="form-group">
                    <label style="color:#f05f40" for="InputMessage">Return Date Time:</label>
                    <div class="input-group">
                      <input type="date" name="return_date">
                      <input type="time" name="return_time">
                    </div>
                </div>
                <div class="form-group">
                  <label style="color:#f05f40" for="sel1">Location:</label>
                  <select class="form-control" id="car_loc" name="car_loc_name">
                    <option>Electrical Dept.</option>
                    <option>SSC</option>
                    <option>Boys hostel</option>
                    <option>Auditorium</option>
                  </select>
                </div>
                <div class="form-group">
                  <label style="color:#f05f40" for="sel1">Choose By:</label>
                  <select class="form-control" id="choose_by" name="choose_by_name">
                    <option>Type</option>
                    <option>Model</option>
                  </select>
                  <select class="form-control" id="choice_options" name="choice_options_name">
                  </select>
                </div>
                <input type="submit" style="background-color:#f05f40" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
            </div>
        </form>

    </div>


    </div>



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
