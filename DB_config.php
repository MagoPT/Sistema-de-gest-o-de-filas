<?php
$db_host = "localhost";
$db_name = ""; //nome da DB
$db_user = ""; //username da DB
$db_pass = ""; //Password do user a DB

try{
    $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
    $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
