<?php
    $q = $_GET;

    if ($q['mode']=='ip'){
        $ip_server = $_SERVER['SERVER_ADDR'];
        echo $ip_server;
    } else {
        phpinfo();
    }
    
?>