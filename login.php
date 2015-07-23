<?php 
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
if(!isset($_SESSION) && session_status() == PHP_SESSION_NONE) { 
  session_start(); 
  // sec_session_start();
}

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Crabtown Login</title>
    
    <script type="text/JavaScript" src="/js/sha512.js"></script> 
    <script type="text/JavaScript" src="/js/forms.js"></script>
        
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='http://fonts.googleapis.com/css?family=Londrina+Solid' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600' rel='stylesheet' type='text/css'>
      
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/Crabtown v1.0.css">
    <link rel="stylesheet" href="/css/login.css"/>
 
  </head>
  
<body>
  <!-- Navigation Menu at the top of each page -->
  <?php include_once $_SERVER['DOCUMENT_ROOT'].'/menu_navigation.php'; ?>
	
	<?php
    if (login_check($mysqli) == true) {
     
      goto logged_in_message; 
    } 
	?>  
  
  <div id="content">
    <!-- If we are not logged in -->

    <form class="form-signin" name="login_form" action="" method="POST">
      <h2 id="loginHeaderTHISONE"> Crabtown Login</h2>
      <br>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus <?php 
                                if(isset($_COOKIE['remember_me'])){
                                  echo "value =\"".$_COOKIE['remember_me']."\"";
                                }?>>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox">
        <label id="remember_me_box">
          <input type="checkbox" name="remember" value="1"> Remember me
        </label>
      </div>
      <input class="btn btn-lg btn-primary btn-block"type="button" value="Login" onclick="formhash(this.form, this.form.password);" /> 
      <input type="hidden" name="form_type" value="login">
      <p>If you don't have an account, please <a href='/register'>register</a></p>
    </form>

  </div>

  <?php 
    exit;
    logged_in_message:
  ?>
  <div id="content">
    <h1>You are logged in!</h1>
  <?php
    echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
    echo '<p>Would you like to log out?<a href="/logout_transfer.php">Log out</a>.</p>';
  ?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </div>  
  
</body></html>
