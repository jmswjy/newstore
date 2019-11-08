<?php
	session_start();
	require_once('_includes/config.php');
	require_once('_includes/cart.php'); //have $cart
	require_once('_includes/check_visitor.php'); //have $visitor
	
	if(isset($_GET['merk'])){
		
	}
?>
<html>
	<head>
		<base href='<?php echo $base_url; ?>'>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>New Store</title>
		<script src='assets/scripts/jquery-3.4.1.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">New Store</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                    <ul class="nav navbar-nav">
                        <li>
							<a href="?merk=samsung">Samsung</a>
						</li>
                        <li>
							<a href="?merk=lg">LG</a>
						</li>
                        <li><a href="?merk=sharp">Sharp</a></li>
                    </ul>
					<ul class="nav navbar-nav navbar-right"> 
						<li>
							<a href='cart.php'>
								<i class='glyphicon glyphicon-shopping-cart'></i>
								Cart (<?php echo count($cart); ?>)
							</a>
						</li>
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
								<i class='glyphicon glyphicon-user'></i>
								<?php echo $visitor; ?>
								<span class="caret"></span>
							</a>
							<?php 
								if ($visitor == 'Guest'){
							?>
								<ul class="dropdown-menu">
									<li><a href="profile.php">Register</a></li>
									<li><a href="login.php">Login</a></li>
								</ul>
							<?php } else { ?>
								<ul class="dropdown-menu">
									<li><a href="profile.php">My Profile</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="logout.php">Logout</a></li>
								</ul>
							<?php } ?>
						</li>
					</ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
		<div class='container'>
			<div class='row text-center'>
				<br>
				Session ID: <?php echo session_id(); ?>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				//alert('ready');
			});
		</script>
		<link href='assets/bootstrap/css/bootstrap.min.css' rel='stylesheet' />
		<link href='assets/styles/external.css' rel='stylesheet' />
		
	</body>
</html>