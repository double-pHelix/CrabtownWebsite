<?php
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

$user_group = "not set";
$user_permission = "not set";

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
      echo 'User group does not exist';
    }

} else {
  echo 'Username not found';
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