<?php
    session_start();
	$visitor = "";
    if(!isset($_SESSION["username"])){
        $visitor = "Guest"; 
    } else {
		$visitor = $_SESSION["username"]; 
	}
?>