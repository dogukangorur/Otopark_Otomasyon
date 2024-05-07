<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}
isset($_POST["kartEkle"]) ? $arama=$_POST["kartEkle"]:$arama="";
$check=false;
if($arama=="EKLE"){
    $kart_no=$_POST["y_kartNo"];
    $kart_skt=$_POST["y_skt"];
    $kart_skt=$_POST["y_skt"];
    $kart_cvv=$_POST["y_cvv"];
    $kart_kullanici=$_POST["y_kullaniciId"];
    kartVeriEkle($kart_no,$kart_skt,$kart_cvv,$kart_kullanici);
    $_SESSION["kart_ayar"]="eklendi";
    header("location:admin_kart.php");
}

?>