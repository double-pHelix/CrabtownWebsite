<?php
//ONLY RUN THIS CODE IF THE USER IS LOGGED ON

class UserPermissions {
    const READ_ACCOUNT = 1;
    const READ_ALL_ACCOUNT = 2;
    const EDIT_ACCOUNT = 4;
    const EDIT_ALL_ACCOUNT = 8;
    const POST_NEW_CONTENT_ACCNT = 16;
    const READ_POSTS = 32;
    const POST_NEW_THREADS = 64;
    const POST_NEW_REPLIES = 128;
    const EDIT_OWN_POSTS = 256;
    const EDIT_OTHERS_POSTS = 512;
    const DELETE_OWN_POSTS = 1024;
    const DELETE_OTHERS_POSTS = 2048;
    const MOVE_THREADS = 4096;
    const SPLIT_THREADS = 8192;
    const MERGE_THREADS = 16384;
    const BAN_USERS = 32768;
    const WARN_USERS = 65536;
    const ACCESS_ADMIN_PANEL = 131072;
    // And so on and so on

    protected $perms;

    function __construct($permissions) {
      $this->perms = $permissions;
    }

    function hasPermission($perm) {
      return ($this->perms & $perm) === $perm;
    }
}

//get user's permissions 

$user_group = false;
$user_permission = false;

//get the user's group
if($stmt = $mysqli->prepare("SELECT group_id FROM users
        WHERE username = ?
        LIMIT 1")){
    $stmt->bind_param('s', $_SESSION['username']);       
    $stmt->execute();    // Execute the prepared query.
    $stmt->store_result();
    $stmt->bind_result($user_group);
    $stmt->fetch();

    //get the user's permissions
    if($stmt = $mysqli->prepare("SELECT permissions FROM groups
        WHERE id = ?
        LIMIT 1")){
        
        $stmt->bind_param('s', $user_group);       
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
        $stmt->bind_result($user_permissions);
        $stmt->fetch();
        
        $user_permission = new UserPermissions($user_permissions);
        //echo 'Permissions set';
    } else {
      echo 'Database or SQL error';
    }

} else {
  echo 'Database or SQL error';
}

//echo "Starting Tests..."; 

//run some tests
if($user_group == 1) {
  //standard user
  //echo "for standard user";
  if(!($user_permission->hasPermission(UserPermissions::READ_ACCOUNT)) == true){
    echo "failed test 1";
  }
  if(!($user_permission->hasPermission(UserPermissions::READ_ALL_ACCOUNT) == false)){
    echo "failed test 2";
  } 
  if(!($user_permission->hasPermission(UserPermissions::EDIT_ACCOUNT) == true)){
    echo "failed test 3";
  } 
  if(!($user_permission->hasPermission(UserPermissions::EDIT_ALL_ACCOUNT) == false)){
    echo "failed test 4";
  } 
  if(!($user_permission->hasPermission(UserPermissions::POST_NEW_CONTENT_ACCNT) == true)){
    echo "failed test 5";
  } 
  if(!($user_permission->hasPermission(UserPermissions::READ_POSTS) == true)){
    echo "failed test 6";
  } 
  if(!($user_permission->hasPermission(UserPermissions::POST_NEW_THREADS) == true)){
    echo "failed test 7";
  } 
} elseif ($user_group == 2){
  //administrator user
  //echo "for administrator user";
  if(!($user_permission->hasPermission(UserPermissions::READ_ACCOUNT)) == true){
    echo "failed test 1";
  }
  if(!($user_permission->hasPermission(UserPermissions::READ_ALL_ACCOUNT) == true)){
    echo "failed test 2";
  } 
  if(!($user_permission->hasPermission(UserPermissions::EDIT_ACCOUNT) == true)){
    echo "failed test 3";
  } 
  if(!($user_permission->hasPermission(UserPermissions::EDIT_ALL_ACCOUNT) == true)){
    echo "failed test 4";
  } 
  if(!($user_permission->hasPermission(UserPermissions::POST_NEW_CONTENT_ACCNT) == true)){
    echo "failed test 5";
  } 
  if(!($user_permission->hasPermission(UserPermissions::READ_POSTS) == true)){
    echo "failed test 6";
  } 
  if(!($user_permission->hasPermission(UserPermissions::POST_NEW_THREADS) == true)){
    echo "failed test 7";
  } 
}
//echo "...Tests finised"; 

//exit;

//set up user profile and information
class User {
  public $username;
  public $user_id;
  public $occupation;
  public $description;
  public $colour;
  public $possible_colours = array("Red", "Orange", "Blue", "Green", "Yellow", "Purple", "Pink", "Cyan", "Magenta");    
  public $articles = array();
  
  function __construct($user_id, $username, $occupation, $description, $colour){
    $this->user_id = $user_id;
    $this->username = $username;
    $this->occupation = $occupation;
    $this->description = $description;
    $this->colour = $colour;
  }
  
  function add_articles($new_articles){
    $this->articles = array_merge ($this->articles, $new_articles);
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
