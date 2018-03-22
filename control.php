<?php 

include "database-include.php";

$connection = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

$error = mysqli_connect_error();
if($error != null){
     $output = "<p>Unable to connect to database<p>".$error;
     exit($output);    
}

       


$Currdate = date('Y-m-d H:i:s');
$comment = $_POST['comment'];
$goodval = str_replace("'", "''", $comment);
if($_SERVER['REQUEST_METHOD']=='POST'){
if(isset($_POST['submit'])){
    $sqlReview = "INSERT INTO userreview (gameID,comment,reviewrating,reviewDate) VALUES (".$_POST['gameID'].",'".$goodval."',".$_POST['rating'].",'".$Currdate."')";  
     mysqli_begin_transaction($connection, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
     $resultReview= mysqli_query($connection, $sqlReview) or die(mysqli_error($connection));     
     mysqli_commit($connection);
     $gameID = $_POST['gameID'];
} 
}

header("Location: Game.php?gameID=$gameID");  
?>