<!DOCTYPE html>
<html lang="en">
<?php
  include "database-include.php";

$connection = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

$error = mysqli_connect_error();
if($error != null){
     $output = "<p>Unable to connect to database<p>".$error;
     exit($output);    
}  
    

    
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Gamepedia - Search Games</title>

    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <!-- Google fonts used in this theme  -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">   

    <!-- Bootstrap core CSS -->
    <link href="bootstrap3_defaultTheme/dist/css/superhero.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="Gamepedia.css">
 
  </head>

  <body>
    <?php include 'Header.php'; ?>
   
    <div class="container"> 
      <div class="col-md-12">
        <div class="row">
            

            
      <h1 id="gameListHeader" class="text-center">Login To Edit Database</h1></br>
          
       

      <form class="form-signin" action="LoginControl.php" method="POST">
        <h2 class="form-signin-heading">Please Login</h2>
        <div class="input-group">

	  <input type="text" name="username" class="form-control" placeholder="Username" required>
	
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
          
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="loginsubmit">Login</button>
            </div>
      </form>
        </div>   <!-- end row -->
      </div>   <!-- end col-md-12 -->
    </div>   <!-- end main content container -->
   
    <?php include 'Footer.php'; ?>   

    <!-- Bootstrap core JavaScript ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
    <script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap3_defaultTheme/assets/js/holder.js"></script>
  
  </body>

</html>