<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
    $error = 'Oops! An unknown error happened.';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Error</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <p>An error occured, please go  <a href="index.php">back</a> and try again.</p>
        <p class="error"><?php echo $error; ?></p>  
    </body>
</html>
