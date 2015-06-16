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

            <div class="col-xs-8 center-block" style="float:none">
        <p style="font-size:60px;color:#f05f40">Pricing Overview</p>
      </div>
    	<div class="row" style="margin-top:40px">
        			<?php
              require 'deets.php';
              $conn = mysqli_connect($servername, $username, '');
              if (!$conn) {
                  echo 'Unable to connect to server';
              }
              mysqli_select_db($conn,$dbname);

              $sql = "SELECT * FROM driving_plan;";
              if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result)>0){
                	while($row = mysqli_fetch_assoc($result))
                	{
                    echo "<div class='col-xs-6 col-sm-6 col-md-4 col-lg-4'>";
                    echo '<div class="panel price panel-red">';
                    echo '<div class="panel-heading  text-center">';
                      if(is_null($row['plan_name']))
                  			echo '<h3>nill</h3>';
                  		else{
                        echo "<h3>";
                        echo strtoupper($row['plan_name']);
                        echo "</h3>";
                      }
                        echo '</div>';
                    echo '<div class="panel-body text-center">';
                      if(is_null($row['discount']))
                        echo '<p class="lead" style="font-size:40px"><strong>No discount</strong></p>';
                  		else
                        echo "<p class='lead' style='font-size:40px'><strong>{$row['discount']}% discount</strong></p>";

        						echo '</div>';
                    echo '  <ul class="list-group list-group-flush text-center">';
                      if(is_null($row['monthly_payment']))
                        echo '	<li class="list-group-item"><i class="icon-ok text-danger"></i> Annual N-A</li>';
                  		else
                        echo "	<li class='list-group-item'><i class='icon-ok text-danger'></i> Annual $ {$row["monthly_payment"]}</li>";
                        if(is_null($row['annual_fee']))
                          echo '	<li class="list-group-item"><i class="icon-ok text-danger"></i> Monthly N-A</li>';
                    		else
                          echo "	<li class='list-group-item'><i class='icon-ok text-danger'></i> Monthly $ {$row["annual_fee"]}</li>";


                      echo '	<li class="list-group-item"><i class="icon-ok text-danger"></i> 27/7 support</li>';
                      echo '</ul>';
                      echo '<div class="panel-footer">';
                        echo '	<a class="btn btn-lg btn-block btn-danger" href="#">BUY NOW!</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }else{
                  echo 'error';
                }
              }else{
                echo 'error';
              }
              mysqli_close($conn);


              ?>

    			</div>


    </div>




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
