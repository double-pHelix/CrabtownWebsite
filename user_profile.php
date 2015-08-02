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
} else {
  $logged_in = false;
}



//check if we asked to change data
if(isset($_POST['make_changes'])){
  $user->update_occupation($_POST['occupation_edit']);
  $user->update_description($_POST['description_edit']);
  $user->update_colour($_POST['colour_edit']);
}


  ?>

<!DOCTYPE html>
<html>
    <head>
      <title> <?php if($logged_in){
                      echo $_SESSION['username']."'s Profile"; 
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
					  <h1>Welcome to your profile page <?php echo $_SESSION['username']; ?></h1>
					  <br>
            
            <!--//if user asked to edit provide and edit form

            //we wanted to edit -->

            <?php if (isset($_POST['edit_requested'])) : ?>
              <img src="/images/crab_avatars/crab_temp.png" id="crab_avatar">
              <form name="edit_form" action="" method="POST" id="edit_form">
                <div class="form-group" id="colour_form">
                  <label for="sel1">Select Colour</label>
                    <select class="form-control" id="sel1" name="colour_edit">
                    
                      <?php 
                      foreach ($user->possible_colours as $colour){
                        if($user->colour == $colour){
                          echo "<option value='$colour' style=\"background-color:$colour\" selected>$colour</option>";
                        } else {
                          echo "<option value='$colour' style=\"background-color:$colour\" >$colour</option>";
                        }
                      }
                      ?>
                    </select>
                </div>                            
             
              <div id="occupation_bio_form">
                  <label> Occupation: </label>
                  <input type="text" name="occupation_edit" value="<?php echo $user->occupation;?>">
                  
                  <br>

                  <label>Bio</label>
                  <textarea class="form-control" name="description_edit"><?php echo $user->description;?></textarea>
              </div>
            
                <br>
                
                <input class="btn btn-xs btn-default" type="submit" name="make_changes" value="Confirm">
              </form>
            <?php else : ?>
              <?php echo "<img src=\"/images/crab_avatars/crab_$user->colour.png\" id=\"crab_avatar\">"; ?>
              <form name="request_to_edit" action="" method="POST">
              
                <b>Occupation: </b><?php echo $user->occupation; ?><br>
                
                <b>Bio</b>
                <br>
                <?php echo $user->description; ?><br>
               <!-- <b>Colour: </b><?php echo $user->colour; ?><br> -->
               <br>
                <input class="btn btn-xs btn-default" type="submit" name="edit_requested" id="edit_profile_button" value="Edit">
              </form>

            <?php endif; ?>
              
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
    
    
</html>
