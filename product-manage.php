<?php
    session_start();
    //require_once('config.php');
    require_once('_includes/db.php');
   
    $max_item_on_one_page = 5;
    $current_page = $_GET['page']; 
    //$start = 5; //0 --> 1 halaman, item yang akan ditampilkan dari index ke-0
                //1 --> 1 halaman, item yang akan ditampilkan dari index ke-1
    //$start = ($page>1) ? (($page * $max_item) - $max_item) : 0;
    
    if($current_page > 1) {
        $start = ($current_page * $max_item_on_one_page) - $max_item_on_one_page;
    } else {
        $start = 0;
    }
    
    //READ
    $cmd = "SELECT p.id product_id, p.name product_name, b.name brand_name, p.qty, p.price
            FROM products p, brands b
            WHERE p.brand_id = b.id
            ORDER BY p.id ASC";

    $cmd_limit = $cmd." LIMIT $start,$max_item_on_one_page";
    
    $result = mysqli_query($con, $cmd) or die(mysqli_error($con));
    $result_limit = mysqli_query($con, $cmd_limit) or die(mysqli_error($con));

    /*echo "<pre>";
    print_r($result);
    echo "</pre>";*/
    $products = null;
    while($row=mysqli_fetch_assoc($result_limit)){
        $products[] = $row; //0, 1, .., 33
        //product.add(row)
        //echo "ada kok";
    }

    /*echo "<pre>";
    print_r($products);
    echo "</pre>";*/
?>
<html>
    <head>
        <title>Product Manage</title>
    </head>
    <body>
        <table>
            <tr>
                <th>ID Produk</th>
                <th>Nama</th>
                <th>Brand</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
            <?php
                //foreach($products as $key=>$value) is_array()
                //foreach($all_item as $row)
                $count_row = count($products);
                foreach($products as $product){
                    $price = $product['price'];
                    echo "<tr>";
                        echo "<td>".$product['product_id']."</td>";
                        echo "<td>";
                            //<img src='assets/products/1.jpg'>
                            echo "<img src='assets/products/".$product['product_id'].".jpg'>";
                        echo "</td>";
                        echo "<td>".$product['product_name']."</td>";
                        echo "<td>".$product['brand_name']."</td>";
                        echo "<td>".$product['qty']."</td>";
                        echo "<td>".number_format($price, 2, ",", ".")."</td>"; 
                    echo "</tr>";
                }
            ?>
            </tr>
        </table>
    </body>
</html>