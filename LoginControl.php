<?php 

if($_POST['username'] == 'Admin' && $_POST['password'] == '123456'){
header("Location: DatabaseEdit.php");       
}
else{

header("Location: Login.php");
}
?>