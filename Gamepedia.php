<?php
/*Shahbaaz Singh*/
include "database-include.php";

$connection = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

$error = mysqli_connect_error();
if($error != null){
     $output = "<p>Unable to connect to database<p>".$error;
     exit($output);    
}
?>


<!DOCTYPE html>
  <html lang="en">
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Gamepedia</title>

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
   
    <div class="container">  <!-- start main content container --> 

        <h1 id="newArrivals" class="text-center">New and Upcoming Games</h1>
        
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div id="Carousel" class="carousel slide">
                 
                <ol class="carousel-indicators">
                    <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#Carousel" data-slide-to="1"></li>
                    <li data-target="#Carousel" data-slide-to="2"></li>
                </ol>
                 
                <!-- Carousel items -->
                <div class="carousel-inner">
                    
                  <div class="item active">
                    <div class="row">
                    <?php
                      $sqlTopGames="SELECT gameID FROM videoGame ORDER BY releaseDate DESC LIMIT 4";
                      $resultTopGames=mysqli_query($connection,$sqlTopGames);
                        if($resultTopGames = mysqli_query($connection, $sqlTopGames)){
                            while($row = mysqli_fetch_assoc($resultTopGames)){
                                  echo "<div class='col-md-3'><a href='Game.php?gameID=".$row['gameID']."' class='thumbnail'><img src='images/Images-Act/".$row['gameID'].".jpg' alt='Image' style='max-width:100%;'></a></div>";
                                    }
                            }    
                    
                      
                          ?>
                    </div><!--.row-->
                  </div><!--.item-->
                   
                  <div class="item">
                    <div class="row">
                      <?php
                      $sqlTopGames="SELECT gameID FROM videoGame ORDER BY releaseDate DESC LIMIT 4 OFFSET 4";
                      $resultTopGames=mysqli_query($connection,$sqlTopGames);
                        if($resultTopGames = mysqli_query($connection, $sqlTopGames)){
                            while($row = mysqli_fetch_assoc($resultTopGames)){
                                  echo "<div class='col-md-3'><a href='Game.php?gameID=".$row['gameID']."' class='thumbnail'><img src='images/Images-Act/".$row['gameID'].".jpg' alt='Image' style='max-width:100%;'></a></div>";
                                    }
                            }    
                    
                      
                          ?>
                    </div><!--.row-->
                  </div><!--.item-->
                   
                  <div class="item">
                    <div class="row">
                         <?php
                      $sqlTopGames="SELECT gameID FROM videoGame ORDER BY releaseDate DESC LIMIT 4 OFFSET 8";
                      $resultTopGames=mysqli_query($connection,$sqlTopGames);
                        if($resultTopGames = mysqli_query($connection, $sqlTopGames)){
                            while($row = mysqli_fetch_assoc($resultTopGames)){
                                  echo "<div class='col-md-3'><a href='Game.php?gameID=".$row['gameID']."' class='thumbnail'><img src='images/Images-Act/".$row['gameID'].".jpg' alt='Image' style='max-width:100%;'></a></div>";
                                    }
                            }    
                    
                      
                          ?>
                    </div><!--.row-->
                  </div><!--.item-->
                 
                </div><!--.carousel-inner-->
                <a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
                <a data-slide="next" href="#Carousel" class="right carousel-control">›</a>
              </div><!--.Carousel-->     
            </div>
          </div>
        </div><!--.container-->
        <h1 id="topGame" class="text-center">Top Games</h1></br>
       
        <!-- start post summaries -->
        <div class="container">
            
      </div>
      <div class='row'>
<?php
  $sqlOvRev="SELECT gameID FROM userreview GROUP BY gameID ORDER BY AVG(reviewRating) DESC LIMIT 4";
              $resultOvRev=mysqli_query($connection,$sqlOvRev);
                if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                    while($row = mysqli_fetch_assoc($resultOvRev)){ 
                           
                            echo "<div class='col-sm-3'>
                                <a href='Game.php?gameID=".$row['gameID']."' class='thumbnail'><img class='img-responsive' src='images/Images-Act/".$row['gameID'].".jpg' alt=''></a>
                            </div>"; 
                       
                    }
                }
      
?>
      </div>
      </br></br>
      <div class='row'>
<?php
    $sqlOvRev="SELECT gameID FROM userreview GROUP BY gameID ORDER BY AVG(reviewRating) DESC LIMIT 4 OFFSET 4";
              $resultOvRev=mysqli_query($connection,$sqlOvRev);
                if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                    while($row = mysqli_fetch_assoc($resultOvRev)){
                    echo "<div class='col-sm-3'>
                            <a href='Game.php?gameID=".$row['gameID']."' class='thumbnail'><img class='img-responsive' src='images/Images-Act/".$row['gameID'].".jpg' alt=''></a>
                        </div>";  
                    }
                }

?>
    </div>
          

        </div>

    </div>   <!-- end main content container -->
   
    <?php include 'Footer.php'; ?>   

    <!-- Bootstrap core JavaScript ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
    <script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap3_defaultTheme/assets/js/holder.js"></script>
  
  </body>

</html>