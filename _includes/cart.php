<?php
	session_start();
	$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : null;
?>