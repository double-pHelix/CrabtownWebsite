<?php
  if (login_check($mysqli) == true) {
   
    goto logged_in_message; 
  } 
?>  

<!-- Navigation Menu at the top of each page -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/menu_navigation.php'; ?>

<?php
  if (login_check($mysqli) == true) {
   
    goto logged_in_message; 
  } 
?>  

<div id="content">
  <!-- If we are not logged in -->

  <form class="form-signin" name="login_form" action="" method="POST">
    <h2 id="loginHeader"> Crabtown Login</h2>
    
    <?php
    if(isset($_GET["error"])){
      if($_GET["error"] == 1){
        echo "<p>Username does not exist</p>";
      } elseif ($_GET["error"] == 2){
        echo "<p>Password is incorrect</p>";
      }
    } else {
      echo "<br>";
    }
    ?>
    
    <label for="inputEmail" class="sr-only">Username</label>
    <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus <?php 
                              if(isset($_COOKIE['remember_me'])){
                                echo "value =\"".$_COOKIE['remember_me']."\"";
                              }?>>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox">
      <label id="remember_me_box">
        <input type="checkbox" name="remember" value="1"> Remember me
      </label>
    </div>
    <input class="btn btn-lg btn-primary btn-block"type="button" value="Login" onclick="formhash(this.form, this.form.password);" /> 
    <input type="hidden" name="form_type" value="login">
    <p>If you don't have an account, please <a href='/register'>register</a></p>
  </form>

</div>

<?php 
  exit;
  logged_in_message:
?>
<div id="content">
  <h1>You are logged in!</h1>
<?php
  echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
  echo '<p>Would you like to log out?<a href="/logout_transfer.php">Log out</a>.</p>';
?>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</div>  
  