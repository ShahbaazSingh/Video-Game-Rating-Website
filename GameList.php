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
$type = NULL;   

    
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
            

            
      <h1 id="gameListHeader" class="text-center">Games by Name</h1></br>
      <table>
        <tbody>
          <tr class="table-header">
            <th></th>
            <th>Title</th>
            <th>Score</th>
            <th>Year</th>
            <th>Developer</th>
            <th>Genre</th>
          </tr>
          
            
<?php
$perPage = 20;
if (isset($_GET['name'])){
    $type = 'name';
    if(isset($_GET['letter'])) {
            
            
            $sqlGames="SELECT gameID, Title, releaseDate, Developer FROM videoGame WHERE Title LIKE '".$_GET['letter']."%' ORDER BY Title";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }    
                    
                }
    else if(isset($_GET['page'])){
        $page = $_GET['page'];   
        $sqlGames="SELECT gameID, Title, releaseDate, Developer FROM videoGame ORDER BY Title ASC LIMIT ".$perPage." OFFSET ".($perPage)*($page-1)."";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }    
                    
         
    }

}
else if (isset($_GET['score'])){
   $type = 'score';
   if(isset($_GET['letter'])) {
      $sqlGames="SELECT V.gameID, V.Title, V.releaseDate, V.Developer FROM videoGame V, userreview R WHERE Title LIKE '".$_GET['letter']."%' AND V.gameID = R.gameID GROUP BY V.Title ORDER BY AVG(R.reviewRating) DESC";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }    
       
       
   }
    else if(isset($_GET['page'])){
       $page = $_GET['page']; 
       $sqlGames="SELECT V.gameID, V.Title, V.releaseDate, V.Developer FROM videoGame V, userreview R WHERE V.gameID = R.gameID GROUP BY V.Title ORDER BY AVG(R.reviewRating) DESC LIMIT ".$perPage." OFFSET ".($perPage)*($page-1)."";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }
    } 
    
    
} 
else if (isset($_GET['release'])){
    $type = 'release';
    if(isset($_GET['letter'])) {
        $sqlGames="SELECT gameID, Title, releaseDate, Developer FROM videoGame WHERE Title LIKE '".$_GET['letter']."%' ORDER BY releaseDate DESC";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            } 
        
        
    }
     else if(isset($_GET['page'])){
        $page = $_GET['page']; 
         $sqlGames="SELECT gameID, Title, releaseDate, Developer FROM videoGame ORDER BY releaseDate DESC LIMIT ".$perPage." OFFSET ".($perPage)*($page-1)."";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            } 
         
         
         
    }
    
    
} 
else if (isset($_GET['developer'])){
    $type = 'developer';
    if(isset($_GET['letter'])) {
        $sqlGames="SELECT gameID, Title, releaseDate, Developer FROM videoGame WHERE Developer LIKE '".$_GET['letter']."%' ORDER BY Developer DESC";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }
        
        
    }
     else if(isset($_GET['page'])){
       $page = $_GET['page']; 
       $sqlGames="SELECT gameID, Title, releaseDate, Developer FROM videoGame ORDER BY Developer ASC LIMIT ".$perPage." OFFSET ".($perPage)*($page-1)."";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }

         
         
         
    }
    
}
else if (isset($_GET['genre'])){
    $type = 'genre';
    if(isset($_GET['letter'])) {
        $sqlGames="SELECT V.gameID, V.Title, V.releaseDate, V.Developer FROM videoGame V, gamegenre G WHERE G.Genre LIKE '".$_GET['letter']."%' AND V.gameID=G.gameID ORDER BY G.Genre DESC";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }
    
    }
     else if(isset($_GET['page'])){
        $page = $_GET['page'];
        $sqlGames="SELECT V.gameID, V.Title, V.releaseDate, V.Developer FROM videoGame V, gamegenre G WHERE V.gameID=G.gameID ORDER BY G.Genre ASC LIMIT ".$perPage." OFFSET ".($perPage)*($page-1)."";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }
         
         
         
         
    }
    
    
} 
else if (isset($_GET['search'])){
    
    $perPage=20;
    $page = 1;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    $search = $_GET['search'];
                if(isset($_GET['type'])){
                 if($_GET['type'] == 'namelook'){
                  $looktype = 'namelook';  
                 $sqlGames="SELECT gameID, Title, releaseDate, Developer FROM videoGame WHERE Title LIKE '%".$search."%' ORDER BY Title DESC LIMIT ".$perPage." OFFSET ".($perPage)*($page-1)."";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }   
                    
                    
                    
                    
                    
                    
                 }
                
                
                  if($_GET['type'] == 'developerlook'){
                  $looktype = 'developerlook';  
                 $sqlGames="SELECT gameID, Title, releaseDate, Developer FROM videoGame WHERE Developer LIKE '%".$search."%' ORDER BY Developer DESC LIMIT ".$perPage." OFFSET ".($perPage)*($page-1)."";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }   
                    
                    
                    
                    
                    
                    
                 }
                    
                    
                    
                    
                    
                    
                    
                    
                    
                
                else if($_GET['type'] == 'genrelook'){
                 $looktype = "genrelook";
                 $sqlGames="SELECT V.gameID, V.Title, V.releaseDate, V.Developer FROM videoGame V, gamegenre G WHERE V.gameID = G.gameID AND G.Genre LIKE '%".$search."%' ORDER BY G.Genre DESC LIMIT ".$perPage." OFFSET ".($perPage)*($page-1)."";
                 $resultGames=mysqli_query($connection,$sqlGames);
                    if($resultGames = mysqli_query($connection, $sqlGames)){
                        while($row = mysqli_fetch_assoc($resultGames)){
                        $gameID = $row['gameID'];
                        $Title = $row['Title'];
                        $date = strtotime($row['releaseDate']);
                        $daterevised = date('j-F-Y', $date);
                        $Developer = $row['Developer'];
                        echo "<tr class='table-list'>
                            <td class='cover'>
                            <a href='Game.php?gameID=".$row['gameID']."'><img src='images/Images-Thumb/".$row['gameID'].".jpg'></a>
                            </td>
                            <td class='title'>
                            <a href='Game.php?gameID=".$row['gameID']."'>".$row['Title']."</a>
                            </td>";
                            echo "<td class='score'>";
                            $sqlOvRev="SELECT TRUNCATE(AVG(reviewRating),2) FROM userReview WHERE gameID = ".$row['gameID']."";
                            $resultOvRev=mysqli_query($connection,$sqlOvRev);
                            if($resultOvRev = mysqli_query($connection, $sqlOvRev)){
                            while($row = mysqli_fetch_assoc($resultOvRev)){ 
                            $rev = $row['TRUNCATE(AVG(reviewRating),2)'];
                                echo $rev;
                                }
                            }
                            echo "</td>
                            <td class='year'>".$daterevised."</td>
                            <td class='developer'>".$Developer."</td>
                            <td class='genre'>";
                              $sql="SELECT Genre FROM gameGenre WHERE gameID = ".$gameID."";
                              $result=mysqli_query($connection,$sql);
                              if($result = mysqli_query($connection, $sql)){
                              while($row = mysqli_fetch_assoc($result)){
                              echo $row['Genre'];
                              echo " ";
                                    }
                                }
                            echo "</td>";
                        echo "</tr>";
                                    }
                            }   
                    
                    
                    
                    
                    
                    
                    
                    
                }
    
}    
}
            
            
                  
            
?>
         
        </tbody>
      </table>
          </br>
          </br>
<?php
    $sqlPageNumber="select ROUND(COUNT(gameID),-1) FROM videogame";
    $resultPageNumber=mysqli_query($connection,$sqlPageNumber);
    if($resultPageNumber = mysqli_query($connection, $sqlPageNumber)){
        while($row = mysqli_fetch_assoc($resultPageNumber)){
            $Count = $row['ROUND(COUNT(gameID),-1)'] + 10;
                        }
                }
        $pagesNeeded = $Count/10;
      
      
      
      
          if($type != NULL){
          echo "<ul id='testingagain'>";
              for($i=1;$i<$pagesNeeded+1;$i++){
              echo "<li><a href='GameList.php?page=".$i."&".$type."=1'>".$i."</a></li>";
              }
          echo "</ul>";
          echo"</br>
          </br>
          </br>";
          echo "<ul id='testing'>";
              echo "<li><a href='GameList.php?letter=a&".$type."=1'>A</a></li> 
              <li><a href='GameList.php?letter=b&".$type."=1'>B</a></li> 
              <li><a href='GameList.php?letter=c&".$type."=1'>C</a></li> 
              <li><a href='GameList.php?letter=d&".$type."=1'>D</a></li> 
              <li><a href='GameList.php?letter=e&".$type."=1'>E</a></li> 
              <li><a href='GameList.php?letter=f&".$type."=1'>F</a></li> 
              <li><a href='GameList.php?letter=g&".$type."=1'>G</a></li> 
              <li><a href='GameList.php?letter=h&".$type."=1'>H</a></li> 
              <li><a href='GameList.php?letter=i&".$type."=1'>I</a></li> 
              <li><a href='GameList.php?letter=j&".$type."=1'>J</a></li> 
              <li><a href='GameList.php?letter=k&".$type."=1'>K</a></li> 
              <li><a href='GameList.php?letter=l&".$type."=1'>L</a></li> 
              <li><a href='GameList.php?letter=m&".$type."=1'>M</a></li> 
              <li><a href='GameList.php?letter=n&".$type."=1'>N</a></li> 
              <li><a href='GameList.php?letter=o&".$type."=1'>O</a></li> 
              <li><a href='GameList.php?letter=p&".$type."=1'>P</a></li> 
              <li><a href='GameList.php?letter=q&".$type."=1'>Q</a></li> 
              <li><a href='GameList.php?letter=r&".$type."=1'>R</a></li> 
              <li><a href='GameList.php?letter=s&".$type."=1'>S</a></li> 
              <li><a href='GameList.php?letter=t&".$type."=1'>T</a></li> 
              <li><a href='GameList.php?letter=u&".$type."=1'>U</a></li> 
              <li><a href='GameList.php?letter=v&".$type."=1'>V</a></li>
              <li><a href='GameList.php?letter=w&".$type."=1'>W</a></li> 
              <li><a href='GameList.php?letter=x&".$type."=1'>X</a></li> 
              <li><a href='GameList.php?letter=y&".$type."=1'>Y</a></li> 
              <li><a href='GameList.php?letter=z&".$type."=1'>Z</a></li>";
            
             
          echo "</ul>";
        }
       else if(isset($_GET['search'])){
           echo "<ul id='testingagain'>";
            for($i=1;$i<$pagesNeeded+1;$i++){
              echo "<li><a href='GameList.php?type=".$looktype."&page=".$i."&search=".$search."'>".$i."</a></li>";
            }
              echo "</ul>";

           
           
           
       }
      
      
      
      
      
      
      
      
      
      
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