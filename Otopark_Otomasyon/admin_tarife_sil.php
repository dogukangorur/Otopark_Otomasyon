<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}
isset($_GET["tarife_id"]) ? $tarife_id=$_GET["tarife_id"]:$tarife_id=-1;
if($tarife_id!=-1){
    tarifeVeriSil($tarife_id);
    $_SESSION["tarife_ayar"]="silindi";
    header("location:admin_tarife.php");
}

?>