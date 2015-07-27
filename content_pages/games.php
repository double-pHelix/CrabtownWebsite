<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
if (isset($_POST['username'], $_POST['p']) && $_POST['form_type'] == "login") {
  include_once $_SERVER['DOCUMENT_ROOT'].'/includes/process_login.php';
}
 
if(!isset($_SESSION)) { 
  session_start();
 //sec_session_start();
}

if (login_check($mysqli) == true){
  $logged_in = true;
  include_once $_SERVER['DOCUMENT_ROOT'].'/includes/permissions.php';
} else {
  $logged_in = false;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Games!</title>
        <link rel="stylesheet" href="styles/games.css" />
        
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
         
        <?php
          if(isset($_POST['form_type']) || $logged_in == false){
            echo "<script type=\"text/javascript\">
              $(window).load(function() {
                $('#myModal').modal('show');
              });
            </script>";  
          }
        ?>
        
    </head>
    <body>
    
    <!-- Navigation Menu at the top of each page -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/menu_navigation.php'; ?>
    
        <?php if (login_check($mysqli) == true) : ?>
            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
            <div class="gamebox">
                <table>
					<tr>
						<td>
							Play these fun games!
						</td>
					</tr>
					<tr>
						<td><a href="/crabtown_games/crab-ball.php">Crab-ball</a></td>
						<td><a href ="/crabtown_games/crabball_z/crabball_z.html">Crabball Z</a></td>
					</tr>
				</table>
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
