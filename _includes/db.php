<?php

require_once('config.php');

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    //die();
    die("Connection failed: " . $con->connect_error);
}

?>

