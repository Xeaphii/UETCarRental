<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
      <?php
      session_start();

      if (isset($_SESSION['remember']) && (time() - $_SESSION['remember'] > 1800)) {
      // last request was more than 30 minutes ago
      session_unset();     // unset $_SESSION variable for the run-time
      session_destroy();   // destroy session data in storage
      }
      $_SESSION['remember'] = time();

      if(isset($_SESSION['type']))
        if($_SESSION['type'] == 1)
        {header('Location: adminhome.php');}
        elseif($_SESSION['type'] == 2){
          header('Location: emphome.php');}
        elseif($_SESSION['type'] == 3){
          header('Location: home.php');}


      ?>
      <link rel="icon" href="images/favicon.ico" type="image/x-icon" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Singup</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">

  </head>
  <body>
     <script src="js/TweenLite.min.js"></script>
<!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->

		<div class="container">
			<div class="row vertical-offset-100">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Welcome to Car Rental System</h3>
						</div>
						<div class="panel-body">
							<form accept-charset="UTF-8" role="form" method="post" action="signupredirecting.php">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Username" name="username" type="text">
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" name="password" type="password" value="">
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Confirm Password" name="c-password" type="password" value="">
								</div>
								<div class="dropdown">
                  <select name = "acc-type" class="form-control">
                      <option value="1">Admin</option>
                      <option value="2">Employee</option>
                      <option value="3">Student/Member</option>
                  </select>
                  <?php
                  if(isset($_GET['error']))
                  if($_GET['error'] == 1)
                    echo "<p style='color:red;margin-top:15px'>*Password don't match</p>";
                  else
                    echo "<p style='color:red;margin-top:15px'>*Username already exsit.</p>";
                  ?>
								<input style="margin-top:20px" class="btn btn-lg btn-success btn-block" type="submit" value="SignUp">
                <a href ="login.php" style="margin-top:20px">Already have account?</a>
							</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
		  $(document).mousemove(function(e){
			 TweenLite.to($('body'),
				.5,
				{ css:
					{
						backgroundPosition: ""+ parseInt(event.pageX/8) + "px "+parseInt(event.pageY/'12')+"px, "+parseInt(event.pageX/'15')+"px "+parseInt(event.pageY/'15')+"px, "+parseInt(event.pageX/'30')+"px "+parseInt(event.pageY/'30')+"px"
					}
				});
		  });
		});
	</script>
  </body>
</html>
