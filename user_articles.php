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


//submit article
if(isset($_POST['submit_article'])){
	$count = 0;
	foreach ($user->articles as $article){

		if($_POST['article_num'] == $article->id){
			//set as being submitted
			$article->update_submitted(true);
		}

		$count++;
	}
}


//unsubmit article
if(isset($_POST['unsubmit_article'])){
	$count = 0;
	foreach ($user->articles as $article){

		if($_POST['article_num'] == $article->id){
			//set as being submitted
			$article->update_submitted(false);
		}

		$count++;
	}
}



//delete article
if(isset($_POST['delete_article'])){
  $count = 0;
  foreach ($user->articles as $article){
    
    if($_POST['article_num'] == $article->id){
      //delete from database
      $article->delete_from_db();
      
      //delete the loaded version
      unset($user->articles[$count]);
    }
    
    $count++;
  }
}

//make edits 
if(isset($_POST['set_edit_article'])){

  foreach ($user->articles as $article){
    if($_POST['article_num'] == $article->id){
      //edit
      $article->update_name($_POST['art_name_edit']);
      $article->update_description($_POST['art_description_edit']);
      $article->update_article_text($_POST['art_text_edit']);

    }
  }
}

$creating_article = false;
//create a new article
if(isset($_POST['create_new_article'])){
	$creating_article = true;
	
  date_default_timezone_set('Australia/Melbourne');
  
  $user_id = $user->user_id;
  $name = "";
  $description = "";
  $creat_date = date('m/d/Y h:i a', time());
  $mod_date = date('m/d/Y h:i a', time());
  $accepted = false;
  $submitted = false;
  $article_text = ""; 

  //create a new article in database
  if ($insert_stmt = $mysqli->prepare("INSERT INTO user_articles (user_id, name, description, creat_date, mod_date, accepted, submitted, article_text) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
      
      $insert_stmt->bind_param('issssiis', $user_id, $name, $description, $creat_date, $mod_date, $accepted, $submitted, $article_text);
              
      // Execute the prepared query.
      if (! $insert_stmt->execute()) {
          echo "FAIL!!".$mysqli->errno;
          exit;
      }
      
  } 
  $new_article_id = $mysqli->insert_id;
  
  //create a new article
  $new_article = new Article($new_article_id, $user_id, $name, $description, $creat_date, $mod_date, $accepted, $submitted, $article_text);   
  
  //and set it as a new article 
  $array[$new_article_id] = $new_article;
  $user->add_articles($array);
  
  
  //and have it be the one to be open to edit
  $_POST['edit_article'] = "set";
  $_POST['article_num'] = strval($new_article_id);


}


  ?>

<!DOCTYPE html>
<html>
    <head>
      <title> <?php if($logged_in){
                      echo $_SESSION['username']."'s Articles"; 
                   } else {
                      echo "Please Login";
                   } ?> </title>
                  
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
				  <h1> <?php echo $_SESSION['username']."'s"; ?> Article Uploads</h1>
            
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
            echo "<h2 id=\"loginHeader\">Draft</h2>";
            
            //display each article (in a list)
            echo "<table class=\"table table-bordered\">";
            
            echo "<tr class=\"active\">";
           		echo "<td scope=\"col\"><b>"."#"."</b></td>";
              	echo "<td scope=\"col\"><b>"."TITLE"."</b></td>";
              	echo "<td scope=\"col\"><b>"."DESCRIPTION"."</b></td>";
              	echo "<td scope=\"col\"><b>"."LAST MODIFIED"."</b></td>";
              	echo "<td scope=\"col\"><b>"."TEXT PREVIEW"."</b></td>";
              	echo "<td scope=\"col\" colspan=\"3\"><b>"."OPTIONS"."</b></td>";
              	
            echo "</tr>";
            
            $display_article = true;
            $edit_article = null;
            $user_count = 1;
            
            foreach ($user->articles as $article){

              //we display edit form version
              if(isset($_POST['edit_article']) && $_POST['article_num'] == $article->id){
              	//show modal form for user edit
              	//displays for new article creation and current article edit
              	
			      
              	$edit_article = $article;
              	
              	
              	if($creating_article){
              		//Create a new article
              		$display_article = false;
              		$user_count--;
              		
              		echo "<script type=\"text/javascript\">
		            $(window).load(function() {
		              $('#myModal3').modal('show');
		            });
		          </script>";
              		
              	} else {
              		//edit existing article
              		echo "<script type=\"text/javascript\">
		            $(window).load(function() {
		              $('#myModal3').modal('show');
		            });
		          </script>";
              	}
              

              } 
              
              if($article->submitted){
              	$display_article = false;
              	$user_count--;
              }
              
              if($display_article){
              	echo "<form name=\"articles_option\" action=\"\" method=\"POST\">";
              	echo "<input type=\"hidden\" name=\"article_num\" value=\"$article->id\">";
              	
              	echo "<tr class=\"active\">";
              	echo "<td class=\"active\">".$user_count."</td>";
              	echo "<td class=\"active\">".$article->name ."</td>";
              	echo "<td class=\"success\">".$article->description  ."</td>";
              	echo "<td class=\"warning\">".$article->mod_date  ."</td>";
              	
              	 
              	if(isset($_GET['expand']) && $_GET['expand'] == $article->id){
              		$article_text = $article->article_text.'... <a href="/user_articles">Read Less</a>';
              	} else {
              		$article_text = $article->article_text;
              		if (strlen($article_text) > 50) {
              			// truncate string
              			$stringCut = substr($article_text, 0, 50);
              			// make sure it ends in a word so assassinate doesn't become ass...
              			$article_text = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="?expand='.$article->id.'">Read More</a>';
              		}
              	}
              	echo "<td class=\"danger\">".$article_text."</td>";
              	
              	echo "<td class=\"info\">"."<button class=\"btn btn-xs btn-warning\" type=\"submit\" name=\"edit_article\" id=\"edit_profile_button\" value=\"Edit\"> 
      					<dfn title=\"Edit\"><span class=\"glyphicon glyphicon-edit\"></span></dfn> </td>";
              	echo "<td class=\"active\">"."<button class=\"btn btn-xs btn-danger\" type=\"submit\" name=\"delete_article\" id=\"edit_profile_button\" value=\"Delete\">
      					<dfn title=\"Remove\"><span class=\"glyphicon glyphicon-trash\"></span></dfn> </td>";
              	echo "<td class=\"active\">"."<button class=\"btn btn-xs btn-success\" type=\"submit\" name=\"submit_article\" id=\"edit_profile_button\" value=\"Delete\">
      					<dfn title=\"Submit\"><span class=\"glyphicon glyphicon-arrow-up\"></span></dfn> </td>";
              	
              	echo "</tr>"; 	
              	echo "</form>";
              }
              
              $display_article = true;
              $user_count++;
              
            }       
            
            echo "<tr class=\"active\">"; 
              echo "<form name=\"articles_option\" action=\"\" method=\"POST\">";
                //echo "<td></td><td></td><td></td><td></td><td></td><td></td>";
                echo "<td class=\"active\" colspan=\"8\">"."<button class=\"btn btn-ss btn-info\" type=\"submit\" name=\"create_new_article\" id=\"edit_profile_button\" value=\"New\"> 
        		<dfn title=\"Create Article\"><span class=\"glyphicon glyphicon-plus\"></span></dfn> </button> </td>";
                
              echo "</form>";
            echo "</tr>";
            
            echo "</table>";
            
            /*************************************************
             * 
             * 
             * Submitted Articles
             * 
             * 
             */
            
            echo "<h2 id=\"loginHeader\">Submitted</h2>";
            
            echo "<table class=\"table table-bordered\">";
            
            echo "<tr class=\"active\">";
            echo "<td scope=\"col\"><b>"."#"."</b></td>";
            echo "<td scope=\"col\"><b>"."TITLE"."</b></td>";
            echo "<td scope=\"col\"><b>"."DESCRIPTION"."</b></td>";
            echo "<td scope=\"col\"><b>"."LAST MODIFIED"."</b></td>";
            echo "<td scope=\"col\"><b>"."TEXT PREVIEW"."</b></td>";
            echo "<td scope=\"col\"><b>"."ACCEPTED"."</b></td>";
            echo "<td scope=\"col\" colspan=\"3\"><b>"."OPTIONS"."</b></td>";
             
            echo "</tr>";
            
            $display_article = true;
            $user_count = 1;
            
            foreach ($user->articles as $article){
            	
            	if(isset($_POST['edit_article']) && $_POST['article_num'] == $article->id){

            		if($creating_article){
            			//Create a new article
            			$display_article = false;
            			$user_count--;
            		}    		

            	}
            	
            	
            	if(!$article->submitted){
            		$display_article = false;
            		$user_count--;
            	}
            	
            	
            	if($display_article && $article->submitted){
            		echo "<form name=\"articles_option\" action=\"\" method=\"POST\">";
            		echo "<input type=\"hidden\" name=\"article_num\" value=\"$article->id\">";
            		 
            		echo "<tr class=\"active\">";
            		echo "<td class=\"active\">".$user_count."</td>";
            		echo "<td class=\"active\">".$article->name ."</td>";
            		echo "<td class=\"success\">".$article->description  ."</td>";
            		echo "<td class=\"warning\">".$article->mod_date  ."</td>";
            		
            		if(isset($_GET['expand']) && $_GET['expand'] == $article->id){
            			$article_text = $article->article_text.'... <a href="/user_articles">Read Less</a>';
            		} else {
            			$article_text = $article->article_text;
            			if (strlen($article_text) > 50) {
            				// truncate string
            				$stringCut = substr($article_text, 0, 50);
            				// make sure it ends in a word so assassinate doesn't become ass...
            				$article_text = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="?expand='.$article->id.'">Read More</a>';
            			}
            		}
            		echo "<td class=\"danger\">".$article_text."</td>";
            		
            		echo "<td class=\"success\">"; 
            		if ($article->accepted == true){
            			echo "<span class=\"glyphicon glyphicon-ok\"></span> </td>";
            		
            		} else {
            			echo "<span class=\"glyphicon glyphicon-remove\"></span> </td>";
            		
            		}
            		echo "</td>";
            		 
            		echo "<td class=\"active\">"."<button class=\"btn btn-xs btn-success\" type=\"submit\" name=\"unsubmit_article\" id=\"edit_profile_button\" value=\"Delete\">
      					<dfn title=\"Remove\"><span class=\"glyphicon glyphicon-arrow-down\"></span></dfn> </td>";
            		 
            		echo "</tr>";
            		echo "</form>";
            	}
            
            	$display_article = true;
            	$user_count++;
            
            }
     
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
