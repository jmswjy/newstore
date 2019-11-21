<?php
    session_start();
    require_once('../_includes/config.php');

    if(isset($_SESSION['cart'])){

    } else {
        $var_cart = array(
            0 => array(
                    "id"            => "B01",
                    "nama"          => "Barang 1",
                    "qty"           => 2,
                    "harga_satuan"  => 200
                ),
            1 => array(
                    "id"            => "B03",
                    "nama"          => "Barang 3",
                    "qty"           => 1,
                    "harga_satuan"  => 400
                ),
            2 => array(
                    "id"            => "B07",
                    "nama"          => "Barang 7",
                    "qty"           => 5,
                    "harga_satuan"  => 100
                ),
        );

        $_SESSION['cart'] = $var_cart;
    }
?>
<html>
    <head>
        <base href='<?php echo $base_url; ?>' />
        <title>Belajar AJAX</title>
        <script src='assets/js/jquery-3.4.1.min.js'></script>
    </head>
    <body>
        <button type='button' class='btn-refresh'>Refresh DIV#refresh</button>
        <div id='refresh'>
        </div>
        <div id="cart">
            <?php
                foreach($_SESSION['cart'] as $item_cart){
                    $cetak_qty = "<input class='nud-qty' type='number' value='".$item_cart['qty']."' data-id_barang='".$item_cart['id']."'>";
                    echo $item_cart['id'].
                            "-".$item_cart['nama'].
                            "-".$item_cart['harga_satuan'].
                            "-".$cetak_qty;
                    echo "<br/>";
                }
            ?>
        </div>
        <script>
            /*$(document).ready(
                function(){
                    $('.btn-refresh').on('click', function(){

                    });
                }
            );*/
            $(document).ready(function(){
                //console.log('jquery siap!');
                //alert('jquery siap!');
                $('.btn-refresh').on('click', function(){
                    alert('saya ditekan!');
                    $.ajax({
                        url: 'ajax/response_ajax.php',
                        method: 'GET',
                        //data:
                        dataType: "html",
                        success: function(result){
                            $('#refresh').html(result);
                        }
                    });
                });

                $('.nud-qty').on('change', function(){
                    alert($(this).val());

                    var idBarang = $(this).data('id_barang');
                    var qtyBarang   = $(this).val();

                    $.ajax({
                        url: 'ajax/response_cart.php',
                        method: 'POST',
                        data: {
                                id_barang: idBarang, 
                                qty: qtyBarang
                            },
                        dataType: "html",
                        success: function(result){
                            $('#refresh').html(result);
                        }
                    });
                });
            });
        </script>
    </body>
</html>