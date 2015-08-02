<!-- We log the user in as well -->
<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/includes/db_connect.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
  
  //process the login attempt
  include_once $_SERVER['DOCUMENT_ROOT'].'/includes/process_login.php';

  if(!isset($_SESSION)) { 
    session_start();
   //sec_session_start();
  }
  
  if (login_check($mysqli) == true){
    $logged_in = true;
    //load user permissions and data
    include_once $_SERVER['DOCUMENT_ROOT'].'/includes/user_profile.php';
  } else {
    $logged_in = false;
  }

?>


<!DOCTYPE html>
</html>
  <head>
    <title>Secure Login: Registration Success</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/login.css"/> 
    <link rel="stylesheet" type="text/css" href="/css/Crabtown v1.0.css">    
    <link rel="stylesheet" href="/css/login_menu.css"/>  
    <link rel="stylesheet" href="/css/register_success.css" />
    
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

      <h1>Welcome, citizen!</h1>
      <br>
      <img src="/images/registration_success.png" id="citzen_certificate">
      <?php echo "<div id=\"citizen_name\">".$_SESSION['username']."</div>";?>
      <p>Create your <a href="/user_profile">profile</a> and begin exploring Crabtown!</p>
          
        
    </body>
</html>
