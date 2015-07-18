<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
if(!isset($_SESSION)) { 
  session_start();
 //sec_session_start();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Logging out</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='http://fonts.googleapis.com/css?family=Londrina+Solid' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600' rel='stylesheet' type='text/css'>

  </head>
  
<body>
  
  <h1>Logging out... </h1>
  
  <?php
    if (login_check($mysqli)) {
      include_once '/includes/logout.php';
    } else {
      echo "<h2> Um... sure you're not already logged out? </h2>";
    }
  ?>
   
  
</body></html>
