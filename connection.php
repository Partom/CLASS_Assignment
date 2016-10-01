<?php
    $host =  "localhost";
    $username = "root";
    $password = "";
    $database = "unique_name";


    $con  =  mysql_connect($host ,  $username , $password);
    $db =  mysql_select_db($database);


?>