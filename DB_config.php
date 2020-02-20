<?php
$db_host = "localhost";
$db_name = ""; //nome da base de dados
$db_user = ""; //nome do utilizador da base de dados
$db_pass = ""; //palavrasse da base de dados

try{
    $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
    $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
