<?php
require_once('_includes/db.php');

$sid = session_id();

echo $sid;
//die();

$cmd_cart = "SELECT * FROM h_cart WHERE id_session='$sid'";
$sql_cart = mysqli_query($con, $cmd_cart);
$row_cart = mysqli_fetch_assoc($sql_cart);
$id_cart = $row_cart[id];

//di cek dulu apakah barang yang di beli sudah ada di tabel keranjang
$cmd = "SELECT h.id cart_id, h.id_session, h.total, 
                d.id_product, d.harga_satuan, d.jumlah, d.subtotal 
        FROM h_cart h, d_cart d
        WHERE h.id=d.id_cart AND 
                d.id_product='$_GET[id]' AND 
                id_session='$sid'";

$sql = mysqli_query($con, $cmd);
$ketemu=mysqli_num_rows($sql);

$cmd_product = "SELECT * FROM products where id='$_GET[id]'";
$sql_product = mysqli_query($con, $cmd_product);
$row_product = mysqli_fetch_assoc($sql_product);

$harga_satuan = $row_product['price'];

if ($ketemu==0){
    // kalau barang belum ada, maka di jalankan perintah insert
    $subtotal = $harga_satuan * 1;
    $tmp_cmd = "INSERT INTO d_cart (id_cart, id_product, harga_satuan,  jumlah, subtotal)
                    VALUES ('$id_cart', '$_GET[id]', '$harga_satuan', 1, '$subtotal')";
    
    echo $tmp_cmd;
    mysqli_query($con, $tmp_cmd);
    die();
} else {
    //  kalau barang ada, maka di jalankan perintah update
    mysqli_query($con, "UPDATE d_cart
            SET jumlah = jumlah + 1
            WHERE id_cart ='$id_cart' AND id_product='$_GET[id]'");       
}   
header('Location: cart.php');

?>