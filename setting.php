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
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
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
  if(isset($_GET["error"])){
    if($_GET["error"]==1)
    {echo '<script>';
    echo 'function myFunction() {';
    echo '  $.notify("Error Occured! Data not Saved", "error");';
    echo '}';
    echo '</script>';}
    elseif($_GET["error"]==2)  {
      echo '<script>';
      echo 'function myFunction() {';
      echo '  $.notify("Error Occured! Please insert personal info first", "error");';
      echo '}';
      echo '</script>';}
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
                          <a  href="#">Plans</a>
                      </li>
                      <li>
                          <a  href="rent.php">Rent a Car</a>
                      </li>
                      <li>
                          <a  href="rentinfo.php">Rental Information</a>
                      </li>
                      <li>
                          <a  href="#">Information</a>
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

            <div class="col-xs-7 center-block" style="float:none">
        <p style="font-size:60px;color:#f05f40">Personal Information</p>
      </div>
    </div>
      <hr/>
      <div class="row" style="margin-top:50px" >

            <div class="col-xs-4 center-block" style="float:none">
        <p style="font-size:25px;color:#f05f40">General Information</p>
      </div>
    </div>
    <form role="form" accept-charset="UTF-8" method="post" action="personalinforedirecting.php">
      <div class="row" >

            <div class="col-xs-8 center-block" style="float:none">

              <div class="form-group">
                <label for="usr">First Name:</label>
                <input type="text" class="form-control" name="f-name" id="usr">
              </div>
              <div class="form-group">
                <label for="usr">Middle Name:</label>
                <input type="text" class="form-control" name="m-name" id="usr">
              </div>
              <div class="form-group">
                <label for="usr">Last Name:</label>
                <input type="text" class="form-control" name="l-name" id="usr">
              </div>
              <div class="form-group">
                <label for="usr">Email:</label>
                <input type="text" class="form-control" name="email" id="usr">
              </div>
              <div class="form-group">
                <label for="usr">Phone Number:</label>
                <input type="text" class="form-control" name="phone" id="usr">
              </div>
              <div class="form-group">
                <label for="usr">Address:</label>
                <input type="text" class="form-control"  name="address" id="usr">
              </div>




    </div>
    </div>

    <hr/>
    <div class="row" style="margin-top:50px" >

          <div class="col-xs-4 center-block" style="float:none">
      <p style="font-size:25px;color:#f05f40">Membership Information</p>
    </div>
    </div>
    <div class="row" >
      <div class="col-xs-8 center-block" style="float:none">
      <p style="font-size:20px;color:#f05f40">Choose a driving plan</p>
      <div class="dropdown">
        <select name = "acc-type" class="form-control">
            <option value="frequent">Frequent</option>
            <option value="monthly">Monthly</option>
            <option value="occasional">Occasional</option>
        </select>
      </div>

        </div>
    </div>
    </div>



    <hr/>
    <div class="row" style="margin-top:50px" >

          <div class="col-xs-4 center-block" style="float:none">
      <p style="font-size:25px;color:#f05f40">Payment Information</p>
    </div>
    </div>
    <div class="row" >
      <div class="col-xs-8 center-block" style="float:none">

        <div class="form-group">
          <label for="usr">Name on the credit card:</label>
          <input type="text" class="form-control" name="credit-name" id="usr">
        </div>
        <div class="form-group">
          <label for="usr">Card Number:</label>
          <input type="text" class="form-control" name="card-number" id="usr">
        </div>
        <div class="form-group">
          <label for="usr">CVV:</label>
          <input type="text" class="form-control" name="cvv" id="usr">
        </div>
        <div class="form-group">
          <label for="usr">Expiry Date:</label>
          <input type="date" class="form-control" name="expiry-date" id="usr">
        </div>
        <div class="form-group">
          <label for="usr">Billing Address:</label>
          <input type="text" class="form-control" name="billing-address" id="usr">
        </div>

          <input type="submit" style="background-color:#f05f40;margin-top:50px;margin-bottom:20px" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
        </div>
    </div>
  </form>


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
