<?php
	session_start();
	require_once('_includes/config.php'); //have $base_url, etc.
	require('_includes/db.php');
	
	require_once('_includes/cart.php'); //have $cart
	require_once('_includes/check_visitor.php'); //have $visitor
	
	$cmd_extra = "";
	$cmd = "SELECT p.id product_id, p.name product_name, p.price, b.name brand_name 
			FROM products p, brands b
			WHERE p.brand_id=b.id $cmd_extra;";
			
	$result = mysqli_query($con,$cmd) or die(mysqli_error($con));
	$rows = mysqli_num_rows($result);
	$products = null;
	if ($rows >= 1){
		while($row = mysqli_fetch_assoc($result)) {
			$products[] = $row;
		}
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
			<div class='row' style='margin:0px auto;'>
				<?php 
					foreach($products as $product){
						$id = $product['product_id'];
				?>
					<div class='col-md-2 col-xs-offset-1 text-center border-list'>
						<img src='assets/images/products/<?php echo $id; ?>.jpg' class='img-responsive object-fit'/>
						<h4><?php echo $product['product_name']; ?></h4>
						<p class='small'>
							<?php echo $product['brand_name']; ?>
						</p>
						<p>
							Rp. 
							<?php 
								$price = $product['price'];
								echo number_format($price,2); 
							?>
						</p>
					</div>
				<?php } ?>
			</div>
			<div class='row text-center'>
				<div class="btn-group">
					<a href='' class="btn btn-default" title='Previous'>
						<i class='glyphicon glyphicon-chevron-left'></i>
						Previous
					</a>
					<a href='' class="btn btn-default" title='First'>1</a>
					<a href='' class="btn btn-default">2</a>
					<a href='' class="btn btn-default">3</a>
					<a href='' class='btn btn-default' title='Next'>
						Next
						<i class='glyphicon glyphicon-chevron-right'></i>
					</a>
				</div>
			</div>
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