<!DOCTYPE html>
<html lang="en">

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
    
    
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

<?php
            if (isset($_GET['gameID']) ) {  
            
               $gameID = $_GET['gameID'];
                 $sqlGame="SELECT Title FROM videoGame WHERE gameID = ".$gameID."";
                      $resultGame=mysqli_query($connection,$sqlGame);
                        if($resultGame = mysqli_query($connection, $sqlGame)){
                            while($row = mysqli_fetch_assoc($resultGame)){
                                
                                echo "<title>Gamepedia - ".$row['Title']."</title>";
                            }
                        }
               
            }
         
?>

  

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

<?php
          $sqlGame="SELECT * FROM videoGame WHERE gameID = ".$gameID."";
              $resultGame=mysqli_query($connection,$sqlGame);
                  if($resultGame = mysqli_query($connection, $sqlGame)){
                      while($row = mysqli_fetch_assoc($resultGame)){
                          echo "<h2 id='gameNameHeader'>".$row['Title']."</h2>";
                          echo "</br>
                          <div class='row'>
                          <div class='col-md-5'>
                          <div class='row''>  
                          <img src='images/Images-Act/".$row['gameID'].".jpg' class='' alt='' title='".$row['Title']."'/>
                          </div>
                          </br>";
                            }
                        }       
          
          
          
?>

            <div class = "row">
   
                <h4 id="gamepediaScoreHeader">Gamepedia Score</h4>
<?php
                
        $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$gameID."";
              $resultOvRev=mysqli_query($connection,$sqlOvRev);
                if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                    while($row = mysqli_fetch_assoc($resultOvRev)){ 
                $rev = $row['TRUNCATE(AVG(reviewRating),2)'];    
                echo "<h2 id='scoreFraction' class='bold padding-bottom-7'>".$rev."<small>/ 5</small></h2>";
                for($i=0;$i<$rev;$i++){
                echo "<button type='button' class='btn btn-warning btn-sm' aria-label='Left Align'>
                  <span class='glyphicon glyphicon-star' aria-hidden='true'></span>
                </button>";
                }
                for($i=0;$i<(5-$rev);$i++){
                echo "<button type='button' class='btn btn-default btn-grey btn-sm' aria-label='Left Align'>
                  <span class='glyphicon glyphicon-star' aria-hidden='true'></span>
                </button>";
                }
                    }
                }
?>
            </div>  <!-- end row -->

          </div>  <!-- end col-md-5 -->

       
          <div class="col-md-7">
            <h3 id="descriptionHeader">Description:</h3>
            </br></br>
        <?php
          $sqlGame="SELECT * FROM videoGame WHERE gameID = ".$gameID."";
              $resultGame=mysqli_query($connection,$sqlGame);
                if($resultGame = mysqli_query($connection, $sqlGame)){
                    while($row = mysqli_fetch_assoc($resultGame)){
                        echo "<p id='description'>";
                        echo $row['Description'];
                        echo "</p>";
        
    $date = strtotime($row['releaseDate']);
    $daterevised = date('j F Y', $date);
            echo "</br>
            </br>

            <div class='panel panel-default'>
              <table class='table'>
                <tr class='tableHeader'>
                  <th>About This Game</th>
                </tr>
                <tr>
                  <th>Release Date:</th>
                  <td>".$daterevised."</td>
                </tr>  
                <tr>
                  <th>Publisher:</th>
                  <td>".$row['Publisher']."</td>
                </tr>
                <tr>
                  <th>Developer:</th>
                  <td>".$row['Developer']."</td>
                </tr>";
                    }
                }
?>
        <tr>
            <th>Platform(s):</th>
            <td>
<?php
         $sqlPub="SELECT Platform FROM gameplatform WHERE gameID = ".$gameID."";
              $resultPub=mysqli_query($connection,$sqlPub);
                if($resultPub = mysqli_query($connection, $sqlPub)){
                    while($row = mysqli_fetch_assoc($resultPub)){
               
                  echo $row['Platform'];
                  echo " ";
                    }
                }
?>
            </td>
        </tr>
            <th>Genre(s):</th>
            <td>
<?php
         $sqlPub="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
              $resultPub=mysqli_query($connection,$sqlPub);
                if($resultPub = mysqli_query($connection, $sqlPub)){
                    while($row = mysqli_fetch_assoc($resultPub)){
               
                  echo $row['Genre'];
                  echo " ";                    
                    }
                }
?>
    </td>
        </tr>  
              </table>
            </div>  <!-- end panel -->                              
             
          </div>  <!-- end col-md-7 -->

        </div>  <!-- end row -->
        </br>
        <h4 id="commentsHeader">Comments</h4>
        </br>
        </br>
         <div class='row'>
                    <div class='col-sm-10'>
                        <div class='review-block'>
                            
<?php    $sqlRev="SELECT * FROM userReview WHERE gameID = ".$gameID."";
              $resultRev=mysqli_query($connection,$sqlRev);
                if($resultRev = mysqli_query($connection, $sqlRev)){
                    while($row = mysqli_fetch_assoc($resultRev)){
                echo "<div class='row'>";
                echo "<div class='col-sm-4'>";
                
                echo "<div class='review-block-rate'>";
                  for($i=0;$i<$row['reviewRating'];$i++){
                  echo "<button type='button' class='btn btn-warning btn-sm' aria-label='Left Align'>
                    <span class='glyphicon glyphicon-star' aria-hidden='true'></span>
                  </button>";
                  }
                  for($i=0;$i<(5-$row['reviewRating']);$i++){         
                  echo "<button type='button' class='btn btn-default btn-grey btn-sm' aria-label='Left Align'>
                    <span class='glyphicon glyphicon-star' aria-hidden='true'></span>
                  </button>";
                  }
                  echo "</div>";
                $reviewdate = strtotime($row['reviewDate']);
                $reviewdaterevised = date('j-F-Y h:i', $reviewdate); 
                echo "<div class='review-block-date'><i>".$reviewdaterevised."</i></div>";
                echo "</div>  <!-- end col-sm-4 -->";
                
                echo "<div class='col-sm-6'>
                  <div class='review-block-description'>
                      <p><i>".$row['comment']."
                      </i></p>
                    </div> <!-- end review-block-description -->
                    </div>
                    </div></br>";
                    
                }
            }
?>
                  <div class="container">
                    <div class="row" style="margin-top:40px;">
                      <div class="col-md-6">
                        <div class="well well-sm">
                          <div class="text-right">
                            <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
                          </div>
                          <div class="row" id="post-review-box" style="display:none;">
                            <div class="col-md-10">
                                
                              <form accept-charset="UTF-8" action="control.php?gameID=<?php echo $gameID ?>" method="post">
                                <input id="ratings-hidden" name="rating" type="hidden"> 
                                <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea> 
                                <div class="text-right">
                                  <div class="stars starrr" data-rating="0" name="rating"></div>
                             <?php     echo "<input type = 'hidden' name = 'gameID' value = '".$gameID."' />"; ?>
                                  <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 9px;">
                                  <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                  <button class="btn btn-success btn-lg" type="submit" name="submit">Post</button>
                                </div>
                              </form>
                                
                            </div>  <!-- end row -->
                          </div>  <!-- end text-right -->
                        </div>   <!-- end well well-sm -->
                      </div>  <!-- end col-md-6 -->
                    </div>  <!-- end row -->
                  </div>  <!-- end container -->
                <!-- end col-sm-6 -->
                <!-- end row -->
              <hr/>  
            </div>  <!-- end col-sm-10 -->
          </div>  <!-- end review-block -->
        </div>  <!-- end row -->
        </br>

      </div>  <!-- end col-md-12 -->
      
</div>  <!-- end container -->
   
<?php include 'Footer.php'; ?>   

<!-- Bootstrap core JavaScript ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
<script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script>
<script src="bootstrap3_defaultTheme/assets/js/holder.js"></script>
<script type="text/javascript" src="ReviewBox.js"></script>

</body>
</html>