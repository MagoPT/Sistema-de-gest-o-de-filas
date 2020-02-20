<!DOCTYPE html  >
<html lang="pt">
<?php
    session_start();
    if(!isset($_SESSION["user"] )){
        include 'page_login.php';
    }else{
       include 'profile.php';
    }
?>
