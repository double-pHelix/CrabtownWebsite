<?php
//ONLY RUN THIS CODE IF THE USER IS LOGGED ON
//AND WE HAVE RUN THE user_profile.php code in includes

class Article {
  public $id;
  public $user_id;
  public $name;
  public $description;
  public $creat_date;
  public $mod_date;
  public $accepted;
  public $article_text;    
  
  function __construct($id, $user_id, $name, $description, $creat_date, $mod_date, $accepted, $article_text){
  
    $this->id = $id;
    $this->user_id = $user_id;
    $this->name = $name;
    $this->description = $description;
    $this->creat_date = $creat_date;
    $this->mod_date = $mod_date;
    $this->accepted = $accepted;
    $this->article_text = $article_text;
  }
  
  function update_name($new_name){
    //sanitize
    $this->name = $new_name;
    $this->update_article_info($this->name, $this->description, $this->accepted, $this->article_text);
  }
  
  function update_description($new_description){
    //sanitize
    $this->description = $new_description;
    $this->update_article_info($this->name, $this->description, $this->accepted, $this->article_text);
  }
  
  function update_article_text($new_article_text){
    //sanitize
    $this->article_text = $new_article_text;
    $this->update_article_info($this->name, $this->description, $this->accepted, $this->article_text);
  }
  
  function update_accepted($new_accepted){
    //sanitize
    $this->accepted = $new_accepted;
    $this->update_article_info($this->name, $this->description, $this->accepted, $this->article_text);
  }
  
  function update_article_info($name, $description, $accepted, $article_text){
    global $mysqli;
    date_default_timezone_set('Australia/Melbourne');
    $this->mod_date = date('m/d/Y h:i:s a', time()); //right now
    
    // Insert the new user into the database 
    if ($update_stmt = $mysqli->prepare("UPDATE user_articles SET name=?, description=?, mod_date=?, accepted=?, article_text=? WHERE id=?")) {
        
        $update_stmt->bind_param('sssisi', $name, $description, $this->mod_date, $accepted, $article_text, $this->id);
        // Execute the prepared query.

        if (! $update_stmt->execute()){
            print 'Error : ('. $mysqli->errno .') '. $mysqli->error;
            exit;
        }
        
    } else {
      echo "UPDATE FAIL!";
      exit;
    }
  }
  
  function delete_from_db (){
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM user_articles WHERE id = ?");
   
    if($stmt){
      $stmt->bind_param('i', $this->id );
      $stmt->execute(); 
    } else {
      echo "Delete ERROR!".$mysqli->errno;
      exit;
    }
    
    $stmt->close();
  }
  
  function print_all(){
    echo $this->id."<br>".
          $this->name."<br>".
          $this->description."<br>".
          $this->creat_date."<br>".
          $this->mod_date."<br>".
          $this->accepted."<br>".
          $this->article_text."<br>";
  }

}

$user; //contains user information
$username = $_SESSION['username'];


//load user's articles
//get the user's articles

//test query works for all

$query = "SELECT * FROM user_articles WHERE user_id = '$user->user_id'";
$loop = mysqli_query($mysqli, $query)
   or die (mysqli_error($mysqli));

$user_articles = array();
while ($row = mysqli_fetch_array($loop)) {    
    $new_article = new Article($row['id'], $row['user_id'],$row['name'],$row['description'], $row['creat_date'], $row['mod_date'], $row['accepted'], $row['article_text']);   
    $user_articles[$row['id']] = $new_article;
}

$user->add_articles($user_articles);

/*
echo "Printing out user's articles (TEST) <br>";
foreach($user->articles as $art){
  $art->print_all(); 
}

exit;
*/