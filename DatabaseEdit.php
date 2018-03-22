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
            

            
      <h1 id="gameListHeader" class="text-center">Edit Database</h1></br>
          
       
<?php
          
     echo '<ol>
    <li>Add a game</li>
    <li>Delete a game</li>
    <li>Add Genre</li>
    <li>Add Platform</li>
    <li>Exit</li>
</ol>';


echo "<form action = 'DatabaseEdit.php' method='POST'>";
if(!isset($_POST['choice'])){
echo "<input type = 'text' value ='' name ='choice'/>";
}
else {
echo "<input type = 'text' value ='".$_POST['choice']."' name ='choice'/>";
}
          
          
          
if (isset($_POST['choice'])){
        $choice = $_POST['choice'];     
          echo "<br/>";    
    if($_POST['choice'] == 1) {
      echo "<input type = 'text' placeholder ='Title' name ='Title'/>";
     if (isset($_POST['Title'])){
       if (empty($_POST['Title'])){
       unset($_POST['Title']);
       echo " please don't leave the field blank";
       }
   }
    echo "<br/>";
   echo "<input type = 'date' placeholder ='releaseDate' name ='releaseDate'/>";
    if (isset($_POST['releaseDate'])){
       if (empty($_POST['releaseDate'])){
       unset($_POST['releaseDate']);

       }
   }
    echo "<br/>";
   echo "<input type = 'text' placeholder ='Developer' name ='Developer'/>";
    if (isset($_POST['Developer'])){
       if (empty($_POST['Developer'])){
       unset($_POST['Developer']);
       echo " please don't leave the field blank";
       }
   }
    echo "<br/>";
   echo "<input type = 'text' placeholder ='Publisher' name ='Publisher'/>";
     if (isset($_POST['Publisher'])){
       if (empty($_POST['Publisher'])){
       unset($_POST['Publisher']);
       echo " please don't leave the field blank";
       }
   }
    echo "<br/>";
   echo "<input type = 'text' placeholder ='Description' name ='Description'/>";
   if (isset($_POST['Description'])){
       if (empty($_POST['Description'])){
       unset($_POST['Description']);
       echo " please don't leave the field blank";
       }
   }
    
   echo "<br/>";
   echo "<input type='submit' value='Submit' name='AddSubmit'>"; 
   if(isset($_POST['Title']) && isset($_POST['releaseDate']) && isset($_POST['Developer']) && isset($_POST['Publisher'])  && isset($_POST['Description'])){
   $sqlAddGame = "INSERT INTO videogame (Title, releaseDate, Developer, Publisher, Description) VALUES ('".$_POST['Title']."','".$_POST['releaseDate']."','".$_POST['Developer']."','".$_POST['Publisher']."','".$_POST['Description']."')";
   mysqli_begin_transaction($connection, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
   $resultAddGame = mysqli_query($connection, $sqlAddGame) or die(mysqli_error($connection));
   mysqli_commit($connection);
   }
 
  
        
               
    }
    
    
    
if($_POST['choice'] == 2) {
      echo "<input type = 'text' placeholder ='Game ID' name ='gameID'/>";
     if (isset($_POST['gameID'])){
       if (empty($_POST['gameID'])){
       unset($_POST['gameID']);
       echo " please don't leave the field blank";
       }
   }
    echo "<br/>";
    
   echo "<br/>";
   echo "<input type='submit' value='Submit' name='DeleteSubmit'>"; 
   if(isset($_POST['gameID'])){
   
   $sqlDeleteGenre = "DELETE FROM gameGenre WHERE gameID = ".$_POST['gameID']."";   
   mysqli_begin_transaction($connection, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
   $resultDeleteGenre = mysqli_query($connection, $sqlDeleteGenre) or die(mysqli_error($connection));
   mysqli_commit($connection);   
       
       
       
   $sqlDeleteReview = "DELETE FROM userreview WHERE gameID = ".$_POST['gameID']."";   
   mysqli_begin_transaction($connection, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
   $resultDeleteReview = mysqli_query($connection, $sqlDeleteReview) or die(mysqli_error($connection));
   mysqli_commit($connection);
       
   $sqlDeletePlatform = "DELETE FROM gamePlatform WHERE gameID = ".$_POST['gameID']."";   
   mysqli_begin_transaction($connection, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
   $resultDeletePlatform = mysqli_query($connection, $sqlDeletePlatform) or die(mysqli_error($connection));
   mysqli_commit($connection);   
       
   $sqlDeletePlatform = "DELETE FROM videoGame WHERE gameID = ".$_POST['gameID']."";   
   mysqli_begin_transaction($connection, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
   $resultDeletePlatform = mysqli_query($connection, $sqlDeletePlatform) or die(mysqli_error($connection));
   mysqli_commit($connection);   
       
       
       
   }
 
  
        
               
}    

    
if($_POST['choice'] == 3) {
    echo "<input type = 'text' placeholder ='Game ID' name ='gameID1'/>";
     if (isset($_POST['gameID1'])){
       if (empty($_POST['gameID1'])){
       unset($_POST['gameID1']);
       echo " please don't leave the field blank";
       }
   }
    echo "<br/>";
   echo "<input type = 'text' placeholder ='Genre' name ='Genre'/>";
     if (isset($_POST['Genre'])){
       if (empty($_POST['Genre'])){
       unset($_POST['Genre']);
       echo " please don't leave the field blank";
       }
   } 
    
    
    
    
   echo "<br/>";
   echo "<input type='submit' value='Submit' name='AddGenreSubmit'>"; 
   if(isset($_POST['gameID1']) && isset($_POST['Genre'])){
       
       
   $sqlAddGenre = "INSERT INTO gameGenre (gameID, Genre) VALUES ('".$_POST['gameID1']."','".$_POST['Genre']."')";   
   mysqli_begin_transaction($connection, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
   $resultAddGenre = mysqli_query($connection, $sqlAddGenre) or die(mysqli_error($connection));
   mysqli_commit($connection);
       
   }
 
  
        
               
}  
    
    
if($_POST['choice'] == 4) {
    echo "<input type = 'text' placeholder ='Game ID' name ='gameID2'/>";
     if (isset($_POST['gameID2'])){
       if (empty($_POST['gameID2'])){
       unset($_POST['gameID2']);
       echo " please don't leave the field blank";
       }
   }
    echo "<br/>";
   echo "<input type = 'text' placeholder ='Platform' name ='Platform'/>";
     if (isset($_POST['Platform'])){
       if (empty($_POST['Platform'])){
       unset($_POST['Platform']);
       echo " please don't leave the field blank";
       }
   } 
    
    
    
    
   echo "<br/>";
   echo "<input type='submit' value='Submit' name='AddPlatformSubmit'>"; 
   if(isset($_POST['gameID2']) && isset($_POST['Platform'])){
       
       
   $sqlAddPlatform = "INSERT INTO gamePlatform (gameID, Platform) VALUES ('".$_POST['gameID2']."','".$_POST['Platform']."')";   
   mysqli_begin_transaction($connection, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
   $resultAddPlatform = mysqli_query($connection, $sqlAddPlatform) or die(mysqli_error($connection));
   mysqli_commit($connection);
       
   }
 
  
        
               
}
    
    
if($_POST['choice'] == 5) {
header("Location: Gamepedia.php");
}
    
    
    
    
    
    
    
    
    
    
    
    
    
}
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
 echo "</div>   <!-- end row -->
      </div>   <!-- end col-md-12 -->
    </div>   <!-- end main content container -->
   
    <?php include 'Footer.php'; ?>";          
          
          
          
echo "</form>";         
?>        
          
          
          

     
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