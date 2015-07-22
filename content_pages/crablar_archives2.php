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
    <title>Crabtown Crablar: 2015 July Edition</title>
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
    
	<?php if (login_check($mysqli) == true) : ?>
    
  <div id="content">
      <p>
          <h1>Crabtown Crablar Archives</h1>
          Extra! Extra! Read all about it!
          <br>
          <br>
    <div>
      <iframe src="/crabtown_archives/Crabtown_2015_July.pdf" height=900 width=750></iframe>
    </div>
    <a href="/crabtown_archives/Crabtown_2015_July.pdf" target="_blank">download</a> 
  </div>
 
    
  <div id="footer">
      <p>Something something all rights reserved crabtown copyright blah blah blah...  Not for human consumption.</p>
  </div>
    <?php else : ?>
            <p>
                <span class="error">Only citizens of Crabtown are permitted access to these top secret files.</span> Please <a href="login.phtml">login</a>.
            </p>
        <?php endif; ?>
	</body>
</html>
