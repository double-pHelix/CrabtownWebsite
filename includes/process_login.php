<?php
include_once 'db_connect.php';
include_once 'functions.php';

if(!isset($_SESSION)) { 
  session_start();
 //sec_session_start();
}

if (isset($_POST['username'], $_POST['p'])) {

    $username = $_POST['username'];
    $password = $_POST['p']; // The hashed password.

    $email = get_email($username, $mysqli);
    if(!$email){
      echo 'Email not found in database';
      header('Location: ../index.php?error=1');
      exit;
    }
    
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        $login_success = true;
        //header('Location: ../protected_page.php');
        
        //create remember me cookie
        //$week = time() + 604800;
        //if($_POST['remember']) {
        //  setcookie('remember_me', $_POST['username'], $week);
          //sets a cookie with a negative time value
        //} elseif(!$_POST['remember']) {
        //  if(isset($_COOKIE['remember_me'])) {
         //   $past = time() - 100;
        //    setcookie('remember_me', gone, $past);
        //  }
        //}

        //header('Location: /login.php');
        //exit();
    } else {
        // Login failed 
        header('Location: ../login.php?error=2');
    }
} elseif(isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        $login_success = true;
        //header('Location: ../protected_page.php');
        
        //create remember me cookie
        $week = time() + 604800;
        if($_POST['remember']) {
          setcookie('remember_me', $_POST['username'], $week);
          //sets a cookie with a negative time value
        } elseif(!$_POST['remember']) {
          if(isset($_COOKIE['remember_me'])) {
            $past = time() - 100;
            setcookie('remember_me', gone, $past);
          }
        }
        
    } else {
        // Login failed 
        header('Location: ../index.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    var_dump($_POST);
    echo 'Invalid Reques!t';
}
