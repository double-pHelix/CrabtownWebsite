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

<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <title>Crabtown Crablar: Flipbook Reader</title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/login.css"/> 
    <link rel="stylesheet" type="text/css" href="/css/Crabtown v1.0.css">   
    <link rel="stylesheet" type="text/css" href="/css/crablar_archives_flipbook.css">    
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

	<!--Search form-->
<div class="searchform">
 <form  method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>"  id="searchform">
	<select required name ="year">
	  <option value="2015">2015</option>
	  <option value="2014">2014</option>
	</select> 
	<select required name = "month">
	  <option value="jan">Jan</option>
	  <option value="feb">Feb</option>
	  <option value="mar">Mar</option>
	  <option value="apr">Apr</option>
	  <option value="may">May</option>
	  <option value="jun">Jun</option>
	  <option value="july">July</option>
	  <option value="aug">Aug</option>
	  <option value="sep">Sep</option>
	  <option value="oct">Oct</option>
	  <option value="nov">Nov</option>
	  <option value="dec">Dec</option>
	</select>
 </form>	
</div>	
	
<div class="flipbook-viewport">
	<div class="container">
		<div class="flipbook">
			<?php
			
			function echo_pages ($year, $month, $pages)
			{
				for ($q = 1;$q <=$pages;$q++){
						echo "<div style=\"background-image:url(/crablar_pages/\".$year.\"/\".$month.\"/\".$q.\".png)\"></div>";
				}
			}
			
			if(isset($_POST['year'])){
				//searches db for edition and echos page locations below
				$stmt = $conn->prepare("SELECT FROM crablar_archives (year, month) VALUES (?, ?)");
				$stmt->bind_param("si", $year, $month);
				
				$year = $_POST['year'];
				$month = $_POST['month'];
				$stmt->execute();
				
				while ($row = mysql_fetch_assoc($stmt)) {
				   $year = $row['year'];
				   $month = $row['month'];
				   $pages = $row['pages'];
				}	
				
				echo_pages($year, $month, $pages);
			}
			
			else{
				$latest = "SELECT FROM crablar_archives MAX(edition_no)";
				$result = conn->query($latest);
				
				while ($row = mysql_fetch_assoc($result)) {
				   $year = $row['year'];
				   $month = $row['month'];
				   $pages = $row['pages'];
				}
				
				echo_pages($year, $month, $pages);
			}
			?>
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

</body>

<!-- Menu that pops up -->

  <!-- Modal -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <?php include_once $_SERVER['DOCUMENT_ROOT'].'/login_menu.php'; ?>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  

</html>
