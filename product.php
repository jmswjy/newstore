<?php
	/*
		Bahan Belajar:
		- https://www.malasngoding.com/membuat-paging-dengan-php-dan-mysql/
		- IF INLINE or Ternary Operators --> https://davidwalsh.name/php-shorthand-if-else-ternary-operators
			([condition])? True_Value : False_Value;
		-
	*/
?>
<?php
	session_start();
	require_once('_includes/config.php'); //have $base_url, etc.
	require('_includes/db.php');
	
	require_once('_includes/cart.php'); //have $cart
	require_once('_includes/check_visitor.php'); //have $visitor
    
    $brand = strtolower($_GET["brand"]);
	$cmd_extra = "AND lower(b.name)='".$brand."'";
	$cmd = "SELECT p.id product_id, p.name product_name, p.price, b.name brand_name 
			FROM products p, brands b
			WHERE p.brand_id=b.id $cmd_extra";
	
	$all_result 	= mysqli_query($con,$cmd) or die(mysqli_error($con));
	$count_all_item = mysqli_num_rows($all_result);

	$max_item 		= 10; //Max item in one page
	$page 			= isset($_GET['page'])? (int)$_GET["page"]:1; //contoh IF INLINE
	//echo $page;
	$start 			= ($page>1) ? (($page * $max_item) - $max_item) : 0; //contoh IF INLINE
	//echo $start;
	
	$cmd 			= $cmd." LIMIT $start, $max_item";
	//echo $cmd;
	$limit_result 	= mysqli_query($con,$cmd) or die(mysqli_error($con));

	$count_pages 	= ceil($count_all_item / $max_item); 

	$products = null;
	if ($count_all_item >= 1){
		while($row = mysqli_fetch_assoc($limit_result)) {
			$products[] = $row;
		}
    }
    
    //True Type
    $brand_truetype = "";
    $cmd2 = "SELECT b.name FROM brands b WHERE lower(b.name) = '$brand'";
    $temp_result = mysqli_query($con,$cmd2) or die(mysqli_error($con));
    $total_item = mysqli_num_rows($temp_result);
    if ($total_item ==1){
        //BACA: https://stackoverflow.com/questions/10605456/selecting-one-row-from-mysql-query-php
        $item = mysqli_fetch_assoc($temp_result);
        $brand_truetype = $item['name'];
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
                        <li class='<?php echo ($brand=='samsung') ? "active" : "" ?>'>
							<a href="product.php?brand=samsung">Samsung</a>
						</li>
                        <li class='<?php echo ($brand=='lg') ? "active" : "" ?>'>
							<a href="product.php?brand=lg">LG</a>
						</li>
                        <li class='<?php echo ($brand=='sharp') ? "active" : "" ?>'>
                            <a href="product.php?brand=sharp">Sharp</a>
                        </li>
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
            <div class='row col-md-12'>
                <h1>Products of <?php echo $brand_truetype; ?></h1>
            </div>
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
					<?php
						if ($page>1){
							$prev_page = $page-1;
							//echo "Prev: ".$prev_page;
					?>
						<a href='product.php?brand=<?php echo $brand; ?>&page=<?php echo $prev_page; ?>' class="btn btn-default" title='Previous'>
							<i class='glyphicon glyphicon-chevron-left'></i>
							Previous
						</a>
					<?php } ?>
					<?php
						for ($i=1; $i<=$count_pages; $i++){
							$flag_class = "";
							if ($page==$i){
								$flag_class = "active";
							}
							if($i==1){
								echo "<a href='product.php?brand=$brand&page=$i' class='btn btn-default $flag_class' title='First'>$i</a>";
							} else if($i==$count_pages) {
								echo "<a href='product.php?brand=$brand&page=$i' class='btn btn-default $flag_class' title='Last'>$i</a>";
							} else {
								echo "<a href='product.php?brand=$brand&page=$i' class='btn btn-default $flag_class' title='Page $i'>$i</a>";
							}
						}
					?>
					<?php
						if ($page<$count_pages){
							$next_page = $page+1;
							//echo "Next: ".$next_page;
							echo "<a href='product.php?brand=$brand&page=$next_page' class='btn btn-default' title='Next'>
										Next
										<i class='glyphicon glyphicon-chevron-right'></i>
									</a>";
						}
					?>
				</div>
				<?php
                    echo "<p>&nbsp;</p>";
                    echo "Brand = ".$brand_truetype."<br/>";
					echo "Current Page = ".$page."<br/>";
					echo "Next Page = ".$next_page."<br/>";
					echo "Prev Page = ".$prev_page."<br/>";
				?>
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