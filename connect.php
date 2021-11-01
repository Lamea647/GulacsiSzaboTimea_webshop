<?php

$conn = new mysqli('localhost','root','','gulacsiszabotimea_webshop');
if($conn->errno > 0){
    die('Az adatbázis nem elérhető!');
} 
$conn->set_charset("utf8"); 
