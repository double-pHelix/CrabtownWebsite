<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
if(!isset($_SESSION)) { 
  session_start();
 //sec_session_start();
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
            <li class="dropdown" id="menu_nav_stuff">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Crablar<span class="caret"></span></a>
                <ul class="dropdown-menu" id="menu_nav_stuff_drop_down">
                  <li class="dropdown-header">Editions</li>
                  <li class="dropdown-header">PDF Reader</li>
                  <li><a href="/content_pages/crablar_archives">2014</a></li>
                  <li><a href="/content_pages/crablar_archives2">2015 July</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/content_pages/crablar_archives_flipbook">Interactive Reader</a></li>
                </ul>
            </li>
            <!-- Events -->
            <li id="menu_nav_stuff"><a href="/content_pages/events"><dfn title="Events"><span class="glyphicon glyphicon-calendar"></span></dfn></a></li> 
            <!-- Games -->
            <li id="menu_nav_stuff"><a href="/content_pages/games"><dfn title="Games"><span class="glyphicon glyphicon-tower"></span></dfn></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	
          	<!-- Search Bar -->
          	
          	<li role="presentation">
	           <div id="bannerSearchBox">
	          
	           <form action="/results" method="POST" class="form-inline"> 
	              <input type="hidden" name="search_type" value="user">
	              <div class="input-group">
	                <input id="search_text_box" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="User Search..." name="search_general">                           
	              </div><!-- /input-group -->
	              <div class="input-group">
	                <button class="btn btn-default" type="submit" id="topBannerSearchButton"><span class="glyphicon glyphicon-search"></span></button>
	              </div>
	            </form>
	          
	            </div>
	          </li>
          
          	<!-- Profile and uploads-->
             <?php if($logged == 'in'): ?>
                <li id="menu_nav_stuff">
                    <a href="/user_profile"> 
                    <?php
                        echo "<img src=\"/images/crab_avatars/crab_$user->colour.png\" id=\"crab_avatar_menu\"> $user->username";  
                    ?> <span class="sr-only">(current)</span></a></li>

                <li id="menu_nav_stuff"><a href="/user_articles"><dfn title="Article Upload"><span class="glyphicon glyphicon-folder-open"></span></dfn></a></li>
              <?php endif; ?>
            
            <!-- Account -->
            <li class="dropdown" id="menu_nav_stuff">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><dfn title="Account"><span class="glyphicon glyphicon-user"></span></dfn><span class="caret"></span></a>
              <ul class="dropdown-menu">
              
                <?php if($logged == 'in'): ?>
                  <li><a href="#">My Account</a></li>
                  <li><a href="#">Profile</a></li>
                  <li><a href="#">Inbox</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Settings</li>
                  <li><a href="/logout_transfer.php">Log Out</a></li>

                <?php else : ?>
                  <li><a href="./register">Register</a></li>
                  <li><a data-toggle="modal" data-target="#myModal">Login</a></li>
                <?php endif; ?>
              </ul>
            </li>    
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>
  <br><br><br>
