<?php
session_start();
require_once('config.php');

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    //die();
    die("Connection failed: " . $con->connect_error);
}

$sid = session_id();

$cmd_check_cart = "SELECT *
                    FROM h_cart
                    WHERE id_session = '$sid'";
$sql_check_cart = mysqli_query($con, $cmd_check_cart);
//$row_product = mysqli_fetch_assoc($sql_product);
$ketemu=mysqli_num_rows($sql_check_cart);

echo $ketemu;
//echo $sid;
//die();

if ($ketemu==0){
    $cmd_insert_cart = "INSERT INTO h_cart(id_session, total) VALUES('$sid', 0);";
    echo $cmd_insert_cart;
    $sql_insert_cart = mysqli_query($con, $cmd_insert_cart);

    echo "Yeay, berhasil insert CART BARU";
} else {
    echo "Sudah ada Cart nya";
}

//die();

?>

