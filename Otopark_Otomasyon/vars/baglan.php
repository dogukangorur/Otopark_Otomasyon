<?php
$connection= mysqli_connect("localhost",$kullanici_adi,$sifre,$veritabani_adi);
mysqli_set_charset($connection,"UTF8");

    if(mysqli_connect_errno()>0){
     die("hata:".mysqli_connect_errno());
     }
?>