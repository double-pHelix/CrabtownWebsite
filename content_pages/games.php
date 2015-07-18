<?php
  if(!isset($_SESSION)) { 
    session_start();
   //sec_session_start();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Crabtown Games Gallery</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='http://fonts.googleapis.com/css?family=Londrina+Solid' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600' rel='stylesheet' type='text/css'>
      
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        
    <link rel="stylesheet" type="text/css" href="/css/Crabtown v1.0.css">

    
  </head>
  
	<body>
    <!-- Navigation Menu at the top of each page -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/menu_navigation.php'; ?>
  <div id="content">
   
      <p>
          <h1>Games! v1.0</h1>
          <br>
          <br>
    <embed src="/games/crab-ball.swf" quality="high" width=800 height=515>
    <br>
  </div>
 

  
  
  <div id="footer">
      <p>Something something all rights reserved crabtown copyright blah blah blah...  Not for human consumption.</p>
  </div>
  
	</body>
</html>
