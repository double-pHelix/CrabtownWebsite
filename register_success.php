<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Secure Login: Registration Success</title>
  <script type="text/JavaScript" src="js/sha512.js"></script> 
  <script type="text/JavaScript" src="js/forms.js"></script>
  <link rel="stylesheet" href="/css/register_success.css" />
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href='http://fonts.googleapis.com/css?family=Londrina+Solid' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600' rel='stylesheet' type='text/css'>
    
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
      
  <link rel="stylesheet" type="text/css" href="/CSS/Crabtown v1.0.css">
        
</head>
<body>
    <!-- Navigation Menu at the top of each page -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/menu_navigation.php'; ?>

        <h1>Welcome, citizen!</h1>
        <br>
        <img src="/images/registration_success.png">
        <?php 
            echo "<div id=\"citizen_name\">".$username."</div>";?>
        <p><a href="/login.php">Log in</a> and begin exploring Crabtown!</p>
        
        
    </body>
</html>
