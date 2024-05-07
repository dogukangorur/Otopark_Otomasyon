<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}
isset($_POST["ekle"]) ? $arama=$_POST["ekle"]:$arama="";
$check=false;
if($arama=="EKLE"){
    $tarife_adi=$_POST["yeniTarife_adi"];
    $tarife_fiyat=$_POST["yeniTarife_fiyat"];
    tarifeVeriEkle($tarife_adi,$tarife_fiyat);
    $_SESSION["tarife_ayar"]="eklendi";
    header("location:admin_tarife.php");
}

?>