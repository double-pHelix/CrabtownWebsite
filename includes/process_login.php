<?php
include_once 'db_connect.php';
include_once 'functions.php';



sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['email'], $_POST['p'])) {
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
    
    echo 'Invalid Request';
}
