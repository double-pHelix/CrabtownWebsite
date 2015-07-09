//Used to connect to mySQL databases
<?php
include_once 'psl-config.php';
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
?>
