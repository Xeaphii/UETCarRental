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
    <script src="js/jquery.min.js"></script>
    <script src="js/notify.min.js"></script>
</head>

<body id="page-top" onload="myFunction()">
  <?php
  if(isset($_GET["success"])){
    if($_GET["success"] == 1){
      echo '<script>';
      echo 'function myFunction() {';
      echo '  $.notify("Mantainance request made Successfully", "success");';
      echo '}';
      echo '</script>';
    }

  }elseif(isset($_GET["error"])){
    if($_GET["error"] == 1){
      echo '<script>';
      echo 'function myFunction() {';
      echo '  $.notify("OPpps! some error occured!mantainance request not made", "error");';
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
                        <a  href="emphome.php">Home</a>
                    </li>
                    <li>
                        <a  href="managecars.php">Manage</a>
                    </li>
                    <li>
                        <a  href="#">Maintainance</a>
                    </li>
                    <li>
                        <a  href="rentalchange.php">Rental Change</a>
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
      <div class="row" >

            <div class="col-xs-8 center-block" style="float:none">
        <p style="font-size:60px;color:#f05f40">Maintainance Request</p>
      </div>
    </div>

    <script>
    $(document).ready(function(){


      $.get("findcars.php", { loc: $('#car-loc').val() }, function(data){

          $('#choose-car').empty();
          $('#choose-car').append(data);
          $.get("cardetails.php", { loc: $('#car-loc').val(),model:$('#choose-car').val() }, function(data){

              $('#car-type-id').val(data.split(",")[0]);

              $('#car-color-id').val(data.split(",")[1]);

              $('#seating-cap-id').val(data.split(",")[2]);

              $('#trans-id').val(data.split(",")[3]);
          });
      });


      $('#car-loc').change(function() {
        value = $('#car-loc').val();
          $.get("findcars.php", { loc: value }, function(data){

              $('#choose-car').empty();
              $('#choose-car').append(data);
          });
      });

    });

    </script>

      <div class="row" style="margin-top:50px">
        <form role="form" method="post" action="mantainance_req_redirect.php">
            <div class="col-xs-4 center-block" style="float:none">

              <div class="form-group" style="margin-left:0px">
                  <label style="color:#f05f40" for="InputMessage">Car current location:</label>
                  <select name="c-loc" class="form-control" id="car-loc">
                    <option>Electrical Dept.</option>
                    <option>SSC</option>
                    <option>Boys hostel</option>
                    <option>Auditorium</option>
                  </select>
              </div>

              <div class="form-group" style="margin-left:0px">
                  <label style="color:#f05f40" for="InputMessage">Choose car:</label>
                  <select name="choose-car" class="form-control" id="choose-car">
                    <option>Honda Civic</option>
                    <option>Mehran </option>
                    <option>Bolan</option>
                    <option>Audi a4</option>
                  </select>
              </div>
                <div class="form-group">
                  <label style="color:#f05f40" for="sel1">Brief description of problem:</label>
                  <textarea class="form-control" rows="6" placeholder="Problem" name="descp" required></textarea>
                </div>

                <input type="submit" style="background-color:#f05f40;margin-top:50px" name="submit" id="submit" value="Submit Request " class="btn btn-info pull-right">
            </div>
        </form>

    </div>


    </div>

</body>


    <!-- jQuery -->


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
