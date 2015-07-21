<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Games!</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
            <p>
                <table>
					<tr>
						<td>
							Play these fun games!
						</td>
					</tr>
					<tr>
						<td><a href="/crabtown_games/crab-ball.php">Crab-ball</a></td>
						<td><a href ="/crabtown_games/crabball_z/crabball_z.html">Crabball Z</a></td>
					</tr>
				</table>
            </p>
		<div id="footer">
		  <p>Something something all rights reserved crabtown copyright blah blah blah...  Not for human consumption.</p>
		</div>
        <?php else : ?>
            <p>
                <span class="error">Only citizens of Crabtown are permitted access to these top secret files.</span> Please <a href="login.phtml">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>
