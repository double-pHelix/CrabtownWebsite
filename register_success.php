<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Success</title>
        <link rel="stylesheet" href="/css/register_success.css" />
    </head>
    <body>
        <h1>Welcome, citizen!</h1>
        <img src="registration_success.png">
        <?php 
            echo "<div id=\"citizen_name\">".$_SESSION['username']."</div>";?>
        <p><a href="index.php">Log in</a> and begin exploring Crabtown!</p>
    </body>
</html>
