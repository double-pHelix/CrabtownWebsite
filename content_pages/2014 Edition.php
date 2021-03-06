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
    //load user permissions and data
    include_once $_SERVER['DOCUMENT_ROOT'].'/includes/user_profile.php';
  } else {
    $logged_in = false;
  }

?>

<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
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

    <script type="text/javascript" src="/CSS/extras/jquery.min.1.7.js"></script>
    <script type="text/JavaScript" src="/js/popup.js"></script>

    <script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width = 1050, user-scalable = no" />
    <script type="text/javascript" src="/CSS/extras/modernizr.2.5.3.min.js"></script>

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
<body id="Crablar_Reader">
    <!-- Navigation Menu at the top of each page -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/menu_navigation.php'; ?>
 
<?php if (login_check($mysqli) == true) : ?>
      
<div class="flipbook-viewport">
	<div class="container">
		<div class="flipbook">
			<div style="background-image:url(/crablar_pages/2014/pages/1.png)"></div>
			<div style="background-image:url(/crablar_pages/2014/pages/2.png)"></div>
			<div style="background-image:url(/crablar_pages/2014/pages/3.png)"></div>
		</div>
	</div>
</div>

<div id="content_reader">
  <script type="text/javascript">
    function loadApp() {

      // Create the flipbook

      $('.flipbook').turn({
          // Width

          width:922,
          
          // Height

          height:600,

          // Elevation

          elevation: 50,
          
          // Enable gradients

          gradients: true,
          
          // Auto center this flipbook

          autoCenter: true

      });
    }
    // Load the HTML4 version if there's not CSS transform
    yepnope({
      test : Modernizr.csstransforms,
      yep: ['/CSS/lib/turn.js'],
      nope: ['/CSS/lib/turn.html4.min.js'],
      both: ['/crablar_pages/2014/css/basic.css'],
      complete: loadApp
    });
  </script>
</div>

<?php else : ?>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/restricted_message.php'; ?>    
<?php endif; ?>

  <!-- FOOTER -->
  <?php include_once $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>

    

</body>

<!-- Menu that pops up -->

  <!-- Modal -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <?php include_once $_SERVER['DOCUMENT_ROOT'].'/login_menu.php'; ?>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  

</html>