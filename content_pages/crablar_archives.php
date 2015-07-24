<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
  
if(!isset($_SESSION)) { 
  session_start();
 //sec_session_start();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Crabtown Crablar: 2014 Edition</title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/login.css"/> 
    <link rel="stylesheet" type="text/css" href="/css/Crabtown v1.0.css">    
    <link rel="stylesheet" href="/css/login_menu.css"/>  
    
    <script type="text/JavaScript" src="/js/sha512.js"></script> 
    <script type="text/JavaScript" src="/js/forms.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script> 
    <script type="text/JavaScript" src="/js/popup.js"></script>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
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
      <iframe src="/crabtown_archives/Crabtown_2014.pdf" height=900 width=750></iframe>
    </div>
    <a href="/crabtown_archives/Crabtown_2014.pdf" target="_blank">download</a> 
  </div>
 
    
  <div id="footer">
      <p>Something something all rights reserved crabtown copyright blah blah blah...  Not for human consumption.</p>
  </div>
  <?php else : ?>
      <?php include_once $_SERVER['DOCUMENT_ROOT'].'/restricted_message.php'; ?>    
  <?php endif; ?>
	</body>

  <!-- Menu that pops up -->

  <!-- Modal -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <?php include_once $_SERVER['DOCUMENT_ROOT'].'/login_menu.php'; ?>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  

  
</html>
