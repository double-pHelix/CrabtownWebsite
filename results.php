<?php
//dependencies
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
if (isset($_POST['username'], $_POST['p']) && $_POST['form_type'] == "login") {
  include_once $_SERVER['DOCUMENT_ROOT'].'/includes/process_login.php';
}

//starts secure mysql session 
if(!isset($_SESSION)) { 
  session_start();
 //sec_session_start();
}

if (login_check($mysqli) == true){
  $logged_in = true;
  //load user permissions and data
  include_once $_SERVER['DOCUMENT_ROOT'].'/includes/user_profile.php';
  include_once $_SERVER['DOCUMENT_ROOT'].'/includes/user_articles.php';
} else {
  $logged_in = false;
}


//search query (remove from this page i nto a php file in includes!!)

//$query = "SELECT * FROM users INNER JOIN user_information on users.id = user_information.user_id WHERE id = ?";
//'$_POST['search_general']

$users = get_search_users($_GET['search_general'], $mysqli);

  ?>

<!DOCTYPE html>
<html>
    <head>
      <title>Search Results</title>
                  
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
      
      <link rel="stylesheet" href="/css/user_profile.css"/> 
      
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
               
		  <div id="content">
			  <p>
				  <h1>Search Results</h1>
            
            <!-- We display each article, if the user wants to read or edit, it jumps to an edit mode.
            //we wanted to edit -->

            <?php
            
            /*************************************************
             *
             *
             * Unsubmitted Articles
             *
             *
             */
            echo "<h2 id=\"loginHeader\">Users</h2>";
            
            //display each article (in a list)
            echo "<table class=\"table table-bordered\">";
            
            echo "<tr class=\"active\">";
           		echo "<td scope=\"col\"><b>"."#"."</b></td>";
              	echo "<td scope=\"col\"><b>"."NAME"."</b></td>";
              	echo "<td scope=\"col\"><b>"."DESCRIPTION"."</b></td>";
              	echo "<td scope=\"col\"><b>"."OCCUPATION"."</b></td>";
              	echo "<td scope=\"col\"><b>"."COLOUR"."</b></td>";
              	echo "<td scope=\"col\" colspan=\"2\"><b>"."OPTIONS"."</b></td>";
              	
            echo "</tr>";
            
            $display_article = true;
            $edit_article = null;
            $user_count = 1;
            
            foreach ($users as $user){

              	echo "<form name=\"articles_option\" action=\"\" method=\"POST\">";
              	echo "<input type=\"hidden\" name=\"article_num\" value=\"$user->user_id\">";
              	
              	echo "<tr class=\"active\">";
              	echo "<td class=\"active\">".$user_count."</td>";
              	echo "<td class=\"active\">".$user->username ."</td>";
              	echo "<td class=\"success\">".$user->description  ."</td>";
              	echo "<td class=\"warning\">".$user->occupation  ."</td>";
              	echo "<td class=\"danger\">".$user->colour."</td>";
              	
              	echo "<td class=\"info\">"."<button class=\"btn btn-xs btn-warning\" type=\"submit\" name=\"edit_article\" id=\"edit_profile_button\" value=\"Edit\"> 
      					<dfn title=\"Message\"><span class=\"glyphicon glyphicon-envelope\"></span></dfn> </td>";
              	echo "<td class=\"active\">"."<button class=\"btn btn-xs btn-danger\" type=\"submit\" name=\"delete_article\" id=\"edit_profile_button\" value=\"Delete\">
      					<dfn title=\"Articles\"><span class=\"glyphicon glyphicon-folder-open\"></span></dfn> </td>";
              	
              	echo "</tr>"; 	
              	echo "</form>";
              
              
              $display_article = true;
              $user_count++;
              
            }       
            /*
            echo "<tr class=\"active\">"; 
              echo "<form name=\"articles_option\" action=\"\" method=\"POST\">";
                //echo "<td></td><td></td><td></td><td></td><td></td><td></td>";
                echo "<td class=\"active\" colspan=\"8\">"."<button class=\"btn btn-ss btn-info\" type=\"submit\" name=\"create_new_article\" id=\"edit_profile_button\" value=\"New\"> 
        		<dfn title=\"Create Article\"><span class=\"glyphicon glyphicon-plus\"></span></dfn> </button> </td>";
                
              echo "</form>";
            echo "</tr>";
            */
            echo "</table>";
            
            
            ?>
            
        <br>
				<div>
				</div>
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
    

    <!-- Modal 3 -->
    <div id="myModal3" class="modal fade">
      <div class="modal-dialog">
      	<?php include_once $_SERVER['DOCUMENT_ROOT'].'/article_form_create.php'; ?>
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    

    

    
    
</html>
