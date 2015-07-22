<?php
  if(!isset($_SESSION)) { 
    session_start();
   //sec_session_start();
  }
?>

<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
    <script type="text/JavaScript" src="/js/sha512.js"></script> 
    <script type="text/JavaScript" src="/js/forms.js"></script>
    
    <link rel="stylesheet" type="text/css" href="/css/Crabtown v1.0.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/login.css"/>
    
    <link href='http://fonts.googleapis.com/css?family=Londrina+Solid' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600' rel='stylesheet' type='text/css'>   
    
    <link rel="stylesheet" href="/css/login_menu.css"/>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
   
    <script type="text/javascript" 
    src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script> 
    <script type="text/JavaScript" src="/js/popup.js"></script>


  <meta name="viewport" content="width = 1050, user-scalable = no" />
  <script type="text/javascript" src="/CSS/extras/jquery.min.1.7.js"></script>
  <script type="text/javascript" src="/CSS/extras/modernizr.2.5.3.min.js"></script>
          
  <link href="carousel.css" rel="stylesheet">

</head>
<body id="Crablar_Reader">
    <!-- Navigation Menu at the top of each page -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/menu_navigation.php'; ?>
      
<?php if (login_check($mysqli) == true) : ?>
   
  <div class="flipbook-viewport">
    <div class="container">
      <div class="flipbook">
        <div style="background-image:url(/crablar_pages/2015_july/pages/1.png)"></div>
        <div style="background-image:url(/crablar_pages/2015_july/pages/2.png)"></div>
        <div style="background-image:url(/crablar_pages/2015_july/pages/3.png)"></div>
        <div style="background-image:url(/crablar_pages/2015_july/pages/4.png)"></div>
        <div style="background-image:url(/crablar_pages/2015_july/pages/5.png)"></div>
        <div style="background-image:url(/crablar_pages/2015_july/pages/6.png)"></div>
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
  <p>
      <span class="error">Only citizens of Crabtown are permitted access to these top secret files.</span> Please <a href="login.phtml">login</a>.
  </p>
<?php endif; ?>
</body>

<!-- Menu that pops up -->
<div id="03" class="popup_block">
  <Center>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/login_menu.php'; ?>
  </center>
</div>

</html>