<?php
    $selected_value = "A";

    $list = array(
        array(
            "id"    => "B",
            "nama"  => "Bi"
        ),
        array(
            "id"    => "A",
            "nama"  => "An",
        ),
        array(
            "id"    => "D",
            "nama"  => "Do",
        ),
        array(
            "id"    => "C",
            "nama"  => "Cu",
        ),
        array(
            "id"    => "E",
            "nama"  => "Et",
        )
    );

    if(isset($_POST['kota'])){
        echo $_POST['kota'];
        die();
    }

    
    echo "<form action='' method='POST'>";
    echo "<select name='kota'>";
    if (isset($list)){
        foreach($list as $item){
            if ($selected_value==$item['id']){
                echo "<option value='".$item['id']."' selected>".$item['nama']."</option>";
            } else {
                echo "<option value='".$item['id']."'>".$item['nama']."</option>";
            }
        }
    }
    echo "</select>";
    echo "<input type='submit' value='GO!'>";
    echo "</form>";
?>