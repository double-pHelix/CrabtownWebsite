<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';

  if(!isset($_SESSION)) { 
    session_start();
   //sec_session_start();
  }
  if (login_check($mysqli) == true){
    $logged_in = true;
  } else {
    $logged_in = false;
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Crab News, Forums & Games - Crabtown: The Official World of Crabs</title>
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
 
  <div id="content">

      <p>
          <h1>Welcome to Crabtown! v1.0</h1>
          Stay tuned for content, including new short stories, comics and more!
          <br>
          <br>
                                 <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox" id="content">
        <!-- ITEMS -->
        <div class="item active">
          <img class="first-slide" src="/images/mayornippywelcome.png" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
            
              <?php 
                if ($logged_in == false){            
                  echo "<p>Register an account and become a Crabtown Citizen!</p><p><a class=\"btn btn-lg btn-primary\" href=\"/register\" role=\"button\">Sign Up</a></p>";
                } else {
                  echo "<p>Welcome and have fun!</p>";
                }
              ?>
              
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="/images/crabtown_racing_banner.png" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Crabtown Racing</h1>
              <p>Nominated for Best Film at the Crabtown Film Festival!</p>
              <p><a class="btn btn-lg btn-primary" href="/content_pages/videos_page" role="button">Watch Now</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="/images/crablar_banner.png" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <p id="make_it_black">The Official Newspaper of Crabtown</p>
              <p><a class="btn btn-lg btn-primary" href="content_pages/crablar_archives_flipbook" role="button">Go to Archives</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
    <br>
  </div>
 
  <!-- Trigger the modal with a button -->
  <!-- <button type="button" class="btn btn-info btn-lg" >Open Modal</button> -->

  <div id="footer">
      <p>Something something all rights reserved crabtown copyright blah blah blah...  Not for human consumption.</p>
  </div>
	</body>

  <!-- Modal -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <?php include_once $_SERVER['DOCUMENT_ROOT'].'/login_menu.php'; ?>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  
</html>
