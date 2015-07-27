<?php
//dependencies
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/functions.php';
 
//starts secure mysql session 
if(!isset($_SESSION)) { 
  session_start();
 //sec_session_start();
}

if (login_check($mysqli) == true){
  $logged_in = true;
  include_once $_SERVER['DOCUMENT_ROOT'].'/includes/permissions.php';
} else {
  $logged_in = false;
}

if($logged_in){
//set up user profile

  class User {
    public $username;
    public $user_id;
    public $occupation;
    public $description;
    public $colour;

    function __construct($user_id, $username, $occupation, $description, $colour){
      $this->user_id = $user_id;
      $this->username = $username;
      $this->occupation = $occupation;
      $this->description = $description;
      $this->colour = $colour;
    }
    
    function update_occupation($new_occupation){
      //sanitize
      //$new_occupation = filter_input(INPUT_POST, 'new_occupation', FILTER_SANITIZE_STRING);
      $this->occupation = $new_occupation;
      $this->update_info($this->user_id, $this->occupation, $this->description, $this->colour);
    }
    
    function update_description($new_description){
      //sanitize
      //$new_description = filter_input(INPUT_POST, 'new_description', FILTER_SANITIZE_STRING);
      $this->description = $new_description;
      $this->update_info($this->user_id, $this->occupation, $this->description, $this->colour);
      
    }
    
    function update_colour($new_colour){
      //sanitize
      //$new_colour = filter_input(INPUT_POST, 'new_colour', FILTER_SANITIZE_STRING);
      $this->colour = $new_colour;
      $this->update_info($this->user_id, $this->occupation, $this->description, $this->colour);
    }
    
    function update_info($user_id, $occupation, $description, $colour){
      global $mysqli;
      // Insert the new user into the database 
      if ($update_stmt = $mysqli->prepare("UPDATE user_information SET occupation=?, description=?, colour=? WHERE user_id=?")) {
          
          $update_stmt->bind_param('sssi', $occupation, $description, $colour, $user_id);
          // Execute the prepared query.

          if (! $update_stmt->execute()){
              print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
          }
          
      } else {
        echo "UPDATE FAIL!";
      }
    }
    
    function print_all(){
      echo $this->username.$this->occupation.$this->description.$this->colour;
    }

  }

  //set up our user
  $user_set = false;
  $user;
  $username = $_SESSION['username'];
  $occupation;
  $description;
  $colour;

  //get the user's id
  if($stmt = $mysqli->prepare("SELECT id FROM users
          WHERE username = ?
          LIMIT 1")){
          
        $stmt->bind_param('s', $_SESSION['username']);       
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        
        //get the user's permissions
        if($stmt = $mysqli->prepare("SELECT occupation, description, colour FROM user_information
            WHERE user_id = ?
            LIMIT 1")){
            
            $stmt->bind_param('s', $user_id);       
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();
            $stmt->bind_result($occupation, $description, $colour);
            $stmt->fetch();
            
            $user_set = true;
            $user = new User($user_id, $_SESSION['username'],$occupation, $description, $colour);
            //echo 'Permissions set';
        } else {
          echo 'Database or SQL error1';
        }
  } else {
    echo 'Database or SQL error2';
  }

  if($user_set == false){
    echo "...User not set. Failed.";
    exit;
  }
  
  //exit;
}

//check if we asked to change data
if(isset($_POST['make_changes'])){
  $user->update_occupation($_POST['occupation_edit']);
  $user->update_description($_POST['description_edit']);
  //$user->update_colour("Blue");
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
					  <br>
            
            <!--//if user asked to edit provide and edit form

            //we wanted to edit -->

            <?php if (isset($_POST['edit_requested'])) : ?>
              <form name="edit_form" action="" method="POST">
                <p>Occupation: <input type="text" name="occupation_edit"
                                  value="<?php echo $user->occupation;?>"> </p><br>

                <p>Description:<input type="text" name="description_edit" 
                                  value ="<?php echo $user->description;?>"> </p><br>
                <input class="button" type="submit" name="make_changes" value="Confirm">
              </form>
            <?php else : ?>
              <form name="request_to_edit" action="" method="POST">
              
                <p>Occupation: <?php echo $user->occupation; ?></p><br>
                
                <p>Description: <?php echo $user->description; ?></p><br>
                <input class="button" type="submit" name="edit_requested" value="Edit">
  
                
              </form>

              
            <?php endif; ?>
            
            
            
            
            
				<div>
				</div>
			   </div>
			   <div id="footer">
					<p>Something something all rights reserved crabtown copyright blah blah blah...  Not for human consumption.</p>
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