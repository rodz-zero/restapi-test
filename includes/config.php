<?php

    $hostname = '127.0.0.1';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'phprest';

    $db = new PDO('mysql:host='.$hostname.';dbname='.$db_name.';charset=utf8',$db_user,$db_password);
    // set some db attributes
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    define('APP_NAME','PHP REST API TUTORIAL');




?>