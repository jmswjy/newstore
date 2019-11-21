<?php
    session_start();

    if($_POST){
        $p = $_POST;
        /*
            lihat current_page.php
            data: {
                    id_barang: idBarang, 
                    qty: qtyBarang
                }
        */
        $idBarang   = $p['id_barang'];
        $qtyBarang  = $p['qty'];

        foreach($_SESSION['cart'] as $key=>$value){
            $item_cart = $value;
            //print_r($item_cart);
            if($item_cart['id'] == $idBarang){
                //$item_cart['qty'] = $qtyBarang;
                $_SESSION['cart'][$key]['qty'] = $qtyBarang;
            }
        }

        echo "<h1>Berhasil Update Cart dengan ID=$idBarang dengan Qty=$qtyBarang !</h1>";
    }
?>