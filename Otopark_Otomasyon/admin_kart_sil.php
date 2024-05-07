<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}
isset($_GET["kart_id"]) ? $kart_id=$_GET["kart_id"]:$kart_id=-1;
if($kart_id!=-1){
    kartVeriSil($kart_id);
    $_SESSION["kart_ayar"]="silindi";
    header("location:admin_kart.php");
}

?>