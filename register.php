<?php
//place in document root
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
include_once 'includes/emailcheck.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="css/register.css" />
        
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
    <br>
    <br>
        <!-- Static navbar -->
      <nav class="navbar navbar-default navbar-fixed-top" id="banner_container">
        <div class="container-fluid" id="banner">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="ct_logo" href="/Crabtown v1.0.html">Crabtown</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li id="menu_nav_stuff"><a href="/Crabtown v1.0.html">Main</a></li>
              <li class="dropdown" id="menu_nav_stuff">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Crablar<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-header">Editions</li>
                    <li class="dropdown-header">PDF Reader</li>
                    <li><a href="/html/crablar_archives.html">2014</a></li>
                    <li><a href="/html/crablar_archives2.html">2015 July</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Interactive Reader</li>
                    <li><a href="/crablar_pages/2014/index.html">2014</a></li>
                    <li><a href="/crablar_pages/2015_july/index.html">2015 July</a></li>
                  </ul>
              </li>
              <li id="menu_nav_stuff"><a href="#">Events</a></li>
              <li id="menu_nav_stuff"><a href="/html/games.html">Games</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li id="menu_nav_stuff"><a href="./">User Profile<span class="sr-only">(current)</span></a></li>
              <li id="menu_nav_stuff"><a href="../navbar-fixed-top/">Your Stuff!</a></li>
              <li class="dropdown" id="menu_nav_stuff">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">My Account</a></li>
                  <li><a href="#">Profile</a></li>
                  <li><a href="#">Inbox</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Settings</li>
                  <li><a href="/includes/logout.php">Log Out</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Become a citizen</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <ul>
            <li>Usernames may contain only digits, upper and lower case letters and underscores.  Please do not use your real name!</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one uppercase letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
        //posts data to itself i.e. register.php
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">
            Username: <input type='text' 
                name='username' 
                id='username' /><br>
            Email: <input type="text" name="email" id="email" /><br>
            Password: <input type="password"
                             name="password" 
                             id="password"/><br>
            Confirm password: <input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" /><br>
            <input type="button" 
                   value="Register" 
                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
        </form>
        <p>Return to the <a href="Crabtown v1.0.html">main page</a>.</p>
    </body>
</html>
