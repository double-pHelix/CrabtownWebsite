<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
if(!isset($_SESSION)) { 
  session_start();
 //sec_session_start();
}

if (isset($_POST['username'], $_POST['p']) && $_POST['form_type'] == "login") {
  include_once 'includes/process_login.php';
}

if (login_check($mysqli)) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!-- Static navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" id="banner_container">
      <div class="container-fluid" id="banner">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" id="ct_logo" href="/index">Crabtown</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li id="menu_nav_stuff"><a href="/index">Main</a></li>
            <li class="dropdown" id="menu_nav_stuff">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Crablar<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header">Editions</li>
                  <li class="dropdown-header">PDF Reader</li>
                  <li><a href="/content_pages/crablar_archives">2014</a></li>
                  <li><a href="/content_pages/crablar_archives2">2015 July</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Interactive Reader</li>
                  <li><a href="/content_pages/2014 Edition">2014</a></li>
                  <li><a href="/content_pages/2015 July Edition">2015 July</a></li>
                </ul>
            </li>
            <li id="menu_nav_stuff"><a href="#">Events</a></li>
            <li id="menu_nav_stuff"><a href="/content_pages/games">Games</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li id="menu_nav_stuff"><a href="./">User Profile<span class="sr-only">(current)</span></a></li>
            <li id="menu_nav_stuff"><a href="../navbar-fixed-top/">Your Stuff!</a></li>
            <li class="dropdown" id="menu_nav_stuff">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">My Account</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Inbox</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Settings</li>
                <?php 
                if($logged == 'in'){
                  echo "<li><a href=\"/logout_transfer.php\">Log Out</a></li>";
                } else {
                  echo "<li><a href=\"#?w=500\" rel=\"03\" class=\"poplight\">LOGIN</a></li>";
                }
                ?>
              </ul>
            </li>    
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>
  <br><br><br>